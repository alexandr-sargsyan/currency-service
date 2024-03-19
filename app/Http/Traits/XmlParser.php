<?php

namespace App\Http\Traits;

use Carbon\Carbon;
use SimpleXMLElement;

trait XmlParser
{
    /**
     * @throws \Exception
     */
    private function parseXml(string $xmlData): array
    {
        $xml = new SimpleXMLElement($xmlData);
        $data = [];

        foreach ($xml->Valute as $valute) {
            $numCode = (string)$valute->NumCode;
            $data[$numCode] = [
                'valute_id' => (string)$valute['ID'],
                'char_code' => (string)$valute->CharCode,
                'nominal' => (int)$valute->Nominal,
                'name' => (string)$valute->Name,
                'value' => (float)str_replace(',', '.', (string)$valute->Value),
                'unit_rate' => (float)str_replace(',', '.', (string)$valute->VunitRate)
            ];
        }
        return $data;
    }

    /**
     * @throws \Exception
     */
    private function getDate(string $xmlData): string
    {
        $xml = new SimpleXMLElement($xmlData);

        $dateString = (string)$xml['Date'];

        $date = Carbon::createFromFormat('d.m.Y', $dateString);

        return $date->toDateString();
    }


}
