<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use App\Models\RehabBanner;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Facility;
use App\Models\FeatureService;

class RehabController extends Controller
{
    public function index()
    {
        $data['facility'] = Facility::with('content')->first();
        $data['banner'] = RehabBanner::first();
        $data['menu'] = Menu::with('contents')->get();
        $data['content'] = FeatureService::with('subContents')->first();
        
        return view('frondend.rehab.index', $data);
    }
}
