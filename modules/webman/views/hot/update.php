<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-mod-12">
        <ul class="breadcrumb">
            <li><a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman'))?>">NanhNvh</a></li>
            <li><a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman'))?>">内容管理系统</a></li>
            <li class="active">热点管理</li>
        </ul>
        <h3 class="page-header">
            <span><i class="fa fa-rss-square"></i>&nbsp;添加热点</span>
        </h3>
    </div>
    <div class="row">
    	<?php $form = ActiveForm::begin(array('id' => 'add-form', 'options' => array('class' => 'form-horizontal row-border')))?>
    		<?php echo Html::hiddenInput('HotForm[id]', $hotForm->id)?>
    		<div class="form-group">
                <label class="col-sm-3 control-label">热点名称：</label>
                <div class="col-sm-6">
                    <?php echo Html::textInput('HotForm[name]', $hotForm->name, array('class' => 'form-control', 'placeholder' => '分类名称'))?>
                </div>
                <div class="col-sm-3">
                    <p class="help-block"><?php echo Html::error($hotForm, 'name')?></p>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3">
                    <?php echo Html::submitButton('修改', array('class' => 'btn btn-success'))?>
                </div>
            </div>
    	<?php ActiveForm::end()?>
    </div>
</div>