<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-mod-12">
        <ul class="breadcrumb">
            <li><a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman'))?>">NanhNvh</a></li>
            <li><a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman'))?>">内容管理系统</a></li>
            <li class="active">显示信息</li>
        </ul>
        <h3 class="page-header">
            <span><i class="fa fa-tint"></i>&nbsp;显示信息</span>
        </h3>
    </div>
    <div class="row">
    	<?php $form = ActiveForm::begin(array('id' => 'add-form', 'options' => array('class' => 'form-horizontal row-border')))?>
    		<div class="form-group">
                <label class="col-sm-3 control-label">注册用户数量：</label>
                <div class="col-sm-6">
                    <?php echo Html::textInput('ShowMsgForm[reg_count]', $showMsgForm->reg_count, array('class' => 'form-control', 'placeholder' => '注册用户数量'))?>
                </div>
                <div class="col-sm-3">
                    <p class="help-block"><?php echo Html::error($showMsgForm, 'reg_count')?></p>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3">
                    <?php echo Html::submitButton('提交', array('class' => 'btn btn-success'))?>
                </div>
            </div>
    	<?php ActiveForm::end()?>
    </div>
</div>