<?php

namespace App\Http\Controllers;

use App\Http\Responses\BaseResponse;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\User;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, BaseResponse;

    protected int $perPage = 20;

    /**
     * Configura limite de páginaçao quando informado via request com o parametro perPage
     *
     * @param $request
     * @return void
     */
    public function setPerPage($request): void
    {
        $perPage = $request->perPage;

        if (
            !empty($perPage)
            && is_numeric($perPage)
            && ($perPage < 100)
        ){
            $this->perPage = $perPage;
        }
    }



}
