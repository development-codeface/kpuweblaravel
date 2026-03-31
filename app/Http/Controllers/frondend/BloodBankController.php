<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BloodBank;
use App\Models\BloodBankContent;
use App\Models\BloodGroup;
use App\Models\Facility;

class BloodBankController extends Controller
{
    //

    public function index()
    {
        $data['blood_banks'] = BloodBank::first();
        $data['blood_contents'] = BloodBankContent::with('sub_content')->first();
        $data['blood_groups'] = BloodGroup::where('status', 1)->get();
         $data['facility'] = Facility::with('content')->first();
        return view('frondend.blood_bank.index',$data);
    }
}
