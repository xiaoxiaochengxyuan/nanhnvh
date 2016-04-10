<script type="text/javascript">
$(function() {
	var interval = setInterval(function(){
		var time = $("#time").html();
		time = parseInt(time);
		time --;
		$("#time").html(time);
		if(time == 0) {
			window.location.href = "<?php echo $dataArr['redirectUrl']?>";
		}
	}, 1000);
});
</script>
<div class="show-msg">
    <div class="center msg-txt"><?php echo $dataArr['msg']?></div>
    <div class="center"><span id="time">3</span>秒以后跳转到　<a href="<?php echo $dataArr['redirectUrl']?>" class="red-txt"><?php echo $dataArr['redirectPageName']?></a></div>
</div>