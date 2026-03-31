<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PharmacyBanner;
use App\Models\PharmacyContent;
use App\Models\PharmacySubContent;
use App\Models\PharmacyPlans;
use App\Models\PharmacyPlansContent;
use App\Models\Facility;

class PharmacyController extends Controller
{
    //
    public function index()
    {
        $data['facility'] = Facility::with('content')->first();
        $data['plans_content'] = PharmacyPlansContent::get();
        $data['plans'] = PharmacyPlans::get();
        $data['content'] = PharmacyContent::with('subContents')->first();
        // dd($data['content']);
        $data['banner'] = PharmacyBanner::get()->first();
        
        return view('frondend.pharmacy.index', $data);
    }
}
