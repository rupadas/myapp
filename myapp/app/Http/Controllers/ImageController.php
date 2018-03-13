<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use WindowsAzure\Common\ServicesBuilder;
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;
use MicrosoftAzure\Storage\Common\ServiceException;
use App\Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class ImageController extends Controller
{
    private $accountKey = "6tqllz4AXJSrDOg5h4YzBEm8u0/6bROTSLD/TC5kFMsZNO5hEH0tAS/atEu/FprOZWA/fv+WBqpsAHIN/Mx+mw==";

    private $accountName = "fopcontainer";

    public function createBlob (Request $request)
    {
        
        // print_r($request->all())
        $connectionString = "DefaultEndpointsProtocol=https;AccountName=" .$this->accountName . ";AccountKey=" . $this->accountKey;

        // Create blob REST proxy.
        $blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connectionString);

        //If Request file is an array
        
        $file = $request->file('image');

        //Create Image Instance
        $imagecontroller = new ImageController();

        if($file) {

            //Get original file name and extension
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            //GET file name without extension
            $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - strlen($extension) - 1);

            //Santitize file name
            $allowed_filename = $imagecontroller->sanitize($originalNameWithoutExt);

            //Recreate file name
            $fileName = $imagecontroller->createUniqueFilename( $allowed_filename, $extension );

            if (is_readable($file)) {
                $content = fopen($file, "r");
            } else {
                return false;
            } 
        } 
          
        $blob_name = "myblob";
        
        try {
            // Upload blob
            $temp = $blobRestProxy->createBlockBlob("dev", $fileName, $content);
            
            // create image model entry
            $image = Image::create([
                'name' => $fileName, 
                'path' => ' https://'.$this->accountName.'.blob.core.windows.net/dev/'.$fileName
            ]);
            //return $image;
            //return response()->json($image);
            return response()->json(
            [
                'status' => '200',
                'description' => "Image Upoaded",
            ]);
        } catch (ServiceException $e) {
            // Handle exception based on error codes and messages.
            // Error codes and messages are here:
            // http://msdn.microsoft.com/library/azure/dd179439.aspx
            //return false;
            return response()->json(
            [
                'status' => '400',
                'description' => "Something went wrong",
            ]);
        }
    }

    //Sanitize
    function sanitize($string, $force_lowercase = true, $anal = false)
    {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }

    //Create file name after sanitize
    public function createUniqueFilename( $filename, $extension )
    {
        return $filename . '.' . $extension;
    }
}
