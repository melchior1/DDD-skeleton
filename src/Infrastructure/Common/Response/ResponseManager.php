<?php

namespace Infrastructure\Common\Response;

use JsonSerializable;
use Symfony\Component\HttpFoundation\JsonResponse;

final class ResponseManager implements ResponseManagerInterface
{

    public function success(JsonSerializable|array $data, int $status = 200): JsonResponse
    {
        return new JsonResponse(
            [
                'status' => $status,
                'payload' => $data
            ],
            $status
        );
    }

    public function error(JsonSerializable|array $data, int $status = 500): JsonResponse
    {
        return new JsonResponse(
            [
                'status' => $status,
                'payload' => $data
            ],
            200
        );
    }

}
