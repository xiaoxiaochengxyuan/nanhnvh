<?php
namespace app\forms;
use yii\base\Model;
use app\daos\Category;
/**
 * 分类对应的Form
 * @author xiawei
 */
class CategoryForm extends Model {
    /**
     * 分类对应的id
     * @var integer
     */
    public $id;
    
    /**
     * 分类名称
     * @var string
     */
    public $name;
    
    /**
     * 分类拼音
     * @var string
     */
    public $pinyin;
    
    /**
     * 分类的父id
     * @var integer
     */
    public $pid;
    
    /**
     * (non-PHPdoc)
     * @see \yii\base\Model::rules()
     */
    public function rules() {
        return array(
            array('id', 'checkId', 'on' => array('update'), 'skipOnEmpty' => false),
            array('name', 'checkName', 'on' => array('add', 'update'), 'skipOnEmpty' => false),
            array('pinyin', 'checkPinyin', 'on' => array('add', 'update'), 'skipOnEmpty' => false),
        );
    }
    
    /**
     * 检查id
     * @param unknown $attribute
     * @param unknown $params
     */
    public function checkId($attribute, $params) {
        if (empty($this->id)) {
            $this->addError('id', '分类id不能为空');
        } elseif (!Category::instance()->exists('id', $this->id)) {
            $this->addError('id', '分类id不存在');
        }
    }
    
    /**
     * 检查名称
     * @param unknown $attribute
     * @param unknown $params
     */
    public function checkName($attribute, $params) {
        if (empty($this->name)) {
            $this->addError('name', '分类名称不能为空');
        } elseif (
            ($this->getScenario() == 'add' && Category::instance()->existsByNameAndPid($this->name, $this->pid)) ||
            ($this->getScenario() == 'update' && Category::instance()->existsByNameAndPidWithoutId($this->name, $this->pid, $this->id))
        ) {
            $this->addError('name', '分类名称重复');
        }
    }
    
    /**
     * 检查拼音
     * @param unknown $attribute
     * @param unknown $params
     */
    public function checkPinyin($attribute, $params) {
        if (empty($this->pinyin)) {
            $this->addError('pinyin', '分类拼音不能为空');
        } elseif (
            ($this->getScenario() == 'add' && Category::instance()->existsByPinyinAndPid($this->pinyin, $this->pid)) ||
            ($this->getScenario() == 'update' && Category::instance()->existsByPinyinAndPidWithoutId($this->pinyin, $this->pid, $this->id))
        ) {
            $this->addError('pinyin', '分类拼音重复');
        }
    }
}