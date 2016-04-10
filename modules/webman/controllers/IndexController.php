<?php
namespace app\modules\webman\controllers;
use yii\web\Controller;
use app\forms\WebInfoForm;
use app\daos\WebInfo;
/**
 * 网站基本信息控制器
 * @author xiawei
 */
class IndexController extends Controller {
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
     * 编辑网站基本信息
     */
    public function actionIndex() {
        $webInfoForm = new WebInfoForm();
        if (\Yii::$app->request->getIsPost()) {
            $post = \Yii::$app->request->post('WebadminForm');
            $webInfoForm->setAttributes($post, false);
            if ($webInfoForm->validate() && WebInfo::instance()->edit($post)) {
                $this->redirect(array('/webman'));
            }
        }
        $webInfo = WebInfo::instance()->get();
        if (!empty($webInfo)) {
            $webInfoForm->setAttributes($webInfo, false);
        }
        $this->view->title = '网站基本信息';
        return $this->render('index', array('webInfoForm' => $webInfoForm));
    }
}