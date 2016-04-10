<?php
namespace app\utils;
/**
 * 和Http相关的工具类
 * @author xiawei
 */
class HttpUtil {
    /**
     * 发送一个Get请求
     * @param string $url 要请求的url
     * @return string
     */
    public static function doGet($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_HEADER , 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 3);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
    
    /**
     * 发送一个Post请求
     * @param string $url    要请求的url
     * @param array  $params post请求的参数
     * @return string
     */
    public static function doPost($url, array $params) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_HEADER , 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 3);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
}