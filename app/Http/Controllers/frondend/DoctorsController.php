<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;

class DoctorsController extends Controller
{

    public function index()
    {
        $data['dcotor_data'] = Doctor::with('doctorDepartments.department')->where('status', 1)->get();
        
        return view('frondend.doctors.index', $data);
    }

    public function search(Request $request)
    {
        $query = $request->q;

        $dcotor_data = Doctor::with('doctorDepartments.department')
            ->where('status', 'active')
            ->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                    ->orWhereHas('doctorDepartments.department', function ($dq) use ($query) {
                        $dq->where('name', 'LIKE', "%{$query}%");
                    });
            })
            ->get();

        return view('frondend.doctors.index', compact('dcotor_data'));
    }
}
