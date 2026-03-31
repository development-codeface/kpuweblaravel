<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use App\Models\banner;
use Illuminate\Http\Request;
use App\Models\features;
use App\Models\Doctor;
use App\Models\Content;
use App\Models\slider;
use App\Models\Section;
use App\Models\Blog;

class HomeController extends Controller
{
    //
    public function index()
    {
        $data['banner'] = banner::first();
        $data['features'] = features::with('featureContents')->get();
        $data['edit_content'] = Content::with('subContent')->first();
        $data['slider'] = slider::get();
        $data['edit_section'] = Section::with('subContent')->first();
        $data['blog'] = Blog::with('category')->get();
        $data['dcotor_data'] = Doctor::with('doctorDepartments.department')->where('status', 'active')->get();
        
        return view('frondend.home', $data);
    }
}
