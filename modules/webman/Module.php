<?php
namespace app\modules\webman;
use app\daos\WebmanAdmin;
/**
 * Webman系统的Module类
 * @author xiawei
 */
class Module extends \yii\base\Module {
    //controller对应的namespace
    public $controllerNamespace = 'app\modules\webman\controllers';
    //定义不需要登录的控制器和Action
    private $noLogin = null;
    //定义不需要crsf的Action
    private $noCrsf = null;
    public function init() {
        //定义默认Controller
        $this->defaultRoute = 'index';
        //定义当前Module对应的布局文件
        $this->layout = 'main';
        //不需要登录的controller和action
        $this->noLogin = array(
            'login' => array('index'),
            'common' => array('error', 'verify', 'upimg'),
        );
        $this->noCrsf = array(
            'common' => array('upimg', 'upckimg')
        );
        parent::init();
    }
    /* (non-PHPdoc)
     * @see \yii\base\Module::beforeAction()
     */
    public function beforeAction($action) {
        defined('WEB_STATIC_URL') or define('WEB_STATIC_URL', \Yii::$app->urlManager->createUrl(array('/assets/webman')));
        defined('WEB_THIRD_PLUGIN_URL') or define('WEB_THIRD_PLUGIN_URL', \Yii::$app->urlManager->createUrl(array('/assets/third')));
        $actionId = $action->id;
        $controllerId = $action->controller->id;
        if (!(isset($this->noLogin[$controllerId]) && in_array($actionId, $this->noLogin[$controllerId]))) {//如果是需要登录
            if (!WebmanAdmin::instance()->isLogin()) {
                \Yii::$app->response->redirect(array('/webman/login'));
                return !parent::beforeAction($action);
            }
        }
        //如果是不需要crsf的的
        if (isset($this->noCrsf[$controllerId]) && in_array($actionId, $this->noCrsf[$controllerId])) {
            $action->controller->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }
}
