<div class="row">
    <div class="col-mod-12">
        <ul class="breadcrumb">
            <li><a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman'))?>">NanhNvh</a></li>
            <li><a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman'))?>">内容管理系统</a></li>
            <li class="active">友情链接</li>
        </ul>
        <h3 class="page-header">
            <span><i class="fa fa-chain"></i>友情链接</span>
            <span style="float: right; margin-right: 20px;">
                <a class="btn btn-success btn-sm" href="<?php echo Yii::$app->urlManager->createUrl(array('/webman/friend-link/add'))?>">
                    <i class="fa fa-chain"></i>&nbsp;&nbsp;添加友情链接
                </a>
            </span>
        </h3>
    </div>
    <table id="example" class="table table-bordered table-hover todo-table">
    	<thead>
            <tr>
                <th>ID</th><th>名称</th><th>网址</th><th>操作</th>
            </tr>
        </thead>
        <tbody>
        	<?php foreach ($friendLinks as $friendLink):?>
        		<tr>
        			<td><?php echo $friendLink['id']?></td>
        			<td><?php echo $friendLink['name']?></td>
        			<td><a href="<?php echo $friendLink['url']?>"><?php echo $friendLink['url']?></a></td>
        			<td>
        				<a class="btn btn-primary btn-sm btn-animate-demo" href="<?php echo Yii::$app->urlManager->createUrl(array('/webman/friend-link/update', 'id' => $friendLink['id']))?>">修改</a>
        				<button onclick="delObj('<?php echo $friendLink['id']?>')" class="btn btn-danger btn-sm btn-animate-demo">删除</button>
                        <button onclick="up('<?php echo $friendLink['id']?>')" class="btn btn-sm btn-success btn-animate-demo">上移</button>
                        <button onclick="down('<?php echo $friendLink['id']?>')" class="btn btn-sm btn-info btn-animate-demo">下移</button>
                        <button onclick="toTop('<?php echo $friendLink['id']?>')" class="btn btn-warning btn-sm btn-animate-demo">置顶</button>
                        <button onclick="toEnd('<?php echo $friendLink['id']?>')" class="btn btn-default btn-sm btn-animate-demo">置尾</button>
        			</td>
        		</tr>
        	<?php endforeach;?>
        </tbody>
    </table>
</div>