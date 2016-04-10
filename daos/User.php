<?php
namespace app\daos;
use app\bases\BaseDao;
use app\utils\StringUtil;
use yii\helpers\Json;
use yii\web\Cookie;
/**
 * 用户对应的Dao
 * @author xiawei
 */
class User extends BaseDao {
    /**
     * 用户登录之后cookie的key
     * @var string
     */
    const USER_LOGIN_COOKIE_KEY = 'user_login_cookie_key';
    const TABLE_NAME = 'user';
    /* (non-PHPdoc)
     * @see \app\bases\BaseDao::tableName()
     */
    public function tableName() {
        return self::TABLE_NAME;
    }
    
    /**
     * 单例
     * @param system $className
     * @return User
     */
    public static function instance($className = __CLASS__){
        return parent::instance($className);
    }
    
    /**
     * (non-PHPdoc)
     * @see \app\bases\BaseDao::insert()
     */
    public function insert(array $user) {
        $salt = \Yii::$app->security->generateRandomString(8);
        $user['password'] = StringUtil::genStr($user['password'], $salt);
        $user['salt'] = $salt;
        return parent::insert($user);
    }
    
    /**
     * 用户登录
     * @param array $user
     */
    public function login(array $user) {
        $loginUserArr = array('id' => $user['id'], 'username' => $user['username'], 'sex' => $user['sex'], 'email' => $user['email']);
        $loginUserStr = Json::encode($loginUserArr);
        $cookieConfig = array(
        	'name' => self::USER_LOGIN_COOKIE_KEY,
        	'value' => $loginUserStr,
        );
        if ($user['member']) {
        	$cookieConfig['expire'] = time() + 7 * 3600 * 24;
        }
        $cookie = new Cookie(array('name' => self::USER_LOGIN_COOKIE_KEY, 'value' => $loginUserStr));
        \Yii::$app->response->cookies->add($cookie);
    }
    
    /**
     * 退出
     */
    public function logout() {
    	\Yii::$app->response->cookies->remove(self::USER_LOGIN_COOKIE_KEY);
    }
    
    /**
     * 判断用户是否登录
     * @return boolean true表示登录成功,false表示登录失败
     */
    public function isLogin() {
        return \Yii::$app->request->cookies->has(self::USER_LOGIN_COOKIE_KEY);
    }
    
    /**
     * 获取对应的登录信息
     * @param string $field
     * @return mixed 登录用户的信息
     */
    public function getLoginInfo($field = null) {
        $loginUserStr = \Yii::$app->request->cookies->get(self::USER_LOGIN_COOKIE_KEY);
        $loginUserArr = Json::decode($loginUserStr, true);
        return empty($field) ? $loginUserArr : $loginUserArr[$field];
    }
    
    /**
     * 设置用户为验证通过
     * @param integer $id 要验证通过的id
     * @return integer 影响的行数
     */
    public function pass($id) {
        return $this->update($id, array('pass_verify' => 1));
    }
    
}