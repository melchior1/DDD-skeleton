<?php

namespace Infrastructure\Common\Response;

use JsonSerializable;
use Symfony\Component\HttpFoundation\JsonResponse;

interface ResponseManagerInterface
{
    public function success(JsonSerializable|array $data): JsonResponse;
    public function error(JsonSerializable|array $data): JsonResponse;

}
