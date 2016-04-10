<?php
namespace app\daos;
use app\bases\BaseDao;
/**
 * 友情链接对应的dao
 * @author xiawei
 */
class FriendLink extends BaseDao {
    const TABLE_NAME = 'friend_link';
    /**
     * {@inheritDoc}
     * @see \app\bases\BaseDao::tableName()
     */
    public function tableName() {
        return self::TABLE_NAME;
    }
    
    /**
     * 友情链接表
     * @param string $className
     * @return FriendLink
     */
    public static function instance($className = __CLASS__){
        return parent::instance($className);
    }
    
    /**
     * {@inheritDoc}
     * @see \app\bases\BaseDao::insert()
     */
    public function insert(array $data){
        $count = $this->count();
        $data['sort'] = $count + 1;
        return parent::insert($data);
    }
    
    /**
     * 按照sort倒叙获取所有的友情链接
     * @return array
     */
    public function listAllBySort() {
        return $this->createQuery()
            ->select('*')
            ->from($this->tableName())
            ->orderBy('sort asc')
            ->all();
    }
}