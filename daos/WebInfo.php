<?php
namespace app\daos;
use app\bases\BaseDao;
/**
 * web_info对应的Dao
 * @author xiawei
 */
class WebInfo extends BaseDao {
    private $info = null;
    const TABLE_NAME = 'web_info';
    /* (non-PHPdoc)
     * @see \app\bases\BaseDao::tableName()
     */
    public function tableName() {
        return self::TABLE_NAME;
    }
    
    /**
     * 单例
     * @param system $className
     * @return WebInfo
     */
    public static function instance($className = __CLASS__){
        return parent::instance($className);
    }
    
    /**
     * 获取网站基本信息
     * @return array
     */
    public function get() {
        return $this->createQuery()
            ->select('*')
            ->from($this->tableName())
            ->one();
    }
    
    /**
     * 获取网站基本信息,一次请求只会加载一次
     * @return array
     */
    public function load() {
        if (empty($this->info)) {
            $this->info = $this->get();
        }
        return $this->info;
    }
    
    /**
     * 编辑网站基本信息
     * @param array $webInfo 网站基本信息
     * @return number 影响的行数
     */
    public function edit(array $webInfo) {
        $exists = $this->createQuery()
            ->from($this->tableName())
            ->exists();
        if (!$exists) {
            return parent::insert($webInfo);
        }
        return parent::updateAll($webInfo);
    }
}