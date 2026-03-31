<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use App\Models\HealthPackagecontent;
use Illuminate\Http\Request;
use App\Models\HealthPakageBanner;
use Illuminate\Support\Facades\DB;
use App\Models\HealthPackageBlog;
use App\Models\Facility;


class HealthPackageController extends Controller
{
    public function index()
    {
        $data['banner']   = HealthPakageBanner::first();
        $data['category'] = DB::table('category')->select('id', 'name')->get();
        $data['blog']     = HealthPackageBlog::all();
        $data['content']  = HealthPackagecontent::first();
        $data['facility'] = Facility::with('content')->first();
        return view('frondend.package.index', $data);
    }
}
