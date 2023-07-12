<?php
namespace App\Core;

use Google\Auth\ApplicationDefaultCredentials;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;


class Google
{
    public static function getDrive()
    {
        //var_dump toute les variables d'environnement


       
        // specify the path to your application credentials
        putenv('GOOGLE_APPLICATION_CREDENTIALS=/var/www/public/json/client.json');
        //var_dump(getenv('GOOGLE_APPLICATION_CREDENTIALS'));die;
      

       /*  $data = [
            'web' => [
                'client_id' => '365618096866-1ousqpl4q44qsm4gkcp1df3q8rio3k2r.apps.googleusercontent.com',
                'project_id' => 'phplogin-334813',
                'auth_uri' => 'https://accounts.google.com/o/oauth2/auth',
                'token_uri' => 'https://oauth2.googleapis.com/token',
                'auth_provider_x509_cert_url' => 'https://www.googleapis.com/oauth2/v1/certs',
                'client_secret' => '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',
                'redirect_uris' => [
                    'http://gavinaperano.com:88/public/login'
                ],
            ]
            ]; */

            // define the scopes for your API call
        $scopes = ['https://www.googleapis.com/auth/drive.readonly'];

        // create middleware
        $middleware = ApplicationDefaultCredentials::getMiddleware($scopes);
        $stack = HandlerStack::create();
        $stack->push($middleware);

        // create the HTTP client
        $client = new Client([
        'handler' => $stack,
        'base_uri' => 'https://www.googleapis.com',
        'auth' => 'google_auth'  // authorize all requests
        ]);

        // make the request
        $response = $client->get('drive/v2/files');

        // show the result!
        print_r((string) $response->getBody());
    }
}
