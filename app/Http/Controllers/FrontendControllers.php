<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendControllers extends Controller
{
        Function about()
        {
            return view('layouts.about');
        }
        function welcome()
        {
            return view('layouts.welcome');
        }
}
