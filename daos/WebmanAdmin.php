<?php
namespace app\daos;
use app\bases\BaseDao;
use app\utils\StringUtil;
use yii\helpers\Json;
use yii\web\Cookie;
/**
 * webman_admin对应的Dao
 * @author xiawei
 */
class WebmanAdmin extends BaseDao {
    /**
     * webadmin登录之后才cookie中的key
     * @var string
     */
    const WEBADMIN_LOGIN_KEY = 'webadmin_login_key';
    /**
     * webman_admin对应的表名
     * @var string
     */
    const TABLE_NAME = 'webman_admin';
    
    /**
     * (non-PHPdoc)
     * @see \app\bases\BaseDao::tableName()
     */
    public function tableName() {
        return self::TABLE_NAME;
    }
    
    /**
     * 单例
     * @param system $className
     * @return WebmanAdmin
     */
    public static function instance($className = __CLASS__){
        return parent::instance($className);
    }
    
    /**
     * 判断管理员是否登录
     * @return boolean
     */
    public function isLogin() {
        return \Yii::$app->request->cookies->has(self::WEBADMIN_LOGIN_KEY);
    }
    
    /**
     * (non-PHPdoc)
     * @see \app\bases\BaseDao::insert()
     */
    public function insert(array $data) {
        $salt = \Yii::$app->security->generateRandomString(8);
        $data['salt'] = $salt;
        $data['password'] = StringUtil::genStr($data['password'], $salt);
        $insertData = array('username' => $data['username'], 'password' => $data['password'], 'salt' => $data['salt']);
        return parent::insert($insertData);
    }
    
    /**
     * 管理员登录
     * @param integer $id 要登录的管理员的id
     */
    public function login($id) {
        $webmanAdmin = $this->getById($id, array('id', 'username'));
        if (!empty($webmanAdmin)) {
            $webmanAdminStr = Json::encode($webmanAdmin);
            $cookie = new Cookie(array('name' => self::WEBADMIN_LOGIN_KEY, 'value' => $webmanAdminStr));
            \Yii::$app->response->cookies->add($cookie);
        }
    }
    
    /**
     * 获取登录用户的信息
     * @param string $field
     * @return mixed
     */
    public function getLoginInfo($field = null) {
        $loginId = $this->getLoginId();
        $webmanAdmin = $this->getById($loginId);
        if (empty($field)) {
            return $webmanAdmin;
        }
        return $webmanAdmin[$field];
    }
    
    /**
     * 获取登录的管理员Id
     * @return integer
     */
    public function getLoginId() {
        $webmanAdminStr = \Yii::$app->request->cookies->getValue(self::WEBADMIN_LOGIN_KEY);
        $webmanAdmin = Json::decode($webmanAdminStr);
        $loginId = $webmanAdmin['id'];
        return $loginId;
    }
    
    /**
     * 获取登录用户名
     * @return string
     */
    public function getLoginUsername() {
        $webmanAdminStr = \Yii::$app->request->cookies->getValue(self::WEBADMIN_LOGIN_KEY);
        $webmanAdmin = Json::decode($webmanAdminStr);
        return $webmanAdmin['username'];
    }
    
    /**
     * 修改登录用户的密码
     * @param string $password
     * @return boolean true表示修改登录密码成功,false表示登录密码失败
     */
    public function chgLoginPwd($password) {
        $loginInfo = $this->getLoginInfo();
        return !!$this->update($loginInfo['id'], array('password' => StringUtil::genStr($password, $loginInfo['salt'])));
    }
    
    /**
     * 退出当前登录用户
     */
    public function logout() {
        \Yii::$app->response->cookies->remove(self::WEBADMIN_LOGIN_KEY);
    }
}