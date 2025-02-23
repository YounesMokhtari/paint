<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

abstract class Controller
{
    // use Authorizable;
    use AuthorizesRequests;

    protected function successList(array | JsonResource $data)
    {
        return $this->jsonResponse($data, HttpFoundationResponse::HTTP_OK, 'list fetched');
    }
    protected function jsonResponse(array | JsonResource $data, int $code, string $message)
    {
        return Response::json(['status' => true, 'data' => $data, 'message' => $message], $code);
    }
}
