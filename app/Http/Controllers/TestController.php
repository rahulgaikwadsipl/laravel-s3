<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;


class TestController extends Controller
{


    /**
    * Create view file
    *
    * @return void
    */
    public function testMe()
    {
    	echo 'test-me';die;
    }

}
