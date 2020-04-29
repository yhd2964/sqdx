<?php
namespace app\common\controller;

use think\Controller;

class httpCurl extends Controller{
    static public function combineURL($baseURL, $keysArr)
    {
        if (empty($keysArr)) {
            return $baseURL;
        }

        $combined = $baseURL . '?';
        $valueArr = array();

        foreach ($keysArr as $key => $val) {
            $valueArr[] = $key . '=' . $val;
        }

        $keyStr = implode('&', $valueArr);
        $combined .= $keyStr;
        return $combined;
    }

    static public function get_contents($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = curl_exec($ch);
        curl_close($ch);

        if (empty($response)) {
            return NULL;
        }

        return $response;
    }

    static public function get($url, $keysArr)
    {
        $combined = self::combineURL($url, $keysArr);
        return self::get_contents($combined);
    }

    static public function post($url, $keysArr, $flag = 0)
    {
        $ch = curl_init();

        if (!$flag) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $keysArr);
        curl_setopt($ch, CURLOPT_URL, $url);
        $ret = curl_exec($ch);
        curl_close($ch);
        return $ret;
    }
}