<?php

namespace App\Http\Controllers\DocumentRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentRequestAdminController extends Controller
{
    public function adminDashboard(){
        return view ('documentRequest.adminRequest.adminDashboard');
    }
}
