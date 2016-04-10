<?php
namespace app\widgets;
use yii\base\Widget;
use app\daos\Category;
class NavWidget extends Widget {
    /* (non-PHPdoc)
     * @see \yii\base\Widget::run()
     */
    public function run() {
        $categories = Category::instance()->listOrderBySort(array('id', 'name', 'pinyin'));
        return $this->render('nav', array('categories' => $categories));
    }
}