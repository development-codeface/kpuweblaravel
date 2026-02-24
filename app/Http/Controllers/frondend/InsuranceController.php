<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use App\Models\InsuranceBanner;
use Illuminate\Http\Request;
use App\Models\InsuranceContent;

class InsuranceController extends Controller
{
    //
    public function index()
    {
        $data['banner'] = InsuranceBanner::first();
        $data['contents'] = InsuranceContent::with('subContents')->first();
        return view('frondend.insurance.index', $data);
    }
}
