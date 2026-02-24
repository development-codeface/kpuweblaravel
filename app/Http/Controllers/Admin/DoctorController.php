<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\DoctorDepartment;
use App\Models\Department;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['doctors'] = Doctor::all();
        return view('admin.doctor.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = \App\Models\Department::pluck('name', 'id');
        return view('admin.doctor.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'designation' => 'required',
            'departments' => 'required|array',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // destination path
        $destinationPath = public_path('images/doctors');

        // create folder if not exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // move file
        $image->move($destinationPath, $imageName);

        $user_id = auth()->id();

        $doctor = Doctor::create([
            'name' => $request->name,
            'description' => $request->description,
            'designation' => $request->designation,
            'image' => 'images/doctors/' . $imageName,
            'created_by' => $user_id,
        ]);

        $departments = $request->departments;
        foreach ($departments as $departmentId) {
            DoctorDepartment::create([
                'doctor_id' => $doctor->id,
                'department_id' => $departmentId,
            ]);
        }
        return redirect()->route('admin.doctor.index')->with('success', 'Doctor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edit = Doctor::with('doctorDepartments.department')->findOrFail($id);

        // All departments for select box
        $departments = Department::pluck('name', 'id');

        // Selected department IDs
        $selectedDepartments = $edit->doctorDepartments
            ->pluck('department_id')
            ->toArray();

        return view('admin.doctor.edit', compact(
            'edit',
            'departments',
            'selectedDepartments'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'designation' => 'required',
            'departments' => 'required|array'
        ]);

        // Image update (optional)
        if ($request->hasFile('image')) {

            // delete old image
            if ($doctor->image && file_exists(public_path($doctor->image))) {
                unlink(public_path($doctor->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/doctors');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $doctor->image = 'images/doctors/' . $imageName;
        }else{
            $imageName = basename($doctor->image);
        }

        // Update doctor
        $doctor->update([
            'name' => $request->name,
            'description' => $request->description,
            'designation' => $request->designation,
            'image' => 'images/doctors/' . $imageName,
        ]);

        // Update departments
        DoctorDepartment::where('doctor_id', $doctor->id)->delete();

        foreach ($request->departments as $departmentId) {
            DoctorDepartment::create([
                'doctor_id' => $doctor->id,
                'department_id' => $departmentId,
            ]);
        }

        return redirect()
            ->route('admin.doctor.index')
            ->with('success', 'Doctor updated successfully.');
    }

    /**
     * Remove the specified status change.
     */
    public function statusChange($id)
    {
        $doctor = Doctor::findOrFail($id);
        if ($doctor->status == 'active') {
            $doctor->status = 'inactive';
        } else {
            $doctor->status = 'active';
        }
        $doctor->save();
        return redirect()->route('admin.doctor.index')->with('success', 'Doctor status updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DoctorDepartment::where('doctor_id', $id)->delete();
        $doctor = Doctor::findOrFail($id);

        // delete image
        if ($doctor->image && file_exists(public_path($doctor->image))) {
            unlink(public_path($doctor->image));
        }

        $doctor->delete();

        return redirect()->route('admin.doctor.index')->with('success', 'Doctor deleted successfully.');
    }
}
