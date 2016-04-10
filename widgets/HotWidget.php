<?php
namespace app\widgets;
use yii\base\Widget;
use app\daos\Hot;
/**
 * 热点列表对应的Widget
 * @author xiawei
 */
class HotWidget extends Widget {
	public function run() {
		//获取热点信息
		$hots = Hot::instance()->listNews(0, PHP_INT_MAX);
		return $this->render('hots', array('hots' => $hots));
	}
}