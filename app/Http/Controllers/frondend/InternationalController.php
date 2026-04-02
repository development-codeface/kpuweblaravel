<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\InterMedicalTrip;
use App\Models\Menu;
use App\Models\FeatureService;
use App\Models\InterContent;
use App\Models\Internationalbanner;
use App\Models\InterService;
use App\Models\pages;

class InternationalController extends Controller
{
    public function index()
    {
        $page = pages::where('slug', 'hospital-international')->first();

        $data['facility'] = Facility::with('content')->first();
        $data['banner'] = Internationalbanner::first();
        $data['menu'] = Menu::with('contents')->get();
        $data['content'] = FeatureService::with('subContents')->first();
        $data['trip'] = InterMedicalTrip::with('contents.subcontents')
            ->where('pages_id', $page?->id)
            ->first();
        $data['content'] = InterService::with('subContents')->first();
        $data['section'] = InterContent::with('subContents')->first();
        return view('frondend.hospital-international.index', $data);
    }
}
