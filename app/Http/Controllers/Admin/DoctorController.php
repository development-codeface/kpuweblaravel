<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\DoctorDepartment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

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
            'name'              => 'required|string|max:255',
            'description'       => 'required',
            'designation'       => 'required',
            'departments'       => 'required|array',
            'image'             => 'required|image|mimes:jpg,jpeg,png',
            'seo_title'         => 'nullable|string|max:255',
            'seo_description'   => 'nullable|string',
            'seo_author'        => 'nullable|string|max:255',
            'seo_robots'        => 'nullable|string|max:255',
            'seo_canonical_url' => 'nullable|url|max:2048',
            'seo_image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user_id = auth()->id();
        $imagePath = $this->storeUploadedImage($request->file('image'), 'images/doctors');

        $doctor = Doctor::create([
            'name' => $request->name,
            'description' => $request->description,
            'designation' => $request->designation,
            'image' => $imagePath,
            'created_by' => $user_id,
        ]);

        $this->syncSeoData($doctor, $request, 'images/doctors/seo');

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
            'name'              => 'required|string|max:255',
            'description'       => 'required',
            'designation'       => 'required',
            'departments'       => 'required|array',
            'seo_title'         => 'nullable|string|max:255',
            'seo_description'   => 'nullable|string',
            'seo_author'        => 'nullable|string|max:255',
            'seo_robots'        => 'nullable|string|max:255',
            'seo_canonical_url' => 'nullable|url|max:2048',
            'seo_image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Image update (optional)
        $imagePath = $doctor->image;

        if ($request->hasFile('image')) {
            $this->deleteUploadedImage($doctor->image);
            $imagePath = $this->storeUploadedImage($request->file('image'), 'images/doctors');
        }

        // Update doctor
        $doctor->update([
            'name' => $request->name,
            'description' => $request->description,
            'designation' => $request->designation,
            'image' => $imagePath,
        ]);

        $this->syncSeoData($doctor, $request, 'images/doctors/seo');

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

    private function syncSeoData(Model $model, Request $request, string $directory): void
    {
        $existingSeo = $model->seo()->first();
        $seoImagePath = $existingSeo?->image;

        if ($request->hasFile('seo_image')) {
            $this->deleteUploadedImage($seoImagePath);
            $seoImagePath = $this->storeUploadedImage($request->file('seo_image'), $directory);
        }

        $seoPayload = [
            'title'         => $request->filled('seo_title') ? $request->input('seo_title') : null,
            'description'   => $request->filled('seo_description') ? $request->input('seo_description') : null,
            'author'        => $request->filled('seo_author') ? $request->input('seo_author') : null,
            'robots'        => $request->filled('seo_robots') ? $request->input('seo_robots') : null,
            'canonical_url' => $request->filled('seo_canonical_url') ? $request->input('seo_canonical_url') : null,
            'image'         => $seoImagePath,
        ];

        $hasSeoData = collect($seoPayload)->contains(fn ($value) => filled($value));

        if (! $hasSeoData) {
            if ($existingSeo) {
                $this->deleteUploadedImage($existingSeo->image);
                $existingSeo->delete();
            }

            return;
        }

        if ($existingSeo) {
            $existingSeo->update($seoPayload);
            return;
        }

        $model->seo()->create($seoPayload);
    }

    private function storeUploadedImage(UploadedFile $image, string $directory): string
    {
        $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path($directory);

        if (! file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $image->move($destinationPath, $imageName);

        return trim($directory, '/\\') . '/' . $imageName;
    }

    private function deleteUploadedImage(?string $path): void
    {
        if ($path && file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }
}
