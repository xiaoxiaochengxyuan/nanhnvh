<?php
namespace app\forms;
use yii\base\Model;
/**
 * 友情链接对应的Form表单
 * @author xiawei
 */
class FriendLinkForm extends Model {
    /**
     * 自增Id
     * @var integer
     */
    public $id;
    /**
     * 友情链接名称
     * @var string
     */
    public $name;
    
    /**
     * 友情链接对应的url
     * @var string
     */
    public $url;
    
    public function rules() {
        return array(
            array('name', 'required', 'on' => array('add', 'update'), 'message' => '名称不能为空'),
            array('url', 'url', 'on' => array('add', 'update'), 'message' => '网址不正确', 'skipOnEmpty' => false)
        );
    }
}