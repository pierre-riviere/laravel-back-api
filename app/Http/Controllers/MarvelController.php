<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

use App\FavoriteCharacter;

class MarvelController extends Controller
{
    /**
     * Query params :
     * @param String limit
     * @param String offset
     * @param String nameStartsWith
     */
    public function characters(Request $request)
    {
        $MARVEL_PUBLIC_KEY = env("MARVEL_PUBLIC_KEY");
        $MARVEL_PRIVATE_KEY = env("MARVEL_PRIVATE_KEY");
        $MARVEL_EXT_API_URL = env("MARVEL_EXT_API_URL");

        $DEFAULT_LIMIT = "10";

        $limit = $request->input("limit", $DEFAULT_LIMIT);

        $params = [
            "limit" => intval($limit) ? $limit : $DEFAULT_LIMIT,
            "offset" => $request->input("offset"),
            "ts" => strval(time()),
            "apikey" => $MARVEL_PUBLIC_KEY,
        ];

        $nameStartsWith = $request->input("nameStartsWith");
        if (isset($nameStartsWith)) {
            $params["nameStartsWith"] = $nameStartsWith;
        }

        $urlParams =
            "hash=" .
            md5($params["ts"] . $MARVEL_PRIVATE_KEY . $MARVEL_PUBLIC_KEY);

        foreach ($params as $key => $value) {
            $urlParams .= "&$key=$value";
        }

        $marvelUrl = "$MARVEL_EXT_API_URL/characters?$urlParams";

        $client = new Client();

        $response = $client->request("GET", $marvelUrl);
        // $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $bodyObj = json_decode($body);
        $data = property_exists($bodyObj, "data") ? $bodyObj->data : null;

        $res = [
            "offset" => null,
            "limit" => null,
            "total" => null,
            "count" => null,
            "results" => [],
        ];

        $mapKeys = [
            "results" => "characters",
        ];

        if (is_object($data)) {
            foreach ($res as $key => $val) {
                if (property_exists($data, $key)) {
                    $k = isset($mapKeys[$key]) ? $mapKeys[$key] : $key;
                    $res[$k] = $data->{$key};
                }
            }
        }

        return [
            "data" => $res,
        ];
    }

    public function addFavoriteCharacter(Request $request)
    {
        $fc = [];

        $externalId = $request->input("external_id");
        if (
            isset($externalId) &&
            is_numeric($externalId) &&
            FavoriteCharacter::count("external_id", $externalId) === 0
        ) {
            $fc = new FavoriteCharacter();
            $fc->external_id = $externalId;
            $fc->save();
        }

        return $fc;
    }
}
