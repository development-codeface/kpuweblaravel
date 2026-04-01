<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\Menu;
use App\Models\MedicalTrip;
use App\Models\FeatureService;
use App\Models\InterContent;
use App\Models\Internationalbanner;
use App\Models\InterService;

class InternationalController extends Controller
{
    public function index()
    {
        $data['facility'] = Facility::with('content')->first();
        $data['banner'] = Internationalbanner::first();
        $data['menu'] = Menu::with('contents')->get();
        $data['content'] = FeatureService::with('subContents')->first();
        $data['trip']    = MedicalTrip::with('contents.subcontents')->first();
        $data['content'] = InterService::with('subContents')->first();
        $data['section'] = InterContent::with('subContents')->first();
        return view('frondend.hospital-international.index', $data);
    }
}
