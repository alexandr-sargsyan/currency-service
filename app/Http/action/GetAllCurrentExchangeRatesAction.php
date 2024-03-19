<?php

namespace App\Http\action;

use App\Exceptions\ConnectionOrServerException;
use App\Exceptions\ExternalServiceException;
use App\Http\Traits\XmlParser;
use App\Models\CurrencyData;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Http;

class GetAllCurrentExchangeRatesAction
{
    use XmlParser;
    /**
     * @throws ConnectionOrServerException
     */
    public function run()
    {
        $externalServiceUrl = config('services.cbr.url');

        $currencyData = CurrencyData::query()
            ->whereDate('date', Carbon::today())
            ->first();

        if (!$currencyData) {
            try {
                $response = Http::get($externalServiceUrl);

                if ($response->ok()) {
                    $xmlData = $response->body();
                    $parsedData = $this->parseXml($xmlData);
                    $date = $this->getDate($xmlData);
                    $currencyData = CurrencyData::query()->create([
                        'date' => $date,
                        'data' => json_encode($parsedData)
                    ]);
                } else {
                    throw new ExternalServiceException();
                }
            } catch (Exception $e) {
                throw new ConnectionOrServerException($e->getMessage());
            }
        }
        return $currencyData;

    }

}
