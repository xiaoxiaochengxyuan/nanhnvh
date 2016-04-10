<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<script type="text/javascript">
function changeVerify(obj) {
    var date = new Date();
    $(obj).attr("src", "<?php echo Yii::$app->urlManager->createUrl(array('/site/verify', 'length' => 5, 'imageWidth' => 230, 'imageHeight' => 30))?>&time=" + date.getTime());
}
</script>
<div class="web-main">
    <div class="ct">
        <div class="topnh">
            <h3>立即注册</h3>
            <span class="tologin">
                <a href="<?php echo Yii::$app->urlManager->createUrl(array('/user/login'))?>">已有账号,现在登录</a>
            </span>
        </div>
        <?php $form = ActiveForm::begin()?>
        <div class="regform">
            <div class="fm">
                <span class="label">用户名：</span>
                <span><?php echo Html::input('text', 'UserForm[username]', $userForm->username, array('class'=>'text'))?></span>
                <span class="error">
                    <?php echo Html::error($userForm, 'username')?>
                </span>
            </div>
            <div class="fm">
                <span class="label">密码：</span>
                <span><?php echo Html::input('password', 'UserForm[password]', $userForm->password, array('class'=>'text'))?></span>
                <span class="error">
                    <?php echo Html::error($userForm, 'password')?>
                </span>
            </div>
            <div class="fm">
                <span class="label">确认密码：</span>
                <span><?php echo Html::input('password', 'UserForm[repassword]', $userForm->repassword, array('class'=>'text'))?></span>
                <span class="error">
                    <?php echo Html::error($userForm, 'repassword')?>
                </span>
            </div>
            <div class="fm">
                <span class="label">邮箱：</span>
                <span><?php echo Html::input('text', 'UserForm[email]', $userForm->email, array('class'=>'text'))?></span>
                <span class="error">
                    <?php echo Html::error($userForm, 'email')?>
                </span>
            </div>
            <div class="fm">
                <span class="label">性别：</span>
                <span><?php echo Html::radioList('UserForm[sex]', $userForm->sex, array('男孩', '女孩'))?></span>
                <span class="error">
                    <?php echo Html::error($userForm, 'sex')?>
                </span>
            </div>
            <div class="fm" style="margin-bottom: 7px;">
                <span class="label">验证码：</span>
                <span><?php echo Html::input('text', 'UserForm[verify]', $userForm->verify, array('class'=>'text'))?></span>
                <span class="error">'
                    <?php echo Html::error($userForm, 'verify')?>
                </span>
            </div>
            <div class="fm" style="margin-bottom: 7px;padding-bottom: 10px;">
                <span class="label">&nbsp;</span>
                <span><img onclick="changeVerify(this);" class="verify" alt="验证码" src="<?php echo Yii::$app->urlManager->createUrl(array('/site/verify', 'length' => 5, 'imageWidth' => 230, 'imageHeight' => 30))?>"></span>
            </div>
            <div class="fm" style="border-bottom: none;">
                <span class="label" style="margin-left: 80px;">
                    <?php echo Html::submitButton('注册', array('class' => 'regsub'))?>
                </span>
            </div>
        </div>
        <?php ActiveForm::end()?>
    </div>
</div>