<?php
namespace app\modules\webman\controllers;
use app\bases\WebController;
use app\daos\FriendLink;
/**
 * 友情链接对应的Controller
 * @author xiawei
 */
class FriendLinkController extends WebController {
    
    /**
     * {@inheritDoc}
     * @see \app\bases\WebController::resourceName()
     */
    protected function resourceName() {
        return '友情链接';
    }

    /**
     * 友情链接列表页
     */
    public function actionIndex() {
        $friendLinks = FriendLink::instance()->listAllBySort();
        $this->view->title = '友情链接列表';
        return $this->render('index', array('friendLinks' => $friendLinks));
    }
}