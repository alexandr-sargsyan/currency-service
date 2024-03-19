<?php

namespace App\Http\Controllers;

use App\Exceptions\ConnectionOrServerException;
use App\Http\action\GetAllCurrentExchangeRatesAction;
use App\Http\Resources\CurrentExchangeRagesResource;
use Illuminate\Http\Request;

class GetAllCurrentExchangeRatesController extends Controller
{
    /**
     * @throws ConnectionOrServerException
     */
    public function __invoke(Request $request, GetAllCurrentExchangeRatesAction $action): CurrentExchangeRagesResource
    {
        $data = $action->run();

        return new CurrentExchangeRagesResource($data);
    }

}
