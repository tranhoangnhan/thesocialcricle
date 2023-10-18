<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class GoogleDriveController extends Controller
{
    public $gClient;

    function __construct(){
        
        $this->gClient = new \Google_Client();
        
        $this->gClient->setApplicationName('Web client 1'); // ADD YOUR AUTH2 APPLICATION NAME (WHEN YOUR GENERATE SECRATE KEY)
        $this->gClient->setClientId('1048454271567-6tvm8j0gj67qg31ns01ubb1b3f2g9lar.apps.googleusercontent.com');
        $this->gClient->setClientSecret('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');
        $this->gClient->setRedirectUri(route('google.login'));
        $this->gClient->setDeveloperKey('AIzaSyCICrXZ9QIYeGWXtN4O_BTLK5RVipv0EEg');
        $this->gClient->setScopes(array(               
            'https://www.googleapis.com/auth/drive.file',
            'https://www.googleapis.com/auth/drive'
        ));
        
        $this->gClient->setAccessType("offline");
        
        $this->gClient->setApprovalPrompt("force");
    }
    
   
    public function googleLogin(Request $request)  {
        
        $google_oauthV2 = new \Google_Service_Oauth2($this->gClient);

        if ($request->get('code')){

            $this->gClient->authenticate($request->get('code'));

            $request->session()->put('token', $this->gClient->getAccessToken());
        }

        if ($request->session()->get('token')){

            $this->gClient->setAccessToken($request->session()->get('token'));
        }

        if ($this->gClient->getAccessToken()){

            //FOR LOGGED IN USER, GET DETAILS FROM GOOGLE USING ACCES
            $user = User::find(1);

            $user->access_token = json_encode($request->session()->get('token'));

            $user->save();       

            dd("Successfully authenticated");
        
        } else{
            
            // FOR GUEST USER, GET GOOGLE LOGIN URL
            $authUrl = $this->gClient->createAuthUrl();

            return redirect()->to($authUrl);
        }
    }

    public function googleDriveFilePpload()
    {
        $service = new \Google_Service_Drive($this->gClient);

        $user= User::find(1);

        $this->gClient->setAccessToken(json_decode($user->access_token,true));

        if ($this->gClient->isAccessTokenExpired()) {
            
            // SAVE REFRESH TOKEN TO SOME VARIABLE
            $refreshTokenSaved = $this->gClient->getRefreshToken();

            // UPDATE ACCESS TOKEN
            $this->gClient->fetchAccessTokenWithRefreshToken($refreshTokenSaved);               
            
            // PASS ACCESS TOKEN TO SOME VARIABLE
            $updatedAccessToken = $this->gClient->getAccessToken();
            
            // APPEND REFRESH TOKEN
            $updatedAccessToken['refresh_token'] = $refreshTokenSaved;
            
            // SET THE NEW ACCES TOKEN
            $this->gClient->setAccessToken($updatedAccessToken);
            
            $user->access_token=$updatedAccessToken;
            
            $user->save();                
        }
        
        $fileMetadata = new \Google_Service_Drive_DriveFile(array(
            'name' => 'TestUpload',             // ADD YOUR GOOGLE DRIVE FOLDER NAME
            'mimeType' => 'application/vnd.google-apps.folder'));

        $folder = $service->files->create($fileMetadata, array('fields' => 'id'));

        printf("Folder ID: %s\n", $folder->id);
        
        $file = new \Google_Service_Drive_DriveFile(array('name' => 'cdrfile.mkv','parents' => array($folder->id)));

        $result = $service->files->create($file, array(

            'data' => file_get_contents(public_path('2023-10-01 15-29-21.mkv')), // ADD YOUR FILE PATH WHICH YOU WANT TO UPLOAD ON GOOGLE DRIVE
            'mimeType' => 'application/octet-stream',
            'uploadType' => 'media'
        ));

        // GET URL OF UPLOADED FILE

        $url='https://drive.google.com/open?id='.$result->id;

        dd($result);
    }
}