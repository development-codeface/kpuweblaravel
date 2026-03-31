<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\features;
use App\Models\SpacialityBanner;
use App\Models\SpacialityBlog;
use App\Models\SpacialityContent;
use Illuminate\Http\Request;

class SpacialityController extends Controller
{
    public function index()
    {
        $data['banner']  = SpacialityBanner::first();
        $data['feature'] = features::with('featureContents')->first();
        $data['doctors'] = Doctor::get();
        $data['contents'] = SpacialityContent::with('subContents')->first();
        $data['blog']   = SpacialityBlog::get();
        
        return view('frondend.spaciality.index',$data);
    }
}
