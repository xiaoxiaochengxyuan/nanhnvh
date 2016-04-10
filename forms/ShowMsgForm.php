<?php
namespace app\forms;
use yii\base\Model;
/**
 * 显示信息对应的Form表单
 * @author xiawei
 */
class ShowMsgForm extends Model {
    /**
     * 注册信息
     * @var integer
     */
    public $reg_count;
    
    /**
     * {@inheritDoc}
     * @see \yii\base\Model::rules()
     */
    public function rules() {
        return array(
            array('reg_count', 'number', 'on' => array('set'), 'message' => '注册信息必须是一个数字', 'skipOnEmpty' => false)
        );
    }
}