<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<link href="<?php echo WEB_THIRD_PLUGIN_URL?>/uploadify/uploadify.css" rel="stylesheet"/>
<script type="text/javascript" src="<?php echo WEB_THIRD_PLUGIN_URL?>/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="<?php echo WEB_THIRD_PLUGIN_URL?>/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
$(function(){
    $("#title_img_file_input").uploadify({
        'swf' : '<?php echo WEB_THIRD_PLUGIN_URL?>/uploadify/uploadify.swf',
        'uploader' : '<?php echo Yii::$app->urlManager->createUrl(array('/webman/common/upimg'))?>',
        'buttonText' : '上传标题图片',
        'fileTypeExts': '*.gif; *.jpg; *.png',
        'auto': true,
        'cancelImg' : '<?php echo WEB_THIRD_PLUGIN_URL?>/uploadify/uploadify-cancel.png',
        'formData' : {
            'type' : 'article_title_img'
        },
        'onUploadSuccess' : function(file, data, response) {
            var responseJson = eval('(' + data + ')');
            if(!responseJson.succ) {
                alert(responseJson.msg);
            } else {
                var imgHtml = "<img src='" + responseJson.url + "' style='max-width:100%;'/>";
                $("#title_img_div").html(imgHtml);
                $("#title_img_hidden_input").val(responseJson.url);
            }
        }
    });
    CKEDITOR.replace("ArticleForm[content]", {height:400});
});
</script>
<div class="row">
    <div class="col-mod-12">
        <ul class="breadcrumb">
            <li><a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman'))?>">NanhNvh</a></li>
            <li><a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman'))?>">内容管理系统</a></li>
            <li class="active">文章管理</li>
        </ul>
        <h3 class="page-header">
            <span><i class="fa fa-book"></i>添加文章</span>
        </h3>
    </div>
    <div class="row">
        <?php $form = ActiveForm::begin(array('id' => 'add-form', 'options' => array('class' => 'form-horizontal row-border')))?>
            <?php echo Html::hiddenInput('ArticleForm[id]', $articleForm->id)?>
            <div class="form-group">
                <label class="col-sm-3 control-label">文章标题：</label>
                <div class="col-sm-6">
                    <?php echo Html::textInput('ArticleForm[title]', $articleForm->title, array('class' => 'form-control', 'placeholder' => '文章标题'))?>
                </div>
                <div class="col-sm-3">
                    <p class="help-block"><?php echo Html::error($articleForm, 'title')?></p>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label">文章描述：</label>
                <div class="col-sm-6">
                    <?php echo Html::textarea('ArticleForm[description]', $articleForm->description, array('class' => 'form-control', 'placeholder' => '文章描述', 'style' => 'height:200px;'))?>
                </div>
                <div class="col-sm-3">
                    <p class="help-block"><?php echo Html::error($articleForm, 'description')?></p>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label">标题图片：</label>
                <div class="col-sm-6">
                    <input type="file" name="title_img" id="title_img_file_input"/>
                    <?php echo Html::hiddenInput('ArticleForm[title_img]', $articleForm->title_img, array('id' => 'title_img_hidden_input'))?>
                </div>
                <div class="col-sm-3">
                    <p class="help-block"><?php echo Html::error($articleForm, 'title_img')?></p>
                </div>
            </div>
            
            
            <div class="form-group">
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-6" id="title_img_div">
                	<?php if (!empty($articleForm->title_img)):?>
                		<img src="<?php echo $articleForm->title_img?>" style="max-width: 100%;">
                	<?php endif;?>
                </div>
                <div class="col-sm-3">
                </div>
            </div>
            
            
            <div class="form-group">
                <label class="col-sm-3 control-label">是否是每日热门：</label>
                <div class="col-sm-6">
                    <?php echo Html::radioList('ArticleForm[day_hot]', $articleForm->day_hot, array('不是', '是'), array('class' => 'form-control', 'style' => 'border:none;'))?>
                </div>
                <div class="col-sm-3">
                    <p class="help-block"><?php echo Html::error($articleForm, 'title_img')?></p>
                </div>
            </div>
            
            
            <div class="form-group">
                <label class="col-sm-3 control-label">是否是热门推荐：</label>
                <div class="col-sm-6">
                    <?php echo Html::radioList('ArticleForm[hot_tuijian]', $articleForm->hot_tuijian, array('不是', '是'), array('class' => 'form-control', 'style' => 'border:none;'))?>
                </div>
                <div class="col-sm-3">
                    <p class="help-block"><?php echo Html::error($articleForm, 'hot_tuijian')?></p>
                </div>
            </div>
            
            
            <div class="form-group">
                <label class="col-sm-3 control-label">是否是主题推荐：</label>
                <div class="col-sm-6">
                    <?php echo Html::radioList('ArticleForm[topic_tuijian]', $articleForm->topic_tuijian, array('不是', '是'), array('class' => 'form-control', 'style' => 'border:none;'))?>
                </div>
                <div class="col-sm-3">
                    <p class="help-block"><?php echo Html::error($articleForm, 'topic_tuijian')?></p>
                </div>
            </div>
            
            
            <div class="form-group">
                <label class="col-sm-3 control-label">所在栏目：</label>
                <div class="col-sm-6">
                	<?php echo Html::dropDownList('ArticleForm[category_id]', $articleForm->category_id, $categories, array('class' => 'form-control', 'style' => 'width:150px;'))?>
                </div>
                <div class="col-sm-3">
                    <p class="help-block"><?php echo Html::error($articleForm, 'category_id')?></p>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label">对应热点：</label>
                <div class="col-sm-6">
                	<?php echo Html::checkboxList('ArticleForm[hots][]', $articleForm->hots, $hots)?>
                </div>
                <div class="col-sm-3">
                    <p class="help-block"></p>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label">文章内容：</label>
                <div class="col-sm-9">
                	<?php echo Html::textarea('ArticleForm[content]', $articleForm->content, array('class' => 'form-control', 'placeholder' => '文章内容'))?>
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