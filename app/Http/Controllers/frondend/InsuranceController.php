<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use App\Models\InsuranceBanner;
use Illuminate\Http\Request;
use App\Models\InsuranceContent;
use App\Models\Facility;

class InsuranceController extends Controller
{
    //
    public function index()
    {
        $data['banner'] = InsuranceBanner::first();
        $data['contents'] = InsuranceContent::with('subContents')->first();
        $data['facility'] = Facility::with('content')->first();
        return view('frondend.insurance.index', $data);
    }
}
