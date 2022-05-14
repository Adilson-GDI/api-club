<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

trait BaseResponse
{
    /**
     * @var array|string[]
     */
    protected array $response = [
        'message' => ''
    ];

    /**
     * Header default to all resource
     *
     * @var string[]
     */
    protected $headers = [
        'Content-Type' => 'application/json'
    ];

    /**
     * Método para resposta padrão às requisições da aplicação
     *
     * @param $message String
     * @param $httpStatus int
     * @param $data array
     * @param $errors array
     * @param $headers array
     * @return JsonResponse
     */
    public function response(String $message, int $httpStatus, array $data = [], array $errors = [], array $headers = []): JsonResponse
    {
        $this->response['message'] = $message;

        if (!empty($headers)) {
            array_push($this->headers, $headers);
        }

        if (!empty($data)) {
            $this->response['data'] = $data;
        }

        if (!empty($errors)) {
            $this->response['errors'] = $errors;
        }

        return response()->json($this->response, $httpStatus, $this->headers);
    }
}
