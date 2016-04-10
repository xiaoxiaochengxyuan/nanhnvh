<div class="pixx">
	<h4>热门推荐</h4>
	<?php foreach ($hotTuijianArticles as $article):?>
		<div class="pixx_link"><a href="<?php echo Yii::$app->urlManager->createUrl(array('/article', 'id' => $article['id']))?>"><?php echo $article['title']?></a></div>
	<?php endforeach;?>
</div>