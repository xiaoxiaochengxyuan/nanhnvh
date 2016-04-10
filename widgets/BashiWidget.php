<?php
namespace app\widgets;
use yii\base\Widget;
use app\daos\ShowMsg;
use app\daos\Article;
/**
 * 生活巴士对应的Widget
 * @author xiawei
 */
class BashiWidget extends Widget {
	public function run() {
		//获取注册用户数量
		$regCount = round(ShowMsg::instance()->load('reg_count') / 1000, 1);
		//获取文章总数
		$articleCount = Article::instance()->count();
		return $this->render('bashi', array('regCount' => $regCount, 'articleCount' => $articleCount));
	}
}