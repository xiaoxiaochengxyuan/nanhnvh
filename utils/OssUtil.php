<?php
namespace app\utils;
use OSS\OssClient;
use OSS\Core\OssException;
/**
 * 阿里云Oss工具类
 * @author xiawei
 */
class OssUtil {
    private static $OSSCLIENT = null;
    
    /**
     * 获取到对应的OSSClient
     */
    private static function getOssClient() {
        if (empty(self::$OSSCLIENT)) {
            $ossConfig = \Yii::$app->params['oss'];
            if (!$ossConfig['cname']) {
                self::$OSSCLIENT = new OssClient($ossConfig['accessKeyId'], $ossConfig['accessKeySecret'], $ossConfig['endpoint']);
            } else {
                self::$OSSCLIENT = new OssClient($ossConfig['accessKeyId'], $ossConfig['accessKeySecret'], $ossConfig['endpoint'], true);
            }
        }
        return self::$OSSCLIENT;
    }
    
    /**
     * 上传本地文件到Oss
     * @param string $src 本地文件的路径
     * @param string $dist OSS上文件的路径
     * @return string 成功返回上传到服务器的图片路径
     */
    public static function uploadFileToOss($src, $dist) {
        self::getOssClient()->uploadFile(\Yii::$app->params['oss']['bucketName'], $dist, $src);
        return \Yii::$app->params['oss']['baseUrl'].'/'.$dist;
    }
    
    /**
     * 上传Web提交上来的图片
     * @param string $src 要上传的源图片
     * @param string $newFileName 新图片名称
     */
    public static function uploadWebFile($src, $newFileName) {
        $path = crc32($newFileName);
        $one = substr($path, 0, 3);
        $two = substr($path, 3, 3);
        $three = substr($path, 6);
        $filePath = "{$one}/{$two}/{$three}/{$newFileName}";
        return self::uploadFileToOss($src, $filePath);
    }
}