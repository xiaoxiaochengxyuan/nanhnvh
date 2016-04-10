<?php
namespace app\widgets;
use yii\base\Widget;
use app\daos\Article;
/**
 * 热门推荐对应的Widget
 * @author xiawei
 */
class HotTuijianWidget extends Widget {
	public function run() {
		//获取热门推荐信息
		$hotTuijianArticles = Article::instance()->listTuijian(10);
		return $this->render('hot_tuijian', array('hotTuijianArticles' => $hotTuijianArticles));
	}
}