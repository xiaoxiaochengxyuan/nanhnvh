<?php
use yii\widgets\LinkPager;
use yii\base\Widget;
?>
<div class="row">
    <div class="col-mod-12">
        <ul class="breadcrumb">
            <li><a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman'))?>">NanhNvh</a></li>
            <li><a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman'))?>">内容管理系统</a></li>
            <li class="active">热点管理</li>
        </ul>
        <h3 class="page-header">
            <span><i class="fa fa-rss-square"></i>&nbsp;热点列表</span>
            <span style="float: right; margin-right: 20px;">
                <a class="btn btn-success btn-sm" href="<?php echo Yii::$app->urlManager->createUrl(array('/webman/hot/add'))?>">添加热点</a>
            </span>
        </h3>
    </div>
    <table id="example" class="table table-bordered table-hover todo-table">
        <thead>
            <tr>
                <th>ID</th><th>名称</th><th>创建时间</th><th>操作</th>
            </tr>
        </thead>
        <tbody>
        	<?php foreach ($hots as $hot):?>
        		<tr>
        			<td><?php echo $hot['id']?></td>
        			<td><?php echo $hot['name']?></td>
        			<td><?php echo date('Y-m-d H:i:s', $hot['create_time'])?></td>
        			<td>
        				<a class="btn btn-primary btn-sm btn-animate-demo" href="<?php echo Yii::$app->urlManager->createUrl(array('/webman/hot/update', 'id' => $hot['id']))?>">修改</a>
        				<button onclick="delObj('<?php echo $hot['id']?>')" class="btn btn-danger btn-sm btn-animate-demo">删除</button>
                        <button onclick="up('<?php echo $hot['id']?>')" class="btn btn-sm btn-success btn-animate-demo">上移</button>
                        <button onclick="down('<?php echo $hot['id']?>')" class="btn btn-sm btn-info btn-animate-demo">下移</button>
                        <button onclick="toTop('<?php echo $hot['id']?>')" class="btn btn-warning btn-sm btn-animate-demo">置顶</button>
                        <button onclick="toEnd('<?php echo $hot['id']?>')" class="btn btn-default btn-sm btn-animate-demo">置尾</button>
        			</td>
        		</tr>
        	<?php endforeach;?>
        </tbody>
    </table>
    <div style="text-align: center;">
    	<?php echo LinkPager::widget(array(
    	    'pagination' => $pagination,
    	    'prevPageLabel' => '上一页',
    	    'nextPageLabel' => '下一页',
    	    'firstPageCssClass' => '',
    	    'lastPageCssClass' => '',
    	    'firstPageLabel' => '首页',
    	    'lastPageLabel' => '末页',
    	    'maxButtonCount'=>5,
    	))?>
    </div>
</div>