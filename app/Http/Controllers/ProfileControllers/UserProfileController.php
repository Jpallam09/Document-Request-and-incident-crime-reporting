<?php

namespace App\Http\Controllers\ProfileControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserProfileController extends Controller
{
    Public function show (){
        $user = auth()->user();
        return view ('user.report.userProfile');
    }

    public function updateInfo(){

    }

}
