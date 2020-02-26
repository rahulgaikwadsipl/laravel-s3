<?php

/*namespace App\Http\Controllers;

use Illuminate\Http\Request;

class S3ImageController extends Controller
{
    //
}*/

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Storage;

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\S3\MultipartUploader;
use Aws\Exception\MultipartUploadException;



class S3ImageController extends Controller
{


    /**
    * Create view file
    *
    * @return void
    */
    public function imageUpload()
    {
    	return view('image-upload');
    }


    /**
    * Manage Post Request
    *
    * @return void
    */
    public function imageUploadPost(Request $request)
    {
    	$this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $image = $request->file('image');
        
        //$upload = Storage::disk('s3')->put($imageName, file_get_contents($image), 'public');

        $upload = Storage::disk('s3')->put($imageName, file_get_contents($image));
        //$imageName = Storage::disk('s3')->url($imageName);


        //===create signed URL===================
        $s3 = \Storage::disk('s3');

		$client = $s3->getDriver()->getAdapter()->getClient();
		$expiry = "+1 minutes";

		$command = $client->getCommand('GetObject', [
		    'Bucket' => \Config::get('filesystems.disks.s3.bucket'),
		    'Key'    => $imageName
		]);

		$request = $client->createPresignedRequest($command, $expiry);

		$url= (string) $request->getUri();


    	return back()
    		->with('success','Image Uploaded successfully.')
    		->with('path',$url);
    }

   public function imageDelete()
   {

       $image=request()->segment(count(request()->segments()));

       $s3 = \Storage::disk('s3');
       $delete=$s3->delete($image);
 
       if($delete){
            return back()->withSuccess('Image was deleted successfully');
       }else{
            return back()->withErrors('Error in image deletion !');
       } 
       
   }

    public function uploadToS3Multipart(Request $request)
    {
        //$fromPath, $toPath
        $this->validate($request, [
            'image' => 'required|max:51200',
        ]);
        $toPath = time().'.'.$request->image->getClientOriginalExtension();
        
        $fromPath = $request->file('image');

        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $image = $request->file('image');
        $disk = \Storage::disk('s3');
        $uploader = new MultipartUploader($disk->getDriver()->getAdapter()->getClient(), $fromPath, [
            'bucket' => \Config::get('filesystems.disks.s3.bucket'),
            'key'    => $toPath,
        ]);

        try {
            $result = $uploader->upload();
            return back()->withSuccess('File Uploaded successfully');
       
        } catch (MultipartUploadException $e) {
            //echo $e->getMessage();
            return back()->withSuccess($e->getMessage());
        }
    }
}
