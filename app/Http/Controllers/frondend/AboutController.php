<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutBanner;
use App\Models\AboutBlog;
use App\Models\AboutContent;
use App\Models\AboutFeature;
use App\Models\AboutSubContent;
use App\Models\AboutMidContent;
use App\Models\AboutSection;
use App\Models\Facility;

class AboutController extends Controller
{
    //
    public function index()
    {
        $data['section']  = AboutSection::with('subSection')->first();
        $data['mid_content'] = AboutMidContent::with('aboutMidSubContent')->first();
        // dd($data['mid_content']);
        $data['sub_content'] = AboutSubContent::first();
        $data['about_feature'] = AboutFeature::with('featureContents')->get();
        $data['blog'] = AboutBlog::where('status', 1)->first();
        $data['banner'] = AboutBanner::where('status', 'active')->first();
        $data['content'] = AboutContent::first();
        $data['facility'] = Facility::with('content')->first();
        return view('frondend.about.index', $data);
    }
}
