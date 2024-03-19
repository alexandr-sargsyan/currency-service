<?php

namespace App\Http\action;

use App\Exceptions\ConnectionOrServerException;
use App\Exceptions\ExternalServiceException;
use App\Http\Requests\GetCurrentExchangeRatesRequest;
use App\Http\Traits\XmlParser;
use App\Models\CurrencyData;
use Exception;
use Illuminate\Support\Facades\Http;

class GetCurrentExchangeRatesAction
{
    use XmlParser;

    /**
     * @throws ConnectionOrServerException
     */
    public function run(GetCurrentExchangeRatesRequest $request)
    {
        try {
            $currencyCode = $request->getCurrencyCode();
            $currencyData = CurrencyData::query()
                ->where('data->'.$currencyCode, '!=', null)
                ->first();
            $externalServiceUrl = config('services.cbr.url');

            if (!$currencyData) {
                $response = Http::get($externalServiceUrl);

                if ($response->ok()) {
                    $xmlData = $response->body();
                    $parsedData = $this->parseXml($xmlData);
                    $date = $this->getDate($xmlData);

                    return [
                        'date' => $date,
                        'data' => (array)$parsedData[$currencyCode]
                    ];
                } else {
                    throw new ExternalServiceException();
                }
            } else {
                $data = $currencyData->toArray();

                return [
                    'date' => $data['date'],
                    'data' => (array)$data['data']->$currencyCode
                ];
            }
        } catch (Exception $e) {
            throw new ConnectionOrServerException($e->getMessage());
        }
    }

}
