<?php
use app\daos\WebInfo;
use app\daos\User;
use app\widgets\NavWidget;
$webInfo = WebInfo::instance()->load();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo empty($this->title) ? $webInfo['title'] : $this->title?></title>
        <meta name="keywords" content="<?php echo empty($keywords) ? $webInfo['keywords'] : $keywords?>"/>
        <meta name="description" content="<?php echo empty($description) ? $webInfo['description'] : $description?>"/>
        <meta name="MSSmartTagsPreventParsing" content="True" />
        <meta http-equiv="MSThemeCompatible" content="Yes" />
        <meta name="application-name" content="<?php echo $webInfo['application_name']?>" />
        <meta name="msapplication-tooltip" content="<?php echo $webInfo['application_name']?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->urlManager->baseUrl?>/assets/web/css/style.css" />
        <script type="text/javascript" src="<?php echo Yii::$app->urlManager->baseUrl?>/assets/web/js/jquery.js"></script>
    </head>
    <body>
        <div id="toolbar">
            <div class="wp">
                <div class="toptip">欢迎访问<?php echo $webInfo['application_name']?>社区，站长邮箱“<font color="red"><?php echo $webInfo['email']?></font>”</div>
                <div class="topop">
                    <a href="">收藏本站</a>&nbsp;
                    <a href="">设为首页</a>
                </div>
            </div>
        </div>
        <div id="hd">
            <div class="wp">
                <div class="hdc">
                    <h2>
                        <a href="<?php echo Yii::$app->urlManager->createUrl(array('/'))?>">
                            <img alt="男孩女孩" src="<?php echo Yii::$app->urlManager->baseUrl?>/assets/web/imgs/logo.png">
                        </a>
                    </h2>
                    <div class="topSearch">
                        <input type="text" name="search_key" class="top_search_key"/>
                        <button type="submit" class="s_btn">搜索</button>
                    </div>
                    <div class="top_login_info">
                        <a href="">
                            <img alt="男孩女孩|登录" src="<?php echo Yii::$app->urlManager->baseUrl?>/assets/web/imgs/default_small.png" width="50" height="50">
                        </a>
                        <div class="top_login">
                            <div>
                                <?php if (!User::instance()->isLogin()):?>
                                    <p style="margin: 3px 0;"><a href="<?php echo Yii::$app->urlManager->createUrl('/user/login')?>">登录</a></p>
                                    <p><a href="<?php echo Yii::$app->urlManager->createUrl(array('/user/register'))?>">立即注册</a></p>
                                <?php else :?>
                                    <p style="margin: 3px 0;">欢迎您！</p>
                                    <p><?php echo User::instance()->getLoginInfo('username')?>&nbsp;&nbsp;<a href="<?php echo Yii::$app->urlManager->createUrl(array('/user/logout'))?>">退出</a></p>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo NavWidget::widget()?>
            </div>
        </div>
        <?php echo $content?>
        <div class="foot">男孩女孩社区&nbsp;&nbsp;京ICP备12019625号&nbsp;&nbsp;&nbsp;京公备11010502022064</div>
    </body>
</html>