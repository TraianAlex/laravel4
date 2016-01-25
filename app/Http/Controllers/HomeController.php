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
}