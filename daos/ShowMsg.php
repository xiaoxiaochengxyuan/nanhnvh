<?php
namespace app\daos;
use app\bases\BaseDao;
/**
 * 展示信息相关的Dao
 * @author xiawei
 */
class ShowMsg extends BaseDao {
    private $msg = null;
    const TABLE_NAME = 'show_msg';
    /**
     * {@inheritDoc}
     * @see \app\bases\BaseDao::tableName()
     */
    public function tableName() {
        return self::TABLE_NAME;
    }

    /**
     * 单例
     * @param system $className
     * @return ShowMsg
     */
    public static function instance($className = __CLASS__) {
        return parent::instance($className);
    }
    
    /**
     * 加载对应的显示信息
     * @param string $field 对应的字段
     * @return mixed
     */
    public function load($field = null) {
        if (empty($this->msg)) {
            $this->msg = $this->createQuery()
                ->select('*')
                ->from($this->tableName())
                ->one();
        }
        return empty($field) ? $this->msg : $this->msg[$field];
    }
}