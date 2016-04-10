<?php
namespace app\modules\webman\controllers;
use yii\web\Controller;
use app\forms\WebmanAdminForm;
use app\daos\WebmanAdmin;
/**
 * WebmanAdmin对应的Controller
 * @author xiawei
 */
class WebmanAdminController extends Controller {
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
     * 修改密码
     */
    public function actionChgpasswd() {
        $webmanAdminForm = new WebmanAdminForm();
        $webmanAdminForm->setScenario('chgpasswd');
        if (\Yii::$app->request->getIsPost()) {
            $post = \Yii::$app->request->post('WebadminForm');
            $webmanAdminForm->setAttributes($post, false);
            if ($webmanAdminForm->validate() && WebmanAdmin::instance()->chgLoginPwd($post['newPassword'])) {
                $this->redirect(array('/webman'));
                \Yii::$app->end();
            }
        }
        $this->view->title = '修改密码';
        return $this->render('chgpasswd', array(
            'webmanAdminForm' => $webmanAdminForm
        ));
    }
}