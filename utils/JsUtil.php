<?php
namespace app\utils;
use yii\helpers\Json;
/**
 * javascript相关的工具类
 * @author xiawei
 */
class JsUtil {
    /**
     * 返回一段json数据
     * @param mixed $data
     */
    public static function jsonReturn($data) {
        header('Content-type: application/json');
        $dataStr = Json::encode($data);
        echo $dataStr;
        \Yii::$app->end();
    }
    
    /**
     * 运行一段javascript代码
     * @param string $script 要运行的javascript代码
     */
    public static function runScript($script) {
        echo "<script type='text/javascript'>{$script}</script>";
    }
    
    /**
     * 答应一段信息
     * @param string $msg 要打印出来的信息
     */
    public static function alert($msg) {
        $script = "alert('{$msg}')";
        self::runScript($script);
    }
}