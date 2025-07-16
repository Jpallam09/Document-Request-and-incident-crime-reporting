<?php

namespace App\Http\Controllers\DocumentRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentRequestStaffController extends Controller
{
    public function staffDashboard(){
        return view ('documentRequest.staffRequest.staffDashboard');
    }
}
