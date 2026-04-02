<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\Menu;
use App\Models\TurismBanner;
use App\Models\TurismContent;
use App\Models\MedicalTrip;
use App\Models\pages;

class MedicalTurism extends Controller
{
    public function index()
    {
        $page = pages::where('slug', 'medical-turism')->first();

        $data['facility'] = Facility::with('content')->first();
        $data['banner'] = TurismBanner::first();
        $data['menu'] = Menu::with('contents')->get();
        $data['content'] = TurismContent::with('subContents')->first();
        $data['trip'] = MedicalTrip::with('contents.subcontents')
            ->where('pages_id', $page?->id)
            ->first();
        
       
        return view('frondend.medical-turism.index', $data);
    }
}
