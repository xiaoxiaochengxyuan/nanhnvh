<?php
namespace app\modules\webman\controllers;
use app\bases\WebController;
use yii\data\Pagination;
use app\daos\Hot;
/**
 * 热点对应的Controller
 * @author xiawei
 */
class HotController extends WebController {
    /**
     * {@inheritDoc}
     * @see \app\bases\WebController::resourceName()
     */
    protected function resourceName() {
        return '热点';
    }

    /**
     * 热点列表
     */
    public function actionIndex() {
        $pagination = new Pagination();
        $pagination->pageSize = 12;
        $count = Hot::instance()->count();
        $pagination->totalCount = $count;
        $hots = Hot::instance()->listNews($pagination->offset, $pagination->limit);
        $this->view->title = '热点列表';
        return $this->render('index', array('hots' => $hots, 'pagination' => $pagination));
    }
}