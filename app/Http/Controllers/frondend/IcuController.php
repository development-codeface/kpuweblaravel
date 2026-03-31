<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Icu;
use App\Models\IcuFeature;
use App\Models\Menu;

class IcuController extends Controller
{
    //

    public function index()
    {
        $data['banner'] = Icu::first();
        $pageId = $data['banner']->pages_id ?? null;

        $data['facility'] = Facility::with('content')->first();
        $data['feature_data'] = IcuFeature::with('featureContents')
            ->when($pageId, function ($query) use ($pageId) {
                $query->where('pages_id', $pageId);
            })
            ->first();
        $data['menu'] = Menu::with('contents')->get();


        return view('frondend.icu.index', $data);
    }
}
