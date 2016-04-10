<?php 
$moduleId = $this->context->module->id;
$controllerId = $this->context->module->module->controller->id;
$actionId = $this->context->module->module->controller->action->id;
?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title><?php echo $this->title?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Loading Bootstrap -->
        <link href="<?php echo WEB_STATIC_URL?>/css/bootstrap.css" rel="stylesheet">
        <!-- Loading Stylesheets -->    
        <link href="<?php echo WEB_STATIC_URL?>/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo WEB_STATIC_URL?>/css/style.css" rel="stylesheet" type="text/css"> 
        <link href="<?php echo WEB_STATIC_URL?>/less/style.less" rel="stylesheet"  title="lessCss" id="lessCss">
        <!-- Loading Custom Stylesheets -->    
        <link href="<?php echo WEB_STATIC_URL?>/css/custom.css" rel="stylesheet">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
        <!--[if lt IE 9]>
            <script src="<?php echo WEB_STATIC_URL?>/js/html5shiv.js"></script>
        <![endif]-->
        <script src="<?php echo WEB_STATIC_URL?>/js/jquery-1.10.2.min.js"></script>
        <style type="text/css">
        .errorMessage {
            color: red;
        }
        </style>
        
        <script type="text/javascript">
        function delObj(id) {
            if(confirm("您确定要删除这条数据吗？")) {
                $.get("<?php echo Yii::$app->urlManager->createUrl(array('/'.$moduleId.'/'.$controllerId.'/delete'))?>", {
                    "id" : id
                }, function(response){
                    window.location.reload();
                });
            }
        }

        function up(id) {
            if(confirm("您确定要上移这条数据吗？")) {
            	$.get("<?php echo Yii::$app->urlManager->createUrl(array('/'.$moduleId.'/'.$controllerId.'/up'))?>", {
                    "id" : id
                }, function(response){
                    window.location.reload();
                });
            }
        }

        function down(id) {
            if(confirm("您确定要下移这条数据吗？")) {
            	$.get("<?php echo Yii::$app->urlManager->createUrl(array('/'.$moduleId.'/'.$controllerId.'/down'))?>", {
                    "id" : id
                }, function(response){
                    window.location.reload();
                });
            }
        }

        function toTop(id) {
            if(confirm("您确定要移动这条数据到头部吗？")) {
                $.get("<?php echo Yii::$app->urlManager->createUrl(array('/'.$moduleId.'/'.$controllerId.'/top'))?>", {
                    "id" : id
                }, function(response) {
                    window.location.reload();
                });
            }
        }


        function toEnd(id) {
            if(confirm("您确定要移动这条数据到尾部吗？")) {
                $.get("<?php echo Yii::$app->urlManager->createUrl(array('/'.$moduleId.'/'.$controllerId.'/end'))?>", {
                    "id" : id
                }, function(response) {
                    window.location.reload();
                });
            }
        }
        </script>
    </head>
    <body>
        <div class="site-holder">
            <nav class="navbar" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo Yii::$app->urlManager->createUrl(array('/webman'))?>">
                    <i class="fa fa-list btn-nav-toggle-responsive text-white"></i>
                    <span class="logo">NanhNvh <i class="fa fa-bookmark"></i></span>
                </a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav user-menu navbar-right ">
                    <li>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="fa fa-cogs"></i>设置</a></li>
                            <li><a href="#" class="text-danger"><i class="fa fa-lock"></i> Logout</a></li>
                        </ul>
                        <li>
                            <li><a href="#" class="settings"><i class="fa fa-cogs settings-toggle"></i></a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </nav> <!-- /.navbar -->

                <!-- .box-holder -->
                <div class="box-holder">
                    <!-- .left-sidebar -->
                    <div class="left-sidebar">
                        <div class="sidebar-holder">
                            <ul class="nav  nav-list">
                                <!-- sidebar to mini Sidebar toggle -->
                                <li class="nav-toggle">
                                    <button class="btn  btn-nav-toggle text-primary"><i class="fa fa-angle-double-left toggle-left"></i> </button>
                                </li>
                                
                                <li <?php if ($controllerId == 'index'):?>class="active"<?php endif;?>>
                                    <a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman'))?>" data-original-title="网站基本信息">
                                    <i class="fa fa-leaf"></i>
                                    <span class="hidden-minibar">网站基本信息</span></a>
                                </li>
                                
                                <li <?php if ($controllerId == 'category'):?>class="active"<?php endif;?>>
                                    <a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman/category'))?>" data-original-title="分类管理">
                                    <i class="fa fa-reorder"></i>
                                    <span class="hidden-minibar">分类管理</span></a>
                                </li>
                                
                                <li <?php if ($controllerId == 'hot'):?>class="active"<?php endif;?>>
                                    <a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman/hot'))?>" data-original-title="热点管理">
                                    <i class="fa fa-rss-square"></i>
                                    <span class="hidden-minibar">热点管理</span></a>
                                </li>
                                
                                
                                <li <?php if ($controllerId == 'article'):?>class="active"<?php endif;?>>
                                    <a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman/article'))?>" data-original-title="热点管理">
                                    <i class="fa fa-book"></i>
                                    <span class="hidden-minibar">文章管理</span></a>
                                </li>
                                
                                <li <?php if ($controllerId == 'friend-link'):?>class="active"<?php endif;?>>
                                    <a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman/friend-link'))?>" data-original-title="友情链接">
                                    <i class="fa fa-chain"></i>
                                    <span class="hidden-minibar">友情链接</span></a>
                                </li>
                                
                                
                                <li <?php if ($controllerId == 'show-msg'):?>class="active"<?php endif;?>>
                                    <a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman/show-msg'))?>" data-original-title="显示信息">
                                    <i class="fa fa-tint"></i>
                                    <span class="hidden-minibar">显示信息</span></a>
                                </li>
                                
                            </ul>
                        </div>
                    </div> <!-- /.left-sidebar -->

                    <!-- .content -->
                    <div class="content">
                        <?php echo $content;?>
                        <div class="footer">
                            © 1988 - 2015 <a href="http://bootstrapguru.com">男孩女孩</a>
                        </div>
                    </div> <!-- /.content -->

                    <!-- .right-sidebar -->
                    <div class="right-sidebar right-sidebar-hidden">
                        <div class="right-sidebar-holder">
                            <!-- @Demo part only The part from here can be removed till end of the @demo  -->
                            <a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman/login/logout'))?>" class="btn btn-danger btn-block"> 退出 </a>
                            <a href="<?php echo Yii::$app->urlManager->createUrl(array('/webman/webman-admin/chgpasswd'))?>" class="btn btn-success btn-block"> 修改密码 </a>
                            <ul class="list-group theme-options" style="display: none;">
                                <li class="list-group-item" href="#">
                                    <div class="form-group backgroundImage hidden" >
                                        <input type="text" class="form-control" id="backgroundImageUrl" />
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Load JS here for Faster site load =============================-->
        <script src="<?php echo WEB_STATIC_URL?>/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/less-1.5.0.min.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/jquery.ui.touch-punch.min.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/bootstrap.min.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/bootstrap-select.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/bootstrap-switch.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/jquery.tagsinput.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/jquery.placeholder.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/bootstrap-typeahead.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/application.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/moment.min.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/jquery.sortable.js"></script>
        <script type="text/javascript" src="<?php echo WEB_STATIC_URL?>/js/jquery.gritter.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/jquery.nicescroll.min.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/prettify.min.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/jquery.noty.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/bic_calendar.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/jquery.accordion.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/skylo.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/theme-options.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/bootstrap-progressbar.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/bootstrap-progressbar-custom.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/bootstrap-colorpicker.min.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/bootstrap-colorpicker-custom.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/raphael-min.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/morris-0.4.3.min.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/morris-custom.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/charts/jquery.sparkline.min.js"></script>    
        <!-- NVD3 graphs  =============================-->
        <script src="<?php echo WEB_STATIC_URL?>/js/nvd3/lib/d3.v3.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/nvd3/nv.d3.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/nvd3/src/models/legend.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/nvd3/src/models/pie.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/nvd3/src/models/pieChart.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/nvd3/src/utils.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/nvd3/sample.nvd3.js"></script>
        
        <!-- Core Jquery File  =============================-->
        <script src="<?php echo WEB_STATIC_URL?>/js/core.js"></script>
        <script src="<?php echo WEB_STATIC_URL?>/js/dashboard-custom.js"></script>
    </body>
</html>