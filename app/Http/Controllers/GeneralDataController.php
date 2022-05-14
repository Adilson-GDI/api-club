<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\{
    Gender,
    Segment,
    Occupation,
    ActingRegion,
    MaritalStatus
};

class GeneralDataController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function maritalStatus(): JsonResponse
    {
        return $this->response('OK', 200, MaritalStatus::get()->toArray());
    }

    /**
     * @return JsonResponse
     */
    public function segments(): JsonResponse
    {
        return $this->response('OK', 200, Segment::active()->get()->toArray());
    }

    /**
     * @return JsonResponse
     */
    public function regions(): JsonResponse
    {
        return $this->response('OK', 200, ActingRegion::active()->get()->toArray());
    }

    /**
     * @return JsonResponse
     */
    public function occupations(): JsonResponse
    {
        return $this->response('OK', 200, Occupation::get()->toArray());
    }

    /**
     * @return JsonResponse
     */
    public function genders(): JsonResponse
    {
        return $this->response('OK', 200, Gender::get()->toArray());
    }
}
