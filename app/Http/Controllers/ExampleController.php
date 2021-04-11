<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExampleRequest;
use Illuminate\Http\JsonResponse;
use Src\Example\Application\Commands\ExampleCreateCommand;

class ExampleController extends ApiController
{
    public function store(ExampleRequest $request): JsonResponse
    {
        $example = $this->commandBus->execute(
            new ExampleCreateCommand(
                $request->get('title'),
                $request->get('description')
            )
        );

        $this->setResponseData($example);
        $this->setResponseSuccess(true);

        return $this->response();
    }
}
