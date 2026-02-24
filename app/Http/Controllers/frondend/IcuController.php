<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Icu;
use App\Models\Menu;
use App\Models\IcuContent;
use App\Models\IcuSubContent;
use App\Models\IcuFeature;
use App\Models\features;
use App\Models\Facility;

class IcuController extends Controller
{
    //

    public function index()
    {
        $data['facility'] = Facility::with('content')->first();
        $data['feature_data'] = features::with('featureContents')->first();
        $data['banner'] = Icu::first();
        $data['menu'] = Menu::where('pages_id', 12)->get();
        return view('frondend.icu.index', $data);
    }
}
