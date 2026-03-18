<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use App\Models\banner;
use Illuminate\Http\Request;
use App\Models\features;
use App\Models\Doctor;

class HomeController extends Controller
{
    //
    public function index()
    {
        $data['banner'] = banner::where('status', 1)->first();
        $data['features'] = features::with('featureContents')->get();
        $data['dcotor_data'] = Doctor::with('doctorDepartments.department')->where('status', 'active')->get();
        return view('frondend.home', $data);
    }
}
