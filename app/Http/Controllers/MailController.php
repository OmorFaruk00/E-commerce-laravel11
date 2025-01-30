<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MyMail;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class MailController extends Controller
{
    public function mailSend(){

        // $fromUserEmail = 'api@diu.ac'; // The sender's email address
        // $to = 'omorfaruk5020@gmail.com';
        // $subject = 'Test Email from Microsoft Graph API';
        // $textContent = 'Hello, this is a test email sent using Microsoft Graph API and app authentication.';
        
        // $status = $this->sendTextMail($fromUserEmail, $to, $subject, $textContent);
        // return response()->json(['status' => $status]);
            
        $data = [
            'name' => 'Test mail outlook',
            'message' => 'This is a test email from outlook message.',
        ];
        // Config::set('mail.username','diud12047@gmail.com');
        // Config::set('mail.password', 'tboijxwgzvhuvykr');
        
        Mail::to('omorfaruk5020@gmail.com')->send(new MyMail($data));
        return 'mail Successfulle send';

        // Mail::mailer('alternative_smtp')->to('omorfaruk5020@gmail.com')->send(new MyMail($data));
        // return 'mail Successfulle send';
    }

    function sendTextMail($fromUserEmail, $to, $subject, $textContent)
    {
        $accessToken = $this->getAccessToken(); // Function to retrieve the access token using client credentials
    
        $emailData = [
            "message" => [
                "subject" => $subject,
                "body" => [
                    "contentType" => "Text", // "Text" for plain text
                    "content" => $textContent,
                ],
                "toRecipients" => [
                    [
                        "emailAddress" => [
                            "address" => $to,
                        ],
                    ],
                ],
                "from" => [
                    "emailAddress" => [
                        "address" => $fromUserEmail,
                    ],
                ],
            ],
            "saveToSentItems" => "true",
        ];
    
        $client = new Client();
        $response = $client->post("https://graph.microsoft.com/v1.0/users/$fromUserEmail/sendMail", [
            'headers' => [
                'Authorization' => "Bearer $accessToken",
                'Content-Type' => 'application/json',
            ],
            'json' => $emailData,
        ]);
    
        if ($response->getStatusCode() === 202) {
            return 'Mail sent successfully';
        } else {
            $error = json_decode($response->getBody()->getContents(), true);
            return 'Failed to send mail: ' . ($error['error']['message'] ?? 'Unknown error');
        }
    }


    public function getAccessToken(){
        $tenantId = env('MICROSOFT_TENANT_ID');
        $clientId = env('MICROSOFT_CLIENT_ID');
        $clientSecret = env('MICROSOFT_CLIENT_SECRET');

        $client = new Client();
        $response = $client->post("https://login.microsoftonline.com/$tenantId/oauth2/v2.0/token", [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'scope' => 'https://graph.microsoft.com/.default',
            ],
        ]);

        $body = json_decode($response->getBody());
        return $body->access_token;
    }
}
