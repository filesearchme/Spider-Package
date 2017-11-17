<?php
namespace App;

use \GuzzleHttp\Client;

class GetData {

    public static function parse($url, $timeout, $curl=false)
    {
        if( $curl == false )
        {
            $client = new Client([
                'http_errors' => false,
                'headers' => [
                    'User-Agent' => 'FileSearch.me Bot v1 '.md5($_SERVER['SERVER_ADDR'])
                ]
            ]);
            $res = $client->request('GET', $url);
            return $res->getStatusCode() == 200 ? $res->getBody() : '';
        }
        else
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_USERAGENT,'FileSearch.me Bot v1 '.md5($_SERVER['SERVER_ADDR']));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
    }
}