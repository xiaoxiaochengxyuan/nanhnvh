<?php
namespace app\daos;
use app\bases\BaseDao;
/**
 * 文章对应的Dao
 * @author xiawei
 */
class Article extends BaseDao {
    const TABLE_NAME = 'article';
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
     * @return Article
     */
    public static function instance($className = __CLASS__) {
        return parent::instance($className);
    }
    
    /**
     * {@inheritDoc}
     * @see \app\bases\BaseDao::insert()
     */
    public function insert(array $article) {
        $hots = $article['hots'];
        unset($article['hots']);
        $article['create_webman_admin_id'] = WebmanAdmin::instance()->getLoginId();
        $transaction = $this->db()->beginTransaction();
        if (parent::insert($article)) {
            $articleId = $this->db()->getLastInsertID();
            $flag = true;
            foreach ($hots as $hot) {
                $flag = $flag && $this->db()->createCommand()->insert('hot_article', array('article_id' => $articleId, 'hot_id' => $hot))->execute();
                if (!$flag) {
                    break;
                }
            }
            if ($flag) {
                $transaction->commit();
                return true;
            }
        }
        $transaction->rollBack();
        return false;
    }
    
    
    public function update($id, array $article) {
        $hots = $article['hots'];
        unset($article['hots']);
        $transaction = $this->db()->beginTransaction();
        if (parent::update($article['id'], $article)) {
            $flag = $this->db()->createCommand()->delete('hot_article', array('article_id' => $article['id']))->execute();
            if ($flag !== false) {
                $flag = true;
            } else {
                $transaction->rollBack();
                return false;
            }
            foreach ($hots as $hot) {
                $flag = $flag && $this->db()->createCommand()->insert('hot_article', array('article_id' => $article['id'], 'hot_id' => $hot))->execute();
                if (!$flag) {
                    break;
                }
            }
            if ($flag) {
                $transaction->commit();
                return true;
            }
        }
        $transaction->rollBack();
        return false;
    }
    
    /**
     * 通过搜索表单查询满足条件的总数
     * @param array $search 搜索条件
     * @return integer
     */
    public function countBySearch(array $search) {
        $condition = array('and');
        if (!empty($search['title'])) {
            $condition[] = array('like', 'title', $search['title']);
        }
        if (!empty($search['description'])) {
            $condition[] = array('like', 'description', $search['description']);
        }
        if (!empty($search['day_hot'])) {
            $condition[] = "day_hot='{$search['day_hot']}'";
        }
        if (!empty($search['hot_tuijian'])) {
            $condition[] = "hot_tuijian='{$search['hot_tuijian']}'";
        }
        if (!empty($search['category_id'])) {
            $condition[] = "category_id='{$search['category_id']}'";
        }
        return $this->createQuery()
            ->from($this->tableName())
            ->where($condition)
            ->count();
    }
    
    /**
     * 通过查询表单分页获取文章列表
     * @param array $search   查询条件
     * @param integer $offset 从第几条开始获取
     * @param integer $limit 获取多少条
     * @return array
     */
    public function listBySearch(array $search, $offset, $limit) {
        $condition = array('and');
        if (!empty($search['title'])) {
            $condition[] = array('like', 'a.title', $search['title']);
        }
        if (!empty($search['description'])) {
            $condition[] = array('like', 'a.description', $search['description']);
        }
        if (!empty($search['day_hot'])) {
            $condition[] = "a.day_hot='{$search['day_hot']}'";
        }
        if (!empty($search['hot_tuijian'])) {
            $condition[] = "a.hot_tuijian='{$search['hot_tuijian']}'";
        }
        if (!empty($search['category_id'])) {
            $condition[] = "a.category_id='{$search['category_id']}'";
        }
        $articles = $this->createQuery()
            ->select(array('a.id', 'a.title', 'w.username as create_webman_admin_username', 'a.description', 'a.title_img', 'a.day_hot', 'a.hot_tuijian', 'c.name as category_name', 'h.name as hot_name'))
            ->from($this->tableName().' a')
            ->leftJoin(WebmanAdmin::TABLE_NAME.' w', 'w.id=a.create_webman_admin_id')
            ->leftJoin(Category::TABLE_NAME.' c', 'c.id=a.category_id')
            ->leftJoin('hot_article ha', 'ha.article_id=a.id')
            ->leftJoin('hot h', 'h.id=ha.hot_id')
            ->where($condition)
            ->offset($offset)
            ->limit($limit)
            ->all();
        $articleList = array();
        foreach ($articles as $article) {
            if (!isset($articleList[$article['id']])) {
                $articleList[$article['id']] = $article;
            } else {
                $articleList[$article['id']]['hot_name'] .= ','.$article['hot_name'];
            }
        }
        return $articleList;
    }
    
    /**
     * 通过文章Id来获取对应的热点Id
     * @param integer $id 对应的文章id
     * @return array
     */
    public function getHotIdsById($id) {
        return $this->createQuery()
            ->select('hot_id')
            ->from('hot_article')
            ->where(array('article_id' => $id))
            ->column();
    }
    
    /**
     * 获取每日热门文章
     * @param integer $limit 要获取多少条
     * @return array
     */
    public function listDayHot($limit) {
        return $this->createQuery()
            ->select(array('id', 'title'))
            ->from($this->tableName())
            ->where(array('day_hot' => 1))
            ->limit($limit)
            ->orderBy('create_time desc')
            ->all();
    }
    
    /**
     * {@inheritDoc}
     * @see \app\bases\BaseDao::delete()
     */
    public function delete($id) {
        $transaction = $this->db()->beginTransaction();
        //首先删除文章
        if (parent::delete($id) && $this->db()->createCommand()->delete('hot_article', array('article_id' => $id))->execute() !== false) {
            $transaction->commit();
            return true;
        }
        $transaction->rollBack();
        return false;
    }
    
    /**
     * 获取热门推荐对应的文章
     * @param integer $limit 要列出多少条文章
     */
    public function listTuijian($limit) {
    	return $this->createQuery()
    		->select(array('id', 'title'))
    		->from($this->tableName())
    		->where(array('hot_tuijian' => 1))
    		->orderBy('create_time desc')
    		->limit($limit)
    		->all();
    }
    
    /**
     * 获取最新文章
     * @param integer $limit 列出多条最新文章
     * @return array
     */
    public function listNew($limit) {
    	return $this->createQuery()
    		->select(array('id', 'title'))
    		->from($this->tableName())
    		->orderBy('create_time desc')
    		->limit($limit)
    		->all();
    }
    
    /**
     * 获取最新的主题推荐文章
     * @param integer $limit 要获取多少条
     * @return array
     */
    public function listTopicTuijian($limit) {
    	return $this->createQuery()
    		->select(array('a.id', 'a.title', 'a.create_time', 'a.description', 'a.title_img', 'a.create_time', 'w.username as create_username', 'c.name as category_name'))
    		->from($this->tableName().' a')
    		->leftJoin(WebmanAdmin::TABLE_NAME.' w', 'w.id=a.create_webman_admin_id')
    		->leftJoin(Category::TABLE_NAME.' c', 'c.id=a.category_id')
    		->where(array('a.article_create_type' => ARTICLE_CREATE_TYPE_SYSTEM, 'topic_tuijian' => 1))
    		->orderBy('a.create_time desc')
    		->limit($limit)
    		->all();
    }
}