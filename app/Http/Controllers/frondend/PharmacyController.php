<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PharmacyBanner;
use App\Models\PharmacyContent;
use App\Models\PharmacySubContent;
use App\Models\PharmacyPlans;
use App\Models\PharmacyPlansContent;

class PharmacyController extends Controller
{
    //
    public function index()
    {
        $data['plans_content'] = PharmacyPlansContent::get();
        $data['plans'] = PharmacyPlans::get();
        $data['content'] = PharmacyContent::with('subContents')->first();
        // dd($data['content']);
        $data['banner'] = PharmacyBanner::get()->first();
        return view('frondend.pharmacy.index',$data);
    }
}
