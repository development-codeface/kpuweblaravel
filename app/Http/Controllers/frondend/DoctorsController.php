<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Facility;

class DoctorsController extends Controller
{

    public function index()
    {
        return $this->renderDoctorsPage();
    }

    public function search(Request $request)
    {
        $query = $request->q;

        return $this->renderDoctorsPage($query);
    }

    protected function renderDoctorsPage(?string $query = null)
    {
        $doctorQuery = Doctor::with('doctorDepartments.department')
            ->where('status', 'active');

        if (!empty($query)) {
            $doctorQuery->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                    ->orWhereHas('doctorDepartments.department', function ($dq) use ($query) {
                        $dq->where('name', 'LIKE', "%{$query}%");
                    });
            });
        }

        $data['dcotor_data'] = $doctorQuery->get();
        $data['facility'] = Facility::with('content')->first();

        return view('frondend.doctors.index', $data);
    }
}
