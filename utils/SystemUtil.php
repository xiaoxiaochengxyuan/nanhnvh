<?php
namespace app\utils;
use yii\helpers\Json;
/**
 * 系统相关的工具类
 * @author xiawei
 */
class SystemUtil {
    /**
     * 显示消息
     * @param string $msg 要显示的消息
     * @param string $redirectPageName 要跳转到的页面名称
     * @param string $redirectUrl 要跳转到的页面的url
     */
    public static function showMsg($msg, $redirectPageName, $redirectUrl) {
        $redArr = array(
            'msg' => $msg,
            'redirectPageName' => $redirectPageName,
            'redirectUrl' => $redirectUrl
        );
        $redJson = Json::encode($redArr);
        $gen = StringUtil::encryStr($redJson);
        \Yii::$app->response->redirect(array('/site/show-msg', 'gen' => $gen));
        \Yii::$app->end();
    }
    
    /**
     * 发送邮件
     * @param string $email 要发送给谁
     * @param string $title 发送的邮件标题
     * @param string $msg   发送的邮件内容
     * @param boolean $isHtml 是否是html格式的邮件
     * @return boolean true表示发送成功,false表示发送失败
     */
    public static function sendEmail($email, $title, $msg, $isHtml = false) {
        $mailer = \Yii::$app->mailer->compose();
        $mailer->setTo($email);
        $mailer->setSubject($title);
        if ($isHtml) {
            $mailer->setHtmlBody($msg);
        } else {
            $mailer->setTextBody($msg);
        }
        return $mailer->send();
    }
}