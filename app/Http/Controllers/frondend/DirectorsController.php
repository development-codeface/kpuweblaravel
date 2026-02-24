<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DirectorBanner;
use App\Models\DirectorContent;
use App\Models\PharmacyPlansContent;
use App\Models\Facility;

class DirectorsController extends Controller
{
    //
    public function index()
    {
        $data['facility'] = Facility::with('content')->first();
        $data['banner'] = DirectorBanner::first();
        $data['blogs_data'] = DirectorContent::with('directorBlog')->first();
        $data['contents'] = PharmacyPlansContent::get();
        return view('frondend.directors.index',$data);
    }
}
