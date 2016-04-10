<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<div class="web-main">
    <div class="ct">
        <div class="topnh">
            <h3>用户登录</h3>
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
                <span class="label">七天免登陆：</span>
                <span><?php echo Html::checkbox('UserForm[member]', $userForm->member)?></span>
            </div>
            <div class="fm" style="border-bottom: none;">
                <span class="label" style="margin-left: 80px;">
                    <?php echo Html::submitButton('登录', array('class' => 'regsub'))?>
                </span>
            </div>
        </div>
        <?php ActiveForm::end()?>
     </div>
</div>