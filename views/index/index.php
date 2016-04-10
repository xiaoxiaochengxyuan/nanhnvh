<?php
use app\widgets\BashiWidget;
use app\widgets\HotTuijianWidget;
use yii\base\Widget;
use app\widgets\NewArticleWidget;
use app\widgets\HotWidget;
?>
<div class="web-main">
	<div class="index-left">
		<div class="lunbo">
			<img alt="轮播图" src="<?php echo Yii::$app->urlManager->baseUrl?>/assets/imgs/banner.jpg" style="width:100%;">
		</div>
		<div class="day-hot title-box">
			<h4 class="title">每日热门</h4>
			<ul>
				<?php foreach ($dayHotArticles as $dayHotArticle):?>
					<li><a href="<?php echo Yii::$app->urlManager->createUrl(array('/article', 'id' => $dayHotArticle['id']))?>"><?php echo $dayHotArticle['title']?></a></li>
				<?php endforeach;?>
			</ul>
		</div>
		<div class="tuwen">
			<h4>推荐主题</h4>
			<?php foreach ($topicTuijianArticles as $article):?>
				<div class="wen">
    				<div class="wen-img">
    					<img src="<?php echo $article['title_img']?>" width="210" height="140"/>
    				</div>
    				<div class="title">
    					<a href="<?php echo Yii::$app->urlManager->createUrl(array('/article', 'id' => $article['id']))?>"><?php echo $article['title']?></a>
    				</div>
    				<div class="info"><?php echo $article['create_username']?> 发表于 <?php echo date('Y-m-d H:i', $article['create_time'])?></div>
    				<div class="desc"><?php echo $article['description']?></div>
    				<div class="tag"><?php echo $article['category_name']?></div>
    			</div>
			<?php endforeach;?>
			<a class="more" href="###">看更多</a>
		</div>
	</div>
	<div class="index-right">
		<?php echo BashiWidget::widget()?>
		<?php echo HotTuijianWidget::widget()?>
		<?php echo NewArticleWidget::widget()?>
		<?php echo HotWidget::widget()?>
	</div>
	<div class="friend">
		<span class="friend_title">友情链接</span>
		<span>
			<?php foreach ($friendLinks as $friendLink):?>
				<span class="friend_link"><a href="<?php echo $friendLink['url']?>" target="_blank"><?php echo $friendLink['name']?></a></span>
			<?php endforeach;?>
		</span>
	</div>
</div>