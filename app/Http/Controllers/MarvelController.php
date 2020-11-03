<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class MarvelController extends Controller
{   
    /**
     * Query params :
     * @param String limit
     * @param String offset
     * @param String nameStartsWith
     */
    public function characters(Request $request) {
        $MARVEL_PUBLIC_KEY = env('MARVEL_PUBLIC_KEY');
        $MARVEL_PRIVATE_KEY = env('MARVEL_PRIVATE_KEY');
        $MARVEL_EXT_API_URL = env('MARVEL_EXT_API_URL');

        $DEFAULT_LIMIT = '10';

        $limit = $request->input('limit', $DEFAULT_LIMIT);

        $params = [
            'limit'=> intval($limit) ? $limit : $DEFAULT_LIMIT,
            'offset' => $request->input('offset'),
            'nameStartsWith' => $request->input('nameStartsWith'),
            'ts' => strval(time()),
            'apikey' => $MARVEL_PUBLIC_KEY,
        ];

        $urlParams = "hash=" . md5($params['ts'].$MARVEL_PRIVATE_KEY.$MARVEL_PUBLIC_KEY);

        foreach($params as $key => $value) {
            $urlParams .= "&$key=$value";
        }

        $marvelUrl = "$MARVEL_EXT_API_URL/characters?$urlParams";

        $client = new Client();
        
        $response = $client->request('GET', $marvelUrl);
        // $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $bodyObj = json_decode($body);
        $data = property_exists($bodyObj, 'data') ? $bodyObj->data : null;
        
        $res = [
            'offset' => null,
            'limit' => null,
            'total' => null,
            'count' => null,
            'results' => []
        ];
        
        if (is_object($data)) {
            foreach($res as $key => $val) {
                if (property_exists($data, $key)) {
                    $res[$key] = $data->{$key};
                }
            }
        }

        return $res;
    }
}
