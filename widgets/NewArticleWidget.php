<?php
namespace app\widgets;
use yii\base\Widget;
use app\daos\Article;
/**
 * 最新文章对应的Widget
 * @author xiawei
 */
class NewArticleWidget extends Widget {
	public function run() {
		//获取最新信息
		$newArticles = Article::instance()->listNew(10);
		return $this->render('new_article', array('newArticles' => $newArticles));
	}
}