<?php
namespace app\daos;
use app\bases\BaseDao;
/**
 * 评论对应的Dao
 * @author xiawei
 */
class Comment extends BaseDao {
	const TABLE_NAME = 'comment';
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
	 * @return Comment
	 */
	public static function instance($className = __CLASS__) {
		return parent::instance($className);
	}
}