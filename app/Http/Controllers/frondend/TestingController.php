<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\Menu;
use App\Models\FeatureService;
use App\Models\TestingBanner;
use App\Models\TestingService;

class TestingController extends Controller
{
    public function index()
    {
        $data['facility'] = Facility::with('content')->first();
        $data['banner'] = TestingBanner::first();
        $data['menu'] = Menu::with('contents')->get();
        $data['content'] = TestingService::with('subContents')->first();
        return view('frondend.testing.index', $data);
    }
}
