<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AmbulanceBanner;
use App\Models\AmbulanceContent;
use App\Models\Facility;

class AmbulanceController extends Controller
{
    //
    public function index()
    {
        $data['banner'] = AmbulanceBanner::first();
        $data['contents'] = AmbulanceContent::with('sub_content')->first();
        $data['facility'] = Facility::with('content')->first();
        return view('frondend.ambulance.index',$data);
    }
}
