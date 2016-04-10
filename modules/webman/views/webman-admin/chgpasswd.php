<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-mod-12">
        <ul class="breadcrumb">
            <li><a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman'))?>">NanhNvh</a></li>
            <li><a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman'))?>">内容管理系统</a></li>
            <li class="active">修改密码</li>
        </ul>
        <h3 class="page-header"><i class="fa fa fa-dashboard"></i> 修改密码</h3>
    </div>
    <div class="row">
        <?php $form = ActiveForm::begin(array('id' => 'chgpwd-form', 'options' => array('class' => 'form-horizontal row-border')))?>
            <div class="form-group">
                <label class="col-sm-3 control-label">旧密码：</label>
                <div class="col-sm-6">
                    <?php echo Html::passwordInput('WebadminForm[oldPassword]', $webmanAdminForm->oldPassword, array('class' => 'form-control', 'placeholder' => '旧密码'))?>
                </div>
                <div class="col-sm-3">
                    <p class="help-block"><?php echo Html::error($webmanAdminForm, 'oldPassword')?></p>
                </div>
            </div>
            
            
            <div class="form-group">
                <label class="col-sm-3 control-label">新密码：</label>
                <div class="col-sm-6">
                    <?php echo Html::passwordInput('WebadminForm[newPassword]', $webmanAdminForm->newPassword, array('class' => 'form-control', 'placeholder' => '新密码'))?>
                </div>
                <div class="col-sm-3">
                    <p class="help-block"><?php echo Html::error($webmanAdminForm, 'newPassword')?></p>
                </div>
            </div>
            
            
            <div class="form-group">
                <label class="col-sm-3 control-label">重复密码：</label>
                <div class="col-sm-6">
                    <?php echo Html::passwordInput('WebadminForm[rePassword]', $webmanAdminForm->rePassword, array('class' => 'form-control', 'placeholder' => '重复密码'))?>
                </div>
                <div class="col-sm-3">
                    <p class="help-block"><?php echo Html::error($webmanAdminForm, 'rePassword')?></p>
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