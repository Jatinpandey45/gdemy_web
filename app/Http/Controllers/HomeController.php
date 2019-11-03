<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
        /**
         * index
         * @param : null
         * @return : applicaton/html
         */

         public function index()
         {
                return view('home.index');
         }

         /**
          * 
          */
}
