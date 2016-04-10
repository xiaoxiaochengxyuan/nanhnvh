<?php
namespace app\daos;
use app\bases\BaseDao;
class Hot extends BaseDao {
    const TABLE_NAME = 'hot';
    /**
     * {@inheritDoc}
     * @see \app\bases\BaseDao::tableName()
     */
    public function tableName() {
        // TODO Auto-generated method stub
        return self::TABLE_NAME;
    }
    
    /**
     * 单例
     * @param unknown $className
     * @return Hot
     */
    public static function instance($className = __CLASS__) {
        return parent::instance($className);
    }
    
    
    /**
     * {@inheritDoc}
     * @see \app\bases\BaseDao::insert()
     */
    public function insert(array $data) {
        $count = $this->count();
        $sort = $count + 1;
        $data['sort'] = $sort;
        return parent::insert($data);
    }

    /**
     * 获取最新的热点数据
     * @param integer $offset 从第几条开始获取
     * @param integer $limit  获取多少条
     * @param array $select   要查询的数据
     * @return array
     */
    public function listNews($offset, $limit, array $select = null) {
        $select = empty($select) ? '*' : $select;
        return $this->createQuery()
            ->select($select)
            ->from($this->tableName())
            ->orderBy('sort asc')
            ->offset($offset)
            ->limit($limit)
            ->all();
    }
    
    /**
     * 通过名字来判断id不是id的数据是否存在
     * @param string  $name 热门标签对应的名称
     * @param integer $id   要排除的id
     * @return boolean true表示数据存在,false表示数据不存在
     */
    public function existsByFieldWithoutId($fieldName, $fieldValue, $id) {
        return $this->createQuery()
            ->from($this->tableName())
            ->where(array('and', "{$fieldName}='{$fieldValue}'", "id<>'{$id}'"))
            ->exists();
    }
    
    /**
     * 获取所有热点的名称
     * @return array
     */
    public function listNameAccessId() {
         return $this->createQuery()
            ->select(array('name'))
            ->from($this->tableName())
            ->indexBy('id')
            ->column();
    }
    
    /**
     * {@inheritDoc}
     * @see \app\bases\BaseDao::delete()
     */
    public function delete($id) {
        $transaction = $this->db()->beginTransaction();
        if (parent::delete($id) && $this->db()->createCommand()->delete('hot_article', array('hot_id' => $id))->execute() !== false) {
            $transaction->commit();
            return true;
        }
        $transaction->rollBack();
        return false;
    }
}