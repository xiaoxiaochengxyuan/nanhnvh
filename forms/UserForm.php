<?php
namespace app\forms;
use yii\base\Model;
use app\utils\StringUtil;
use app\daos\User;
use app\utils\VerifyUtil;
/**
 * 用户对应的Form
 * @author xiawei
 */
class UserForm extends Model {
    /**
     * 用户名
     * @var string
     */
    public $username = null;
    
    /**
     * 密码
     * @var string
     */
    public $password = null;
    
    /**
     * 是否7天免登陆
     * @var integer
     */
    public $member = 0;
    
    /**
     * 重复密码
     * @var string
     */
    public $repassword = null;
    
    /**
     * 邮箱
     * @var string
     */
    public $email = null;
    
    /**
     * 验证码
     * @var string
     */
    public $verify = null;
    
    /**
     * 性别，0表示男孩，1表示女孩
     * @var integer
     */
    public $sex = 0;
    
    /**
     * (non-PHPdoc)
     * @see \yii\base\Model::rules()
     */
    public function rules() {
        return array(
            array('username', 'checkUsername', 'on' => array('register', 'login'), 'skipOnEmpty' => false),
            array('password', 'required', 'on' => array('register', 'login'), 'message' => '密码必须填写'),
            array('repassword', 'compare', 'compareAttribute' => 'password', 'on' => array('register'), 'message' => '密码和重复密码不相等', 'skipOnEmpty' => false),
            array('email', 'email', 'on' => array('register'), 'message' => '邮箱不正确', 'skipOnEmpty' => false),
            array('email', 'checkEmail', 'on' => array('register'), 'skipOnEmpty' => false),
            array('verify', 'checkVerify', 'on' => array('register'), 'skipOnEmpty' => false)
        );
    }
    
    /**
     * 检查用户名
     */
    public function checkUsername() {
        if (empty($this->username)) {
            $this->addError('用户名必须填写');
        } elseif (StringUtil::utf8Len($this->username) > 20) {
            $this->addError('用户名长度不能超过20个字符');
        } elseif (
            ($this->getScenario() == 'register' && User::instance()->exists('username', $this->username))
        ) {
            $this->addError('username', '用户名重复');
        }
    }
    
    
    /**
     * 检查邮箱
     */
    public function checkEmail() {
        if ($this->getScenario() == 'register' && User::instance()->exists('email', $this->email)) {
            $this->addError('email', '对不起,该邮箱已经被注册');
        }
    }
    
    /**
     * 检查验证码
     */
    public function checkVerify() {
        if (empty($this->verify)) {
            $this->addError('verify', '验证码必须填写');
        } elseif (!VerifyUtil::checkVerify($this->verify)) {
            $this->addError('verify', '验证码不正确');
        }
    }
    
    /**
     * 用户登录
     */
    public function login() {
    	$user = User::instance()->getByField('username', $this->username);
    	if (empty($user)) {
    		$this->addError('username', '用户名错误');
    	} else {
    		$truePassword = $user['password'];
    		$password = StringUtil::genStr($this->password, $user['salt']);
    		if ($truePassword != $password) {
    			$this->addError('password', '密码错误');
    		}
    	}
    	
    	if(!$this->hasErrors()) {
    		$user['member'] = $this->member;
    		User::instance()->login($user);
    		return true;
    	} else {
    		return false;
    	}
    }
}