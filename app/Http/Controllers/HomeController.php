<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\Filesystem;//default driver (local)
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Filesystem\Filesystem as Flysystem;
use League\Flysystem\AwsS3v3\AwsS3Adapter;//?

class HomeController extends Controller
{
    public function getIndex()
    {
    	return view('home');
    }

    public function getFiles(Filesystem $filesystem)
    {
    	$file = $filesystem->get('test.txt');
    	return $file;
    	//$file = $filesystem->append('test.txt', 'how are you');
    	//return $filesystem->get('test.txt');
        //\File::get('test.txt');
    }

    //can change the default driver local or s3
    public function getLocal(Filesystem $filesystem)
    {
    	$filesystem->put('test.txt', 'I am using local');
    	return 'done';
    }

    public function getLocal2(Factory $factory)
    {
    	$factory->disk('local')->put('test.txt', 'I am using local driver');
    	return 'done';
    }

    public function getAwss3(Factory $factory)
    {
    	$factory->disk('s3')->put('test2.txt', 'aws3 - I am using aws s3');
    	return 'done';
    }

    public function getAws2(Cloud $cloud)
    {
        $cloud->put('test3.txt', 'cloud - I am using aws s3');
        //$cloud->get('test3.txt');//, append(), files()
        return 'done';
    }

    public function getAws()
    {
        //local
    	//\Storage::put('test2.txt', 'test2 - I am using aws s3');//$contents
    	//cloud
        //\Storage::disk('s3')->put('test1.txt', 'aws - I am using aws s3');
        $exists = \Storage::disk('s3')->has('test1.txt');
        if($exists){
            $contents = \Storage::disk('s3')->get('test1.txt');
            return $contents;
        }
    }

    //put in public local driver
    public function getTest(Flysystem $cloud)
    {
    	$cloud->put('test4.txt', 'xxxI am using aws s31');
    	//$cloud->get(), append(), files()
    	return 'done';
    }

    public function getDelete()
    {
        $exists = \Storage::disk('s3')->has('test3.txt');
        if($exists){
            \Storage::disk('s3')->delete('test3.txt');
            return 'done';
        }
    }

/*-----------------------------------------------------------------------*/

    public function getTest2(AwsS3Adapter $cloud)
    {
    	$cloud->write('', 'test5.txt', 'to fix I am using aws s31');
    	//$cloud->get(), append(), files()
    	return 'done';
    }

    /*----------------------------------------------------------------*/
    
    public function getMys3()
    {
        $access_key         = env('ACCESS_KEY'); //Access Key  iam-user-access-key
        $secret_key         = env('SECRET_KEY'); //Secret Key iam-user-secret-key
        $my_bucket          = env('BUCKET'); //bucket name 
        $region             = env('AWS_REGION'); //bucket region us-east-1 Oregon
        $success_redirect   = 'http://'. $_SERVER['SERVER_NAME'] . ":8000" . $_SERVER['REQUEST_URI']; //URL to which the client is redirected upon success (currently self) 
        $allowd_file_size   = "1048579"; //1 MB allowed Size

        //dates
        $short_date         = gmdate('Ymd'); //short date
        $iso_date           = gmdate("Ymd\THis\Z"); //iso format date
        $expiration_date    = gmdate('Y-m-d\TG:i:s\Z', strtotime('+1 hours')); //policy expiration 1 hour from now

        //POST Policy required in order to control what is allowed in the request
        //For more info http://docs.aws.amazon.com/AmazonS3/latest/API/sigv4-HTTPPOSTConstructPolicy.html
        $policy = utf8_encode(json_encode(array(
                            'expiration' => $expiration_date,  
                            'conditions' => array(
                                array('acl' => 'public-read'),  
                                array('bucket' => $my_bucket), 
                                array('success_action_redirect' => $success_redirect),
                                array('starts-with', '$key', ''),
                                array('content-length-range', '1', $allowd_file_size), 
                                array('x-amz-credential' => $access_key.'/'.$short_date.'/'.$region.'/s3/aws4_request'),
                                array('x-amz-algorithm' => 'AWS4-HMAC-SHA256'),
                                array('X-amz-date' => $iso_date)
                                )))); 

        //Signature calculation (AWS Signature Version 4)   
        //For more info http://docs.aws.amazon.com/AmazonS3/latest/API/sig-v4-authenticating-requests.html  
        $kDate = hash_hmac('sha256', $short_date, 'AWS4' . $secret_key, true);
        $kRegion = hash_hmac('sha256', $region, $kDate, true);
        $kService = hash_hmac('sha256', "s3", $kRegion, true);
        $kSigning = hash_hmac('sha256', "aws4_request", $kService, true);
        $signature = hash_hmac('sha256', base64_encode($policy), $kSigning);
        
        return view('s3.s3', compact('my_bucket', 'access_key', 'short_date', 'region', 'iso_date', 'policy', 'signature', 'success_redirect'));
    }

    public function getMylist()
    {
        
    }
}