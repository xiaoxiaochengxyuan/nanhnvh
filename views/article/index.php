<?php 
use app\widgets\BashiWidget;
use app\widgets\HotTuijianWidget;
use app\widgets\NewArticleWidget;
use app\widgets\HotWidget;
?>
<script type="text/javascript">
function comment() {
	$.get("<?php echo Yii::$app->urlManager->createUrl(array('/user/check-login'))?>", null, function(response) {
		var res = eval('(' + response + ')');
		if(!res) {
			alert("请先登录之后再评论");
			window.location.href = "<?php echo Yii::$app->urlManager->createUrl(array('/user/login', 'from' => urlencode(Yii::$app->request->getUrl())))?>";
		} else {
			var commentTxt = $("#comment").val();
			if(commentTxt == null || commentTxt == "") {
				alert("对不起,评论不能为空");
			} else {
				$.post("<?php echo Yii::$app->urlManager->createUrl(array('/article/comment'))?>", {
					"comment" : commentTxt,
					"articleId" : "<?php echo $article['id']?>"
				}, function(resp) {
					
				});
			}
		}
	});
}
</script>
<div class="web-main">
	<div class="index-left">
		<div class="tipcl">
			男孩女孩 > 文章详情 > <?php echo $article['title']?>
		</div>
		<div class="article">
			<div class="article_title">
				<h2><?php echo $article['title']?></h2>
				<p>作者：xiawei&nbsp;&nbsp;&nbsp;创建时间：2016-04-04</p>
			</div>
			<div class="article_desc">
				<?php echo $article['description']?>
			</div>
			<div class="article_detail">
				<?php echo $article['content']?>
			</div>
			<div class="comment">
				<h3>用户评论</h3>
				<div class="commentEdit">
					<textarea id="comment"></textarea>
				</div>
				<div class="commonBtn">
					<button onclick="comment();">评论</button>
				</div>
			</div>
		</div>
	</div>
	<div class="index-right">
		<?php echo BashiWidget::widget()?>
		<?php echo HotTuijianWidget::widget()?>
		<?php echo NewArticleWidget::widget()?>
		<?php echo HotWidget::widget()?>
	</div>
</div>