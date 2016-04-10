<?php
namespace app\daos;
use app\bases\BaseDao;
/**
 * Cron锁
 * @author xiawei
 */
class CmdLock extends BaseDao {
    const TABLE_NAME = 'cmd_lock';
    /**
     * {@inheritDoc}
     * @see \app\bases\BaseDao::tableName()
     */
    public function tableName() {
        return self::TABLE_NAME;
    }
    
    /**
     * 单例
     * @param string $className
     * @return CmdLock
     */
    public static function instance($className = __CLASS__) {
        // TODO Auto-generated method stub
        return parent::instance($className);
    }
    
    
    public function getByControllerAndAction($controllerId, $actionId) {
        return $this->createQuery()
            ->from($this->tableName())
            ->where(array('controller_id' => $controllerId, 'action_id' => $actionId))
            ->one();
    }
}