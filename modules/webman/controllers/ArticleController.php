<?php
namespace app\modules\webman\controllers;
use app\bases\WebController;
use app\forms\ArticleForm;
use app\daos\Category;
use app\daos\Hot;
use app\daos\Article;
use yii\data\Pagination;
/**
 * 文章对应的Controller
 * @author xiawei
 */
class ArticleController extends WebController {
    /**
     * 文章列表
     */
    public function actionIndex() {
        $search = \Yii::$app->request->get('search', array('title' => '', 'description' => '', 'day_hot' => 0, 'hot_tuijian' => 0, 'category_id' => 0));
        $pagination = new Pagination();
        $pagination->totalCount = Article::instance()->countBySearch($search);
        $articles = Article::instance()->listBySearch($search, $pagination->getOffset(), $pagination->getLimit());
        $this->view->title = '文章列表';
        return $this->render('index', array('pagination' => $pagination, 'articles' => $articles));
    }
    
    /**
     * {@inheritDoc}
     * @see \app\bases\WebController::actionAdd()
     */
    public function actionAdd() {
        $articleForm = new ArticleForm(); 
        $articleForm->setScenario('add');
        if (\Yii::$app->request->getIsPost()) {
            $post = \Yii::$app->request->post('ArticleForm');
            $articleForm->setAttributes($post, false);
            if ($articleForm->validate() && Article::instance()->insert($post)) {
                $this->redirect(array('/webman/article'));
            }
        }
        $categories = Category::instance()->dropList();
        $hots = Hot::instance()->listNameAccessId();
        $this->view->title = '添加文章';
        return $this->render('add', array('articleForm' => $articleForm, 'categories' => $categories, 'hots' => $hots));
    }
    
    /**
     * {@inheritDoc}
     * @see \app\bases\WebController::actionUpdate()
     */
    public function actionUpdate() {
        $articleForm = new ArticleForm();
        $articleForm->setScenario('update');
        if (\Yii::$app->request->getIsPost()) {
            $post = \Yii::$app->request->post('ArticleForm');
            $articleForm->setAttributes($post, false);
            if ($articleForm->validate() && Article::instance()->update($post['id'], $post)) {
                $this->redirect(array('/webman/article'));
            }
        } else {
            $id = \Yii::$app->request->get('id');
            $article = Article::instance()->getById($id);
            $hots = Article::instance()->getHotIdsById($id);
            $article['hots'] = $hots;
            $articleForm->setAttributes($article, false);
        }
        $this->view->title = '修改文章';
        $categories = Category::instance()->dropList();
        $hots = Hot::instance()->listNameAccessId();
        return $this->render('update', array('articleForm' => $articleForm, 'categories' => $categories, 'hots' => $hots));
    }
}