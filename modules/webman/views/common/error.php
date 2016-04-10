<?php
use yii\helpers\Html;
$this->title = $name;
?>
<div class="row">
    <div class="col-mod-12">
        <ul class="breadcrumb">
            <li><a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman'))?>">NanhNvh</a></li>
            <li><a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman'))?>">内容管理系统</a></li>
            <li class="active">错误</li>
        </ul>
        <h3 class="page-header"><i class="fa fa-times-circle"></i>错误</h3>
    </div>
    <div class="row" style="padding: 0 40px;">
        <div class="site-error">
            <h1><?= Html::encode($this->title) ?></h1>
            <div class="alert alert-danger">
                <?= nl2br(Html::encode($message)) ?>
            </div>
            <p>The above error occurred while the Web server was processing your request.</p>
            <p>Please contact us if you think this is a server error. Thank you.</p>
        </div>
    </div>
</div>
