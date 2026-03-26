<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VisionBanner;
use App\Models\VisionSection;
use App\Models\VisionContent;
use App\Models\Facility;

class VisionController extends Controller
{
    //
    public function index()
    {
        $edit_banner = VisionBanner::first();
        $edit_section = VisionSection::get();
        $edit_content = VisionContent::with('subContent')->first();
        $facility = Facility::with('content')->first();
        return view('frondend.vision.index', compact('edit_banner', 'edit_section','edit_content','facility'));
    }
}
