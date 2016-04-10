<?php
namespace app\forms;
use yii\base\Model;
/**
 * web_info对应的Form
 * @author xiawei
 */
class WebInfoForm extends Model {
    /**
     * 网站标题
     * @var string
     */
    public $title;
    
    /**
     * 网站关键字
     * @var string
     */
    public $keywords;
    
    /**
     * 网站描述
     * @var string
     */
    public $description;
    
    /**
     * 应用名称
     * @var string
     */
    public $application_name;
    
    /**
     * 备案信息
     * @var string
     */
    public $beian;
    
    /**
     * qq群,多个群用英文逗号隔开
     * @var string
     */
    public $qun;
    
    /**
     * 网站联系电话,多个联系电话用逗号隔开
     * @var string
     */
    public $phone;
    
    /**
     * 站长邮箱
     * @var string
     */
    public $email;
    
    /**
     * (non-PHPdoc)
     * @see \yii\base\Model::rules()
     */
    public function rules() {
        return array(
            array('title', 'required', 'on' => array('edit'), 'message' => '网站标题必须填写'),
            array('keywords', 'required', 'on' => array('edit'), 'message' => '网站关键字必须填写'),
            array('description', 'required', 'on' => array('edit'), 'message' => '网站描述不能为空'),
            array('application_name', 'required', 'on' => array('edit'), 'message' => '应用名称必须填写'),
            array('beian', 'required', 'on' => array('edit'), 'message' => '备案信息必须填写'),
            array('qun', 'required', 'on' => array('edit'), 'message' => 'qq群必须填写'),
            array('phone', 'required', 'on' => array('edit'), 'message' => '网站联系电话必须填写'),
            array('email', 'email', 'on' => array('edit'), 'message' => '站长邮箱错误')
        );
    }
}