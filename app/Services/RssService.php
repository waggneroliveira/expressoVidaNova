<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

class RssService
{
    public function getItems(string $url)
    {
        $response = Http::timeout(10)->get($url);

        if (! $response->ok()) {
            return [];
        }

        $xml = new SimpleXMLElement($response->body());

        return $xml->channel->item ?? [];
    }
}
