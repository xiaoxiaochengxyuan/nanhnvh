<?php
namespace app\modules\webman\controllers;
use app\bases\WebController;
use app\forms\ShowMsgForm;
use app\daos\ShowMsg;
/**
 * 显示信息对应的Controller
 * @author xiawei
 */
class ShowMsgController extends WebController {
    /**
     * 显示信息对应的Action
     */
    public function actionIndex() {
        $showMsgForm = new ShowMsgForm();
        $showMsgForm->setScenario('set');
        if (\Yii::$app->request->getIsPost()) {
            $post = \Yii::$app->request->post('ShowMsgForm');
            $showMsgForm->setAttributes($post, false);
            if ($showMsgForm->validate() && ShowMsg::instance()->updateAll($post)) {
                $this->render(array('/webman/show-msg'));
            }
        } else {
            $showMsg = ShowMsg::instance()->load();
            $showMsgForm->setAttributes($showMsg, false);
        }
        $this->view->title = '显示信息';
        return $this->render('index', array('showMsgForm' => $showMsgForm));
    }
}