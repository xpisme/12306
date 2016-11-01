<?php
// 公共函数库
if (! function_exists('httpRequest')) {
    function httpRequest($url, $postData = false)
    {
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        if ($postData) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        }
        $header = [
            'CLIENT-IP:'. getIp(),
            'X-FORWARDED-FOR:'.getIp(),
        ];
        curl_setopt($ch, CURLOPT_HEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == '200') {
            $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($response, 0, $headerSize);
            $response = substr($response, $headerSize);
        }
        curl_close($ch);
        return $response;
    }
}

if (! function_exists('getIp')) {
    function getIp()
    {
        return mt_rand(0, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(0, 255);
    }
}

if (! function_exists('myAutoLoad')) {
    function myAutoLoad($name)
    {
        require_once $name . '.php';
    }
}
