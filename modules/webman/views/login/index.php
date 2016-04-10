<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $this->title?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Loading Bootstrap -->
        <link href="<?php echo WEB_STATIC_URL?>/login/css/bootstrap.css" rel="stylesheet">
        
        <!-- Loading Stylesheets -->
        <link href="<?php echo WEB_STATIC_URL?>/login/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo WEB_STATIC_URL?>/login/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo WEB_STATIC_URL?>/login/css/login.css" rel="stylesheet">
        <script type="text/javascript" src="<?php echo WEB_STATIC_URL?>/js/jquery-1.10.2.min.js"></script>
        <style type="text/css">
        .login-box{
            margin: 100px auto;
        	padding-bottom: 50px;
        }
        .verifyImg:HOVER{
        	cursor: pointer;
        }
        </style>
        <script type="text/javascript">
        function changeVerify(obj) {
            var date = new Date();
            $(obj).attr('src', "<?php echo Yii::$app->urlManager->createUrl(array('/webman/common/verify', 'length' => 5, 'imageWidth' => 224, 'imageHeight' => 30))?>&time" +date.getTime());
        }
        </script>
    </head>
    
    <body>
        <div class="login-box">
            <h1><i class='fa fa-bookmark'></i>&nbsp;欢迎光临Webman</h1>
            <hr>
            <h5>LOGIN</h5>
            <div class="input-box">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1">
                        <?php $form = ActiveForm::begin(array('id' => 'login-form','options' => array('role' => 'form')))?>
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class='fa fa-user'></i></span>
                                <?php echo Html::textInput('WebadminForm[username]', $webmanAdminForm->username, array('placeholder' => '用户名', 'class' => 'form-control'))?>
                            </div>
                            <?php if ($webmanAdminForm->hasErrors('username')):?>
                                <div class="input-group form-group">
                                    <span style="color: red;"><?php echo Html::error($webmanAdminForm, 'username')?></span>
                                </div>
                            <?php endif;?>
                            
                            
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class='fa fa-key'></i></span>
                                <?php echo Html::passwordInput('WebadminForm[password]', $webmanAdminForm->password, array('placeholder' => '密码', 'class' => 'form-control'))?>
                            </div>
                            <?php if ($webmanAdminForm->hasErrors('password')):?>
                                <div class="input-group form-group">
                                    <span style="color: red;"><?php echo Html::error($webmanAdminForm, 'password')?></span>
                                </div>
                            <?php endif;?>
                            
                            
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class='fa fa-key'></i></span>
                                <?php echo Html::textInput('WebadminForm[verify]', $webmanAdminForm->verify, array('placeholder' => '验证码', 'class' => 'form-control'))?>
                            </div>
                            <?php if ($webmanAdminForm->hasErrors('verify')):?>
                                <div class="input-group form-group">
                                    <span style="color: red;"><?php echo Html::error($webmanAdminForm, 'verify')?></span>
                                </div>
                            <?php endif;?>
                            
                            <div class="input-group form-group">
                                <img class="verifyImg" onclick="changeVerify(this);" alt="验证码" src="<?php echo Yii::$app->urlManager->createUrl(array('/webman/common/verify', 'length' => 5, 'imageWidth' => 224, 'imageHeight' => 30))?>">
                            </div>
                            
                            <div class="form-group">
                                <?php echo Html::submitButton('登录', array('class' => 'btn btn-block btn-submit pull-right'))?>
                            </div>
                        <?php ActiveForm::end()?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>