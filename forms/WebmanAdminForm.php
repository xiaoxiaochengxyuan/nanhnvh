<?php
namespace app\forms;
use yii\base\Model;
use app\daos\WebmanAdmin;
use app\utils\VerifyUtil;
use app\utils\StringUtil;
/**
 * WebmanAdmin对应的Form
 * @author xiawei
 */
class WebmanAdminForm extends Model {
    /**
     * 用户名
     * @var string
     */
    public $username;
    
    /**
     * 密码
     * @var string
     */
    public $password;
    
    /**
     * 验证码
     * @var string
     */
    public $verify;
    
    /**
     * 旧密码
     * @var string
     */
    public $oldPassword;
    
    /**
     * 新密码
     * @var string
     */
    public $newPassword;
    
    /**
     * 重复密码
     * @var string
     */
    public $rePassword;
    
    /**
     * (non-PHPdoc)
     * @see \yii\base\Model::rules()
     */
    public function rules() {
        return array(
            array('verify', 'checkVerify', 'on' => array('login') , 'skipOnEmpty' => false),
            array('username', 'checkUsername', 'on' => array('login'), 'skipOnEmpty' => false),
            array('password', 'required', 'on' => array('login'), 'message' => '密码不能为空'),
            array('oldPassword', 'checkOldPassword', 'on' => array('chgpasswd'), 'skipOnEmpty' => false),
            array('newPassword', 'checkNewPassword', 'on' => array('chgpasswd'), 'skipOnEmpty' => false),
            array('rePassword', 'compare', 'compareAttribute' => 'newPassword', 'message' => '新密码和重复密码不相等', 'on' => 'chgpasswd', 'skipOnEmpty' => false),
        );
    }
    
    /**
     * 检查用户名
     * @param unknown $attribute
     * @param unknown $params
     */
    public function checkUsername($attribute, $params) {
        if (empty($this->username)) {
            $this->addError('username', '用户名不能为空');
        }
    }
    
    /**
     * 检查验证码是否正确
     * @param unknown $attribute
     * @param unknown $params
     */
    public function checkVerify($attribute, $params) {
        if (!VerifyUtil::checkVerify($this->verify)) {
            $this->addError('verify', '验证码不正确');
        }
    }
    
    /**
     * 用户登录
     * @return boolean true表示登录成功,false表示登录失败
     */
    public function login() {
        $webmanAdmin = WebmanAdmin::instance()->getByField('username', $this->username);
        if (empty($webmanAdmin)) {
            $this->addError('username', '用户名错误');
        } elseif (StringUtil::genStr($this->password, $webmanAdmin['salt']) != $webmanAdmin['password']) {
            $this->addError('password', '密码错误');
        }
        WebmanAdmin::instance()->login($webmanAdmin['id']);
        return WebmanAdmin::instance()->isLogin();
    }
    
    /**
     * 检查旧密码
     * @param unknown $attribute
     * @param unknown $params
     */
    public function checkOldPassword($attribute, $params) {
        $loginWebmanAdmin = WebmanAdmin::instance()->getLoginInfo();
        if (StringUtil::genStr($this->oldPassword, $loginWebmanAdmin['salt']) != $loginWebmanAdmin['password']) {
            $this->addError('oldPassword', '旧密码错误');
        }
    }
    
    /**
     * 检查新密码
     * @param unknown $attribute
     * @param unknown $params
     */
    public function checkNewPassword($attribute, $params) {
        if (empty($this->newPassword)) {
            $this->addError('newPassword', '新密码错误');
        } elseif ($this->newPassword == $this->oldPassword) {
            $this->addError('newPassword', '新密码不能和旧密码相同');
        }
    }
}