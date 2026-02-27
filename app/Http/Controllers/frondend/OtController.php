<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\OtBanner;
use App\Models\Menu;
use App\Models\FeatureService;

class OtController extends Controller
{
    //
    public function index()
    {
        $data['facility'] = Facility::with('content')->first();
        $data['banner'] = OtBanner::first();
        $data['menu'] = Menu::with('contents')->get();
         $data['content'] = FeatureService::with('subContents')->first();
        return view('frondend.hospital_ot.index', $data);
    }
}
