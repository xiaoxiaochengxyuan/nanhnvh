<div class="row">
    <div class="col-mod-12">
        <ul class="breadcrumb">
            <li><a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman'))?>">NanhNvh</a></li>
            <li><a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman'))?>">内容管理系统</a></li>
            <li class="active">分类管理</li>
        </ul>
        <h3 class="page-header">
            <span><i class="fa fa-reorder"></i>分类列表</span>
            <span style="float: right; margin-right: 20px;">
                <a class="btn btn-success btn-sm" href="<?php echo Yii::$app->urlManager->createUrl(array('/webman/category/add', 'pid' => $pid))?>">
                    <i class="fa fa-reorder"></i>&nbsp;&nbsp;
                    <?php echo $pid == 0 ? '添加顶级栏目' : '添加栏目'?>
                </a>
            </span>
        </h3>
    </div>
    
    <table id="example" class="table table-bordered table-hover todo-table">
        <thead>
            <tr>
                <th>ID</th><th>名称</th><th>父栏目名称</th><th>拼音</th><th>创建时间</th><th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category):?>
                <tr>
                    <td><?php echo $category['id']?></td>
                    <td><?php echo $category['name']?></td>
                    <td><?php echo empty($category['pname']) ? '无' : $category['pname']?></td>
                    <td><?php echo $category['pinyin']?></td>
                    <td><?php echo date('Y-m-d H:i:s', $category['create_time'])?></td>
                    <td>
                        <a class="btn btn-primary btn-sm btn-animate-demo" href="<?php echo Yii::$app->urlManager->createUrl(array('/webman/category/update', 'id' => $category['id']))?>">修改</a>
                        <button onclick="delObj('<?php echo $category['id']?>')" class="btn btn-danger btn-sm btn-animate-demo">删除</button>
                        <button onclick="up('<?php echo $category['id']?>')" class="btn btn-sm btn-success btn-animate-demo">上移</button>
                        <button onclick="down('<?php echo $category['id']?>')" class="btn btn-sm btn-info btn-animate-demo">下移</button>
                        <button onclick="toTop('<?php echo $category['id']?>')" class="btn btn-warning btn-sm btn-animate-demo">置顶</button>
                        <button onclick="toEnd('<?php echo $category['id']?>')" class="btn btn-default btn-sm btn-animate-demo">置尾</button>
                        <a class="btn btn-info btn-sm btn-animate-demo" href="<?php echo Yii::$app->urlManager->createUrl(array('/webman/category', 'pid' => $category['id']))?>">查看子分类</a>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
