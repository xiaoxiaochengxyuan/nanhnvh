<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-mod-12">
        <ul class="breadcrumb">
            <li><a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman'))?>">NanhNvh</a></li>
            <li><a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman'))?>">内容管理系统</a></li>
            <li class="active"><?php echo $pid == 0 ? '添加顶级分类' : '添加分类'?></li>
        </ul>
        <h3 class="page-header"><i class="fa fa-reorder"></i><?php echo $pid == 0 ? '添加顶级分类' : '添加分类'?></h3>
    </div>
    <div class="row">
        <?php $form = ActiveForm::begin(array('id' => 'add-form', 'options' => array('class' => 'form-horizontal row-border')))?>
            <?php echo Html::hiddenInput('CategoryForm[pid]', $categoryForm->pid)?>
            <div class="form-group">
                <label class="col-sm-3 control-label">分类名称：</label>
                <div class="col-sm-6">
                    <?php echo Html::textInput('CategoryForm[name]', $categoryForm->name, array('class' => 'form-control', 'placeholder' => '分类名称'))?>
                </div>
                <div class="col-sm-3">
                    <p class="help-block"><?php echo Html::error($categoryForm, 'name')?></p>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label">分类拼音：</label>
                <div class="col-sm-6">
                    <?php echo Html::textInput('CategoryForm[pinyin]', $categoryForm->pinyin, array('class' => 'form-control', 'placeholder' => '分类拼音'))?>
                </div>
                <div class="col-sm-3">
                    <p class="help-block"><?php echo Html::error($categoryForm, 'pinyin')?></p>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3">
                    <?php echo Html::submitButton('添加', array('class' => 'btn btn-success'))?>
                </div>
            </div>
        <?php ActiveForm::end()?>
    </div>
</div>