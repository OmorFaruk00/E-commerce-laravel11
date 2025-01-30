<?php
if (!function_exists('uploadImage')) {
    function uploadImage($image, $folderName)
    {
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/' . $folderName), $imageName);
        return 'images/' . $folderName . '/' . $imageName;
    }
}