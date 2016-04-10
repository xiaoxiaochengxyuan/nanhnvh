<script type="text/javascript">
$(function(){
	$(".nav ul li").hover(function(){
		var cat_div = $(this).find('.c_cat_div');
		t = setTimeout(function(){
			cat_div.show()
		}, 100);
	}, function(){
		clearTimeout(t);
		$(this).find('.c_cat_div').hide();
	});
});
</script>
<div class="nav">
    <ul>
        <li >
            <a href="<?php echo Yii::$app->urlManager->createUrl(array('/'))?>">首页</a>
        </li>
        <?php foreach ($categories as $category):?>
            <li>
                <a href="<?php echo Yii::$app->urlManager->createUrl(array('/cat/list', 'from' => $category['pinyin']))?>"><?php echo $category['name']?></a>
                <?php if (!empty($category['children'])):?>
                    <div class="c_cat_div">
                        <?php foreach ($category['children'] as $cat):?>
                            <div>
                                <a href="<?php echo Yii::$app->urlManager->createUrl(array('/cat/list', 'from' => $cat['pinyin']))?>"><?php echo $cat['name']?></a>
                            </div>
                        <?php endforeach;?>
                    </div>
                <?php endif;?>
            </li>
        <?php endforeach;?>
        <li>
            <a href="<?php echo Yii::$app->urlManager->createUrl(array('/'))?>">新手指南</a>
        </li>
        <li>
            <a href="<?php echo Yii::$app->urlManager->createUrl(array('/'))?>">关于我们</a>
        </li>
    </ul>
</div>