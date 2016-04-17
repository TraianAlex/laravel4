<?php

namespace App\MyClass;

class First {

	public $param1 = "param1";

    // public function __construct() {
    //     parent::__construct();
    // }

    public function func1() {
        return $this->param1.' and some1';
    }
}