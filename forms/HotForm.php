<?php
namespace app\forms;
use yii\base\Model;
use app\daos\Hot;
/**
 * 热点对应的Form表单
 * @author xiawei
 */
class HotForm extends Model {
    /**
     * 热点id
     * @var integer
     */
    public $id;
    /**
     * 热点名称
     * @var string
     */
    public $name;
    
    /**
     * {@inheritDoc}
     * @see \yii\base\Model::rules()
     */
    public function rules() {
        return array(
            array('name', 'checkName', 'on' => array('add', 'update'), 'skipOnEmpty' => false)
        );
    }
    
    /**
     * 检查热点名称
     */
    public function checkName() {
        if (empty($this->name)) {
            $this->addError('name', '热点名称必须填写');
        } elseif (
            ($this->getScenario() == 'add' && Hot::instance()->exists('name', $this->name)) ||
            ($this->getScenario() == 'update' && Hot::instance()->existsByFieldWithoutId('name', $this->name, $this->id))
        ) {
            $this->addError('name', '热点名称重复');
        }
    }
}
?>