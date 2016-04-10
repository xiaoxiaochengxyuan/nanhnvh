<div class="pixx">
	<h4 style="margin-bottom: 10px;">热点</h4>
	<?php foreach ($hots as $hot):?>
		<span class="pixx_hot"><a href="<?php echo Yii::$app->urlManager->createUrl(array('/article/hlist', 'hid' => $hot['id']))?>"><?php echo $hot['name']?></a></span>
	<?php endforeach;?>
</div>