<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CareerBanner;
use App\Models\CareerContent;

class CareerController extends Controller
{
    //
    public function index()
    {
       $data['career_content'] = CareerContent::latest()->paginate(6);
        $data['banner'] = CareerBanner::first();
        
        return view('frondend.career.index',$data);
    }
}
