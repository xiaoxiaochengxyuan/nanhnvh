<?php
namespace app\modules\webman\controllers;
use app\forms\WebmanAdminForm;
use yii\web\Controller;
use app\daos\WebmanAdmin;
/**
 * 登录相关的Controller
 * @author xiawei
 */
class LoginController extends Controller {
    /* (non-PHPdoc)
     * @see \app\bases\WebController::aop()
     */
    protected function aop() {
        return false;
    }
    
    /* (non-PHPdoc)
     * @see \app\bases\WebController::op()
     */
    protected function op() {
        return false;
    }
    
    /**
     * WebmanAdmin登录
     */
    public function actionIndex() {
        $webmanAdminForm = new WebmanAdminForm();
        $webmanAdminForm->setScenario('login');
        if (\Yii::$app->request->getIsPost()) {
            $post = \Yii::$app->request->post('WebadminForm');
            $webmanAdminForm->setAttributes($post, false);
            if ($webmanAdminForm->validate() && $webmanAdminForm->login()) {
                $this->redirect(array('/webman'));
            }
        }
        $this->view->title = 'Webman登录';
        return $this->renderPartial('index', array('webmanAdminForm' => $webmanAdminForm));
    }
    
    /**
     * 退出当前登录用户
     */
    public function actionLogout() {
        WebmanAdmin::instance()->logout();
        $this->redirect(array('/webman/login'));
    }
}