<?php
namespace app\utils;
/**
 * 字符串相关的帮助类
 * @author xiawei
 */
class StringUtil {
    /**
     * 加密一个字符串
     * @param string $str 要加密的字符串
     * @param string $key 加密使用的key
     * @return string 加密之后的字符串
     */
    public static function encryStr($str, $key='5BAB6FAC-4283-4ebe-AE97-3CBCA9CA70B0') {
        return base64_encode(mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $str, MCRYPT_MODE_ECB));
    }
    
    /**
     * 解密一个字符串
     * @param string $str 要解密的字符串
     * @param string $key 用来解密的key
     * @return string 解密之后的字符串
     */
    public static function decryStr($str, $key='5BAB6FAC-4283-4ebe-AE97-3CBCA9CA70B0') {
        return trim(mcrypt_decrypt(MCRYPT_BLOWFISH, $key, base64_decode($str), MCRYPT_MODE_ECB));
    }
    
    
    /**
     * 获取一个UTF8编码字符串的长度
     * @param string $str 要获取长度的字符串
     * @return integer 长度
     */
    public static function utf8Len($str) {
        return mb_strlen($str, 'utf-8');
    }
    
    /**
     * 生成一个加密字符串
     * @param string $password 密码
     * @param string $salt 加密盐
     * @return string
     */
    public static function genStr($password, $salt) {
        return sha1($password.$salt);
    }
    
    
    /**
     * 截取一段Utf8格式的字符串
     * @param string $str 要截取的字符串
     * @param integer $start 开始截取的位置
     * @param integer $len 截取的长度
     * @return string
     */
    public static function subStr($str, $start, $len= null) {
        if ($len === null) {
            $len = self::utf8Len($str) - $start - 1;
        }
        return mb_substr($str, $start, $len, 'utf-8');
    }
}