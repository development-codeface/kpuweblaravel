<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomsType;
use App\Models\RoomBanner;
use App\Models\Facility;

class RoomController extends Controller
{
    //
    public function index()
    {
        $edit_rooms = RoomsType::with('specRooms')->get();
        $edit_banner = RoomBanner::first();
        $facility = Facility::with('content')->first();
        return view('frondend.room.index',compact('edit_rooms','edit_banner','facility'));
    }
}
