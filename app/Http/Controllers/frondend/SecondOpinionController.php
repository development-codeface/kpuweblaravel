<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OpinionBanner;
use App\Models\OpinionContent;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\DoctorDepartment;
use App\Models\Facility;

class SecondOpinionController extends Controller
{
    //
    public function index(Request $request)
    {
        $facility = Facility::with('content')->first();
        $banner = OpinionBanner::first();
        $contents = OpinionContent::all();
        $departments = Department::all();
        $doctors = Doctor::get();

        // if ($request->department_id) {
        //     $doctor_id = DoctorDepartment::where('department_id', $request->department_id)->pluck('doctor_id');
        //     $doctors = Doctor::whereIn('id', $doctor_id)->get();

        // }else{
        //     $doctors = Doctor::all();
        // }

        return view('frondend.second_opinion.index', compact('banner', 'contents', 'departments', 'doctors','facility'));
    }

    public function getDoctors($departmentId)
    {
        $department = Department::with('doctors')->find($departmentId);
        if (!$department) {
            return response()->json([]);
        }

        return response()->json($department->doctors);
    }

    public function getDoctorDetails($id)
    {
        $doctor = Doctor::findOrFail($id);
        return response()->json($doctor);
    }

    // public function dotors(){
    //     $doctors = Doctor::all();
    //     return response()->json($doctors);
    // }
}
