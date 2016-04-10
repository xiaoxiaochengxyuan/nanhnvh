<?php
namespace app\daos;
use app\bases\BaseDao;
/**
 * 分类对应的Dao
 * @author xiawei
 */
class Category extends BaseDao {
    const TABLE_NAME = 'category';
    /* (non-PHPdoc)
     * @see \app\bases\BaseDao::tableName()
     */
    public function tableName() {
        return self::TABLE_NAME;
    }
    
    /**
     * 单例
     * @param system $className
     * @return Category
     */
    public static function instance($className = __CLASS__){
        return parent::instance($className);
    }
    
    /**
     * 判断name为$name并且pid为$pid的数据是否存在
     * @param string $name
     * @param integer $pid
     * @return boolean true表示存在,false表示不存在
     */
    public function existsByNameAndPid($name, $pid) {
        return $this->createQuery()
            ->from($this->tableName())
            ->where(array('name' => $name, 'pid' => $pid))
            ->exists();
    }
    
    /**
     * 检查pinyin为$pinyin,pid为$pid的数据是否存在
     * @param unknown $pinyin
     * @param unknown $pid
     */
    public function existsByPinyinAndPid($pinyin, $pid) {
        return $this->createQuery()
            ->from($this->tableName())
            ->where(array('pinyin' => $pinyin, 'pid' => $pid))
            ->exists();
    }
    
    /**
     * (non-PHPdoc)
     * @see \app\bases\BaseDao::insert()
     */
    public function insert(array $category) {
        $count = parent::countByField('pid', $category['pid']);
        $sort = $count + 1;
        $category['sort'] = $sort;
        return parent::insert($category);
    }
    
    /**
     * 通过条件字段名和条件字段值,根据sort排序来获取对应的数据
     * @param string $fieldName  条件字段名
     * @param string $fieldValue 条件字段值
     * @param array $select      要查询的数据
     * @return array
     */
    public function listByFieldOrderBySort($fieldName, $fieldValue) {
        if (empty($select)) {
            $select = '*';
        }
        return $this->createQuery()
            ->select(array('c.id', 'c.name', 'c.pinyin', 'p.name as pname', 'c.create_time'))
            ->from($this->tableName().' c')
            ->leftJoin($this->tableName().' p', 'c.pid=p.id')
            ->where("c.{$fieldName}='{$fieldValue}'")
            ->orderBy('c.sort')
            ->all();
    }
    
    /**
     * 判断name为$name,pid为$pid,id不为$id的数据是否存在
     * @param string $name
     * @param integer $pid
     * @param integer $id
     * @return boolean true表示存在,false表示不存在
     */
    public function existsByNameAndPidWithoutId($name, $pid, $id) {
        return $this->createQuery()
            ->from($this->tableName())
            ->where(array('and', "name='{$name}'", "pid='{$pid}'", "id<>'{$id}'"))
            ->exists();
    }
    
    /**
     * 判断pinyin为$pinyin,pid为$pid,id不为$id的数据是否存在
     * @param string  $pinyin
     * @param integer $pid
     * @param integer $id
     * @return boolean true表示存在,false表示不存在
     */
    public function existsByPinyinAndPidWithoutId($pinyin, $pid, $id) {
        return $this->createQuery()
            ->from($this->tableName())
            ->where(array('and', "pinyin='{$pinyin}'", "pid='{$pid}'", "id<>'{$id}'"))
            ->exists();
    }
    
    /**
     * (non-PHPdoc)
     * @see \app\bases\BaseDao::delete()
     */
    public function delete($id) {
        $transaction = $this->db()->beginTransaction();
        if (parent::deleteByField('pid', $id) !== false && parent::delete($id) !== false) {
            $transaction->commit();
            return true;
        }
        $transaction->rollBack();
        return false;
    }
    
    /**
     * (non-PHPdoc)
     * @see \app\bases\BaseDao::up()
     */
    public function up($id) {
        $category1 = $this->getById($id, array('id', 'sort', 'pid'));
        if ($category1['sort'] > 1) {
            $category2 = $this->getBySortAndPid($category1['sort'] - 1, $category1['pid'], array('id', 'sort', 'pid'));
            if ($this->reChange('sort', $category1['id'], $category2['id'])) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * (non-PHPdoc)
     * @see \app\bases\BaseDao::down()
     */
    public function down($id) {
        $category1 = $this->getById($id, array('id', 'sort', 'pid'));
        $count = $this->countByPid($category1['pid']);
        if ($category1['sort'] < $count) {
            $category2 = $this->getBySortAndPid($category1['sort'] + 1, $category1['pid'], array('id', 'sort', 'pid'));
            if ($this->reChange('sort', $category1['id'], $category2['id'])) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * (non-PHPdoc)
     * @see \app\bases\BaseDao::top()
     */
    public function top($id) {
        $category1 = $this->getById($id, array('id', 'sort', 'pid'));
        if ($category1['sort'] > 1) {
            $sql = "update {$this->tableName()} set sort=sort+1 where sort<{$category1['sort']} and pid='{$category1['pid']}'";
            $transaction = $this->db()->beginTransaction();
            if ($this->db()->createCommand($sql)->execute() && $this->update($category1['id'], array('sort' => 1))) {
                $transaction->commit();
                return true;
            }
            $transaction->rollBack();
        }
        return false;
    }
    
    /**
     * (non-PHPdoc)
     * @see \app\bases\BaseDao::end()
     */
    public function end($id) {
        $category1 = $this->getById($id, array('id', 'sort', 'pid'));
        $count = $this->countByField('pid', $category1['pid']);
        if ($category1['sort'] < $count) {
            $sql = "update {$this->tableName()} set sort=sort-1 where sort>{$category1['sort']} and pid='{$category1['pid']}'";
            $transaction = $this->db()->beginTransaction();
            if ($this->db()->createCommand($sql)->execute() && $this->update($category1['id'], array('sort' => $count))) {
                $transaction->commit();
                return true;
            }
            $transaction->rollBack();
        }
        return false;
    }
    /**
     * 通过Sort和pid获取对应的数据
     * @param integer $sort category对应的排序
     * @param unknown $pid  category对应的pid
     * @param array $select 要查询的数据
     * @return array
     */
    public function getBySortAndPid($sort, $pid, array $select = null) {
        $select = empty($select) ? '*' : $select;
        return $this->createQuery()
            ->select($select)
            ->from($this->tableName())
            ->where(array('sort' => $sort, 'pid' => $pid))
            ->one();
    }
    
    /**
     * 通过Pid来获取所有的行数
     * @param integer $pid
     * @return integer
     */
    public function countByPid($pid) {
        return $this->createQuery()
            ->from($this->tableName())
            ->where(array('pid' => $pid))
            ->count();
    }
    
    
    public function listAll() {
        $categories = $this->createQuery()
            ->select('*')
            ->from($this->tableName())
            ->where(array('pid' => 0))
            ->orderBy('sort')
            ->all();
    }
    
    /**
     * 通过Sort正序获取对应的栏目
     * @param array $select
     */
    public function listOrderBySort(array $select = null) {
        if (empty($select)) {
            $select = '*';
        }
        $navs = $this->createQuery()
            ->select($select)
            ->from($this->tableName())
            ->where(array('pid' => 0))
            ->orderBy('sort asc')
            ->all();
        foreach ($navs as &$nav) {
            $nav['children'] = $this->createQuery()
                ->select($select)
                ->from($this->tableName())
                ->where(array('pid' => $nav['id']))
                ->orderBy('sort asc')
                ->all();
        }
        return $navs;
    }
    
    
    public function dropList() {
        //首先获取所有的顶级栏目
        $topCategories = $this->listByField('pid', 0, array('id', 'name'));
        $data = array();
        foreach ($topCategories as $category) {
            $id = $category['id'];
            $categories = $this->listByField('pid', $id, array('id', 'name'));
            if (!empty($categories)) {
                $data[$category['name']] = array();
                foreach ($categories as $c) {
                    $data[$category['name']][$c['id']] = $c['name'];
                }
            } else {
                $data[$id] = $category['name'];
            }
        }
        return $data;
    }
}