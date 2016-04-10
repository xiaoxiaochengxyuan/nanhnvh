<?php
namespace app\modules\webman\controllers;
use app\forms\CategoryForm;
use app\daos\Category;
use app\bases\WebController;
/**
 * 分类对应的Controller
 * @author xiawei
 */
class CategoryController extends WebController {
    /**
     * 分类列表
     * @return string
     */
    public function actionIndex() {
        $pid = \Yii::$app->request->get('pid', 0);
        $categories = Category::instance()->listByFieldOrderBySort('pid', $pid);
        $this->view->title = '分类列表';
        return $this->render('index', array('pid' => $pid, 'categories' => $categories));
    }
    
    /**
     * 添加分类
     * @return string
     */
    public function actionAdd() {
        $pid = \Yii::$app->request->get('pid', 0);
        $categoryForm = new CategoryForm();
        $categoryForm->setScenario('add');
        if (\Yii::$app->request->getIsPost()) {
            $post = \Yii::$app->request->post('CategoryForm');
            $categoryForm->setAttributes($post, false);
            if ($categoryForm->validate() && Category::instance()->insert($post)) {
                $this->redirect(array('/webman/category', 'pid' => $pid));
            }
        } else {
            $categoryForm->pid = $pid;
        }
        $this->view->title = '添加分类';
        return $this->render('add', array('pid' => $pid, 'categoryForm' => $categoryForm));
    }
    
    /**
     * 修改分类
     */
    public function actionUpdate() {
        $categoryForm = new CategoryForm();
        $categoryForm->setScenario('update');
        if (\Yii::$app->request->getIsPost()) {
            $post = \Yii::$app->request->post('CategoryForm');
            $categoryForm->setAttributes($post, false);
            if ($categoryForm->validate() && Category::instance()->update($post['id'], $post)) {
                $pid = Category::instance()->scalarById($post['id'], 'pid');
                $this->redirect(array('/webman/category', 'pid' => $pid));
            }
        } else {
            $id = \Yii::$app->request->get('id');
            $category = Category::instance()->getById($id);
            $categoryForm->setAttributes($category, false);
        }
        $this->view->title = '修改分类';
        return $this->render('update', array('categoryForm' => $categoryForm));
    }
}