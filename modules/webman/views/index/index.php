<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-mod-12">
        <ul class="breadcrumb">
            <li><a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman'))?>">NanhNvh</a></li>
            <li><a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman'))?>">内容管理系统</a></li>
            <li class="active">网站基本信息</li>
        </ul>
        <h3 class="page-header"><i class="fa fa-leaf"></i>网站基本信息</h3>
    </div>
    <div class="row">
        <?php $form = ActiveForm::begin(array('id' => 'chgpwd-form', 'options' => array('class' => 'form-horizontal row-border')))?>
            <div class="form-group">
                <label class="col-sm-3 control-label">网站标题：</label>
                <div class="col-sm-6">
                    <?php echo Html::textInput('WebadminForm[title]', $webInfoForm->title, array('class' => 'form-control', 'placeholder' => '网站标题'))?>
                </div>
                <div class="col-sm-3">
                    <p class="help-block"><?php echo Html::error($webInfoForm, 'title')?></p>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label">网站关键字：</label>
                <div class="col-sm-6">
                    <?php echo Html::textInput('WebadminForm[keywords]', $webInfoForm->keywords, array('class' => 'form-control', 'placeholder' => '网站关键字'))?>
                </div>
                <div class="col-sm-3">
                    <p class="help-block"><?php echo Html::error($webInfoForm, 'keywords')?></p>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label">应用名称：</label>
                <div class="col-sm-6">
                    <?php echo Html::textInput('WebadminForm[application_name]', $webInfoForm->keywords, array('class' => 'form-control', 'placeholder' => '应用名称'))?>
                </div>
                <div class="col-sm-3">
                    <p class="help-block"><?php echo Html::error($webInfoForm, 'application_name')?></p>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label">备案信息：</label>
                <div class="col-sm-6">
                    <?php echo Html::textInput('WebadminForm[beian]', $webInfoForm->beian, array('class' => 'form-control', 'placeholder' => '备案信息'))?>
                </div>
                <div class="col-sm-3">
                    <p class="help-block"><?php echo Html::error($webInfoForm, 'beian')?></p>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label">QQ群（多个群用逗号隔开）：</label>
                <div class="col-sm-6">
                    <?php echo Html::textInput('WebadminForm[qun]', $webInfoForm->qun, array('class' => 'form-control', 'placeholder' => 'QQ群'))?>
                </div>
                <div class="col-sm-3">
                    <p class="help-block"><?php echo Html::error($webInfoForm, 'qun')?></p>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label">电话号码（多个号码用逗号隔开）：</label>
                <div class="col-sm-6">
                    <?php echo Html::textInput('WebadminForm[phone]', $webInfoForm->phone, array('class' => 'form-control', 'placeholder' => '电话号码'))?>
                </div>
                <div class="col-sm-3">
                    <p class="help-block"><?php echo Html::error($webInfoForm, 'phone')?></p>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label">站长邮箱：</label>
                <div class="col-sm-6">
                    <?php echo Html::textInput('WebadminForm[email]', $webInfoForm->email, array('class' => 'form-control', 'placeholder' => '站长邮箱'))?>
                </div>
                <div class="col-sm-3">
                    <p class="help-block"><?php echo Html::error($webInfoForm, 'email')?></p>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label">网站描述：</label>
                <div class="col-sm-6">
                    <?php echo Html::textarea('WebadminForm[description]', $webInfoForm->description, array('class' => 'form-control', 'placeholder' => '网站描述', 'style' => 'height:150px;'))?>
                </div>
                <div class="col-sm-3">
                    <p class="help-block"><?php echo Html::error($webInfoForm, 'description')?></p>
                </div>
            </div>
            
            
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3">
                    <?php echo Html::submitButton('编辑', array('class' => 'btn btn-success'))?>
                </div>
            </div>
        <?php ActiveForm::end()?>
    </div>
</div>