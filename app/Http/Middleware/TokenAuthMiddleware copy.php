<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use App\Models\Role;
use App\Models\SystemSetting;
use Closure;
use Exception;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Route;

class TokenAuthMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        $token = trim($request->get('token'));

        if(!$token) {
            // Unauthorized response if token not there
            return response()->json([
                'error' => 'Token not provided.'
            ], 401);
        }




        $lastAccessTimeObj = ApiKey::where('apiKey',$token)->withTrashed()->first();

        // dd($lastAccessTimeObj);

        if(!$lastAccessTimeObj) {
            return response()->json([
                'error' => 'Token not found.'
            ], 401);
        }

        if( $lastAccessTimeObj->deleted_at ) {
            return response()->json([
                'error' => 'Provided token is already expired.'
            ], 401);
        }

        $lastAccessTime = $lastAccessTimeObj->lastAccessTime ; 

        $session_expired_time = (int) $this->getSystemSettingValue('session_expired_time');

        $duration = time() - $lastAccessTime;


        if( $duration  > $session_expired_time ){

            $lastAccessTimeObj->delete();

            return response()->json([
                'error' => 'Provided token is expired.'
            ], 400);
        }


        $explode_by = '.0.0.0.0.';
        $tokenArray = explode($explode_by, decrypt($token));
        $user_id = $tokenArray[0];
        $user_password = $tokenArray[1];
        $user = User::find($user_id);

        if( $user->password != $user_password){
            $lastAccessTimeObj->delete();
            return response()->json([
                'error' => 'Provided token is expired due to password change.'
            ], 400);
        }

        $request->auth = $user;

        $lastAccessTimeObj->save();
 
        // $currurnRouteName =     $request->route()[1]['as'];
        $currurnRouteName =  Route::currentRouteName();  
        // dd($currurnRouteName) ;

        if( ! $this->haveCurrentRouteAccessPermissions($currurnRouteName, $user_id) ){
            return response()->json([
                'error' => 'Unauthorized Access'
            ], 401);
        }
        


        return $next($request);
    }

    function getSystemSettingValue($key){

        $setting = SystemSetting::where('key',$key)->first();
        if( ! $setting)
            throw new Exception('No Setting Value Found! By using Key:' . $key);
        return $setting->value;
    }

    public function haveCurrentRouteAccessPermissions($routeName, $user_id)
    {


        /**
         *   user will get access permission of courrent route if user is accessing common route for all user
         */
          $commonRouteNames = $this->getAllLogedinUserCanAccessRouteNameAsArray();

        if (in_array($routeName, $commonRouteNames)) {
            return true;
        }

        $roleIds = UserRole::where('user_id', $user_id)->pluck('role_id')->toArray();
        $roles = Role::whereIn('id', $roleIds)->get();

        /**
         *   if user has role `su` then user can access all route :)
         */
        if ($roles->where('slug', 'su')->count()) return true;

        $permittedRouteName = [];

        foreach ($roles as $role) {
            if (trim($role->permissions))
                $permittedRouteName = array_merge($permittedRouteName, json_decode($role->permissions));
        }

        if (in_array($routeName, $permittedRouteName)) return true;

        $personalPermisssions = User::where('id', $user_id)->first()->permissions;
        if ($personalPermisssions) {
            return in_array($routeName, json_decode($personalPermisssions));
        }
        /**
         *   TASKS:
         *   =====
         *   1.add  route  permission that is permitted from $permittedRouteName
         *   2. remove route  permission that is not permitted $permittedRouteName
         */

        return in_array($routeName, $permittedRouteName);

    }

    public function getAllLogedinUserCanAccessRouteNameAsArray()
    {
    $routeNames = [];

  $avoidableMiddlewares = ['CommonAccessMiddleware'];

    return $routeNames;    

    $routeNames = [];

	$avoidableMiddlewares = [ 'CommonAccessMiddleware'];

	foreach (Route::getRoutes() as $key=>$route){
		$as = $route['action']['as']??'';
		if ( $as == "") continue;
		$middlewares = $route['action']['middleware']??'';
		if (is_array($middlewares)) {
			foreach ($middlewares as $key => $value) {
				if (in_array($value, $avoidableMiddlewares) && !in_array($as, $routeNames)) {
					$routeNames[] =  $as;
				}
			}
		}
	}

	return $routeNames;
}


  
}
