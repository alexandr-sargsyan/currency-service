<?php

namespace App\Http\Controllers;

use App\Exceptions\ConnectionOrServerException;
use App\Http\action\GetCurrentExchangeRatesAction;
use App\Http\Requests\GetCurrentExchangeRatesRequest;
use Illuminate\Http\JsonResponse;

class GetCurrentExchangeRatesController extends Controller
{
    /**
     * @throws ConnectionOrServerException
     */
    public function __invoke(GetCurrentExchangeRatesRequest $request, GetCurrentExchangeRatesAction $action): JsonResponse
    {
        $data = $action->run($request);

        return response()->json($data);
    }

}
