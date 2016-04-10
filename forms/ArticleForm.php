<?php
namespace app\forms;
use yii\base\Model;
use app\daos\Category;
/**
 * 文章对应的Form表单
 * @author xiawei
 */
class ArticleForm extends Model {
    /**
     * 文章对应的id
     */
    public $id;
    /**
     * 文章标题
     * @var string
     */
    public $title;
    
    /**
     * 文章描述
     * @var string
     */
    public $description;
    
    /**
     * 标题图片
     * @var string
     */
    public $title_img;
    
    /**
     * 是否是每日热门
     * @var integer
     */
    public $day_hot = 0;
    
    /**
     * 是否是热门推荐
     * @var integer
     */
    public $hot_tuijian = 0;
    
    
    /**
     * 是否是主题推荐
     * @var integer
     */
    public $topic_tuijian = 0;
    
    /**
     * 文章内容
     * @var string
     */
    public $content;
    
    /**
     * 对应的栏目Id
     * @var integer 
     */
    public $category_id;
    
    /**
     * 对应的热点
     * @var unknown
     */
    public $hots;
    
    /**
     * {@inheritDoc}
     * @see \yii\base\Model::rules()
     */
    public function rules() {
        return array(
            array('title', 'required', 'on' => array('add', 'update'), 'message' => '文章标题必须填写'),
            array('description', 'required', 'on' => array('add', 'update'), 'message' => '文章描述必须填写'),
            array('title_img', 'required', 'on' => array('add', 'update'), 'message' => '标题图片必须上传'),
            array('content', 'required', 'on' => array('add', 'update'), 'message' => '文章内容必须填写'),
            array('category_id', 'checkCategoryId', 'on' => array('add', 'update')),
        );
    }
    
    /**
     * 检查栏目Id
     */
    public function checkCategoryId() {
        if (!Category::instance()->exists('id', $this->category_id)) {
            $this->addError('category_id', '栏目id不存在');
        } elseif (Category::instance()->exists('pid', $this->category_id)) {
            $this->addError('category_id', '存在子栏目,请选择子栏目');
        }
    }
}