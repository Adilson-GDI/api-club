<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator as ValidatorFacade;

class LoginController extends Controller
{
    /**
     * Verify if user has access and return a token case true
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $validator = $this->validation($request);

        if ($validator->fails()) {
            return $this->response('Os dados informados não são válidos', 406, [], $validator->errors()->toArray());
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->response('Credenciais inválidas', 406);
        }

        $token = $user->createPersonalAccessToken()->accessToken;

        return $this->response('OK', 200, ['token' => $token]);
    }

    /**
     * Valida dados de login do usuário
     *
     * @param  Request $request
     * @return Validator
     */
    public function validation(Request $request): Validator
    {
        return ValidatorFacade::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
    }

    /**
     * User without authorization
     *
     * @return JsonResponse
     */
    public function unauthorized()
    {
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
