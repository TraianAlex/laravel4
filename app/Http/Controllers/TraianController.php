<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\MyClass\First;

class TraianController extends Controller
{
    public function getIndex(First $first)
    {
    	return $first->func1();
    }
}