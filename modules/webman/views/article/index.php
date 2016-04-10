<?php
use app\utils\StringUtil;
?>
<div class="row">
    <div class="col-mod-12">
        <ul class="breadcrumb">
            <li><a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman'))?>">NanhNvh</a></li>
            <li><a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman'))?>">内容管理系统</a></li>
            <li class="active">文章管理</li>
        </ul>
        <h3 class="page-header">
            <span><i class="fa fa-book"></i>文章列表</span>
            <span style="float: right; margin-right: 20px;">
                <a class="btn btn-success btn-sm" href="<?php echo Yii::$app->urlManager->createUrl(array('/webman/article/add'))?>">
                    <i class="fa fa-reorder"></i>&nbsp;&nbsp;添加文章
                </a>
            </span>
        </h3>
    </div>
    
    <table id="example" class="table table-bordered table-hover todo-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>标题</th>
                <th>创始人</th>
                <th>描述</th>
                <th>标题图片</th>
                <th>每日热门</th>
                <th>热门推荐</th>
                <th>所在栏目</th>
                <th>对应热点名称</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article):?>
                <tr>
                    <td><?php echo $article['id']?></td>
                    <td><?php echo $article['title']?></td>
                    <td><?php echo $article['create_webman_admin_username']?></td>
                    <td><?php echo StringUtil::utf8Len($article['description']) > 20 ? StringUtil::subStr($article['description'], 0, 20).'...' : $article['description']?></td>
                    <td><img src="<?php echo $article['title_img']?>" style="max-width: 200px;"></td>
                    <td><?php echo $article['day_hot'] == 1 ? '是' : '否'?></td>
                    <td><?php echo $article['hot_tuijian'] == 1 ? '是' : '否'?></td>
                    <td><?php echo $article['category_name']?></td>
                    <td><?php echo $article['hot_name']?></td>
                    <td>
                        <a class="btn btn-info btn-xs" href="<?php echo Yii::$app->urlManager->createUrl(array('/webman/article/update', 'id' => $article['id']))?>">修改</a>
                        <button onclick="delObj('<?php echo $article['id']?>')" class="btn btn-danger btn-sm btn-animate-demo">删除</button>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>