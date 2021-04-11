<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Src\Shared\Application\Bus\CommandBusInterface;
use Src\Shared\Domain\Dto\DtoInterface;

abstract class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private ?array $data = null;
    private bool $success = false;
    private array $errors = [];
    private int $status = 400;

    public function __construct(
        protected CommandBusInterface $commandBus
    )
    {
    }

    protected function response(int $status = null, array $headers = [], int $options = 0): JsonResponse
    {
        if ($status) $this->status = $status;

        return response()->json([
            'data' => $this->data,
            'meta' => [
                'success' => $this->success,
                'errors' => $this->errors,
            ]
        ], $this->status, $headers, $options);
    }

    protected function setResponseData(DtoInterface $data): void
    {
        $this->data = $data->toArray(true);
    }

    protected function setResponseSuccess(bool $success, int $status = null): void
    {
        if ($success) $this->status = 200;
        $this->success = $success;

        if ($status) $this->status = $status;
    }

    protected function setResponseErrors(array $errors): void
    {
        $this->errors = $errors;
    }

    protected function addResponseError(string $error): void
    {
        $this->errors[] = $error;
    }
}
