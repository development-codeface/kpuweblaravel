<?php

namespace App\Http\Controllers\frondend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\SpacialityBanner;
use App\Models\SpacialityBlog;
use App\Models\SpacialityContent;
use App\Models\SpacialityFeature;
use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\pages;

class SpacialityController extends Controller
{
    public function index(Request $request)
    {
        $page = pages::whereIn('slug', ['spaciality', 'speciality', 'specialities'])->first();
        $pageId = $page?->id;
        $departmentId = $request->integer('department_id') ?: null;

        $doctorQuery = Doctor::with('doctorDepartments.department')
            ->where('status', 'active');

        if ($departmentId) {
            $doctorQuery->whereHas('doctorDepartments', function ($query) use ($departmentId) {
                $query->where('department_id', $departmentId);
            });
        }

        $data['selectedDepartment'] = $departmentId ? Department::find($departmentId) : null;
        $data['banner'] = $this->getSpacialityRecord(SpacialityBanner::class, $pageId, $departmentId) ?? new SpacialityBanner();
        $data['feature'] = $this->getSpacialityRecord(SpacialityFeature::class, $pageId, $departmentId, ['featureContents']) ?? new SpacialityFeature();
        $data['doctors'] = $doctorQuery->get();
        $data['contents'] = $this->getSpacialityRecord(SpacialityContent::class, $pageId, $departmentId, ['subContents']) ?? new SpacialityContent();
        $data['blog'] = $this->getSpacialityRecords(SpacialityBlog::class, $pageId, $departmentId);
        $data['facility'] = Facility::with('content')->first();

        return view('frondend.spaciality.index', $data);
    }

    private function getSpacialityRecord(string $modelClass, ?int $pageId = null, ?int $departmentId = null, array $with = [])
    {
        if ($pageId) {
            if ($departmentId) {
                $departmentQuery = $modelClass::query();

                if (!empty($with)) {
                    $departmentQuery->with($with);
                }

                $departmentRecord = $departmentQuery
                    ->where('pages_id', $pageId)
                    ->where('department_id', $departmentId)
                    ->first();

                if ($departmentRecord) {
                    return $departmentRecord;
                }
            }

            $defaultQuery = $modelClass::query();

            if (!empty($with)) {
                $defaultQuery->with($with);
            }

            $defaultRecord = $defaultQuery
                ->where('pages_id', $pageId)
                ->where(function ($departmentQuery) {
                    $departmentQuery->whereNull('department_id')
                        ->orWhere('department_id', 0);
                })
                ->first();

            if ($defaultRecord) {
                return $defaultRecord;
            }
        }

        $fallbackQuery = $modelClass::query();

        if (!empty($with)) {
            $fallbackQuery->with($with);
        }

        return $fallbackQuery->first();
    }

    private function getSpacialityRecords(string $modelClass, ?int $pageId = null, ?int $departmentId = null, array $with = [])
    {
        if ($pageId) {
            if ($departmentId) {
                $departmentQuery = $modelClass::query();

                if (!empty($with)) {
                    $departmentQuery->with($with);
                }

                $departmentRecords = $departmentQuery
                    ->where('pages_id', $pageId)
                    ->where('department_id', $departmentId)
                    ->get();

                if ($departmentRecords->isNotEmpty()) {
                    return $departmentRecords;
                }
            }

            $defaultQuery = $modelClass::query();

            if (!empty($with)) {
                $defaultQuery->with($with);
            }

            $defaultRecords = $defaultQuery
                ->where('pages_id', $pageId)
                ->where(function ($departmentQuery) {
                    $departmentQuery->whereNull('department_id')
                        ->orWhere('department_id', 0);
                })
                ->get();

            if ($defaultRecords->isNotEmpty()) {
                return $defaultRecords;
            }
        }

        $fallbackQuery = $modelClass::query();

        if (!empty($with)) {
            $fallbackQuery->with($with);
        }

        return $fallbackQuery->get();
    }
}
