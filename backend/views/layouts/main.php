<?php

/* @var $this \yii\web\View */
/* @var $content string */

use Yii;
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use backend\services\UrlService;
use common\models\Menu;

AppAsset::register($this);

$allMenu = Menu::getMenu();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="sticky-header">
<?php $this->beginBody() ?>
<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">
        <!--logo and iconic logo start-->
        <div class="logo">
            <a href="index.html"><img src="<?=UrlService::buildUrl('static/images/logo.png');?>" alt=""></a>
        </div>

        <div class="logo-icon text-center">
            <a href="index.html"><img src="<?=UrlService::buildUrl('static/images/logo_icon.png');?>" alt=""></a>
        </div>
        <!--logo and iconic logo end-->

        <div class="left-side-inner">
            <!-- visible to small devices only -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media logged-user">
                    <img alt="" src="<?=UrlService::buildUrl('static/images/photos/user-avatar.png');?>" class="media-object">
                    <div class="media-body">
                        <h4><a href="#">John Doe</a></h4>
                        <span>"Hello There..."</span>
                    </div>
                </div>

                <h5 class="left-nav-title">Account Information</h5>
                <ul class="nav nav-pills nav-stacked custom-nav">
                  <li><a href="#"><i class="fa fa-user"></i> <span>Profile</span></a></li>
                  <li><a href="#"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
                  <li><a href="#"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
                </ul>
            </div>

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                <?php foreach ($allMenu as $menus):?>
                    <li class="menu-list">
                        <a href="<?=UrlService::buildUrl($menus['url']);?>">
                            <i class="fa <?=$menus['icon_style'];?>"></i>
                            <span><?=$menus['name'];?></span>
                        </a>
                        <ul class="sub-menu-list">
                            <?php if(!isset($menus['_child'])) break?>
                            <?php foreach ($menus['_child'] as $menu): ?>
                            <?php $menuArr = explode('/', $menu['url']);?>
                                <li class="<?=Yii::$app->controller->id == $menuArr[0] ? 'active' : '';?>">
                                    <a href="<?=UrlService::buildUrl($menu['url']);?>"> <?=$menu['name'];?></a>
                                </li>
                            <?php endforeach;?>
                        </ul>
                    </li>
                <?php endforeach;?>
            </ul>
            <!--sidebar nav end-->
        </div>
    </div>
    <!-- left side end-->
    <!-- main content start-->
    <div class="main-content" >
        <!-- header section start-->
        <div class="header-section">
            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
            <!--toggle button end-->

            <!--search start-->
            <form class="searchform" action="index.html" method="post">
                <input type="text" class="form-control" name="keyword" placeholder="Search here..." />
            </form>
            <!--search end-->
            <!--notification menu start -->
            <div class="menu-right">
                <ul class="notification-menu">
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                            <i class="fa fa-tasks"></i>
                            <span class="badge">8</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge">5</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="badge">4</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <img src="<?=UrlService::buildUrl('static/images/photos/user-avatar.png')?>" alt="" />
                            John Doe
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a href="#"><i class="fa fa-user"></i>  Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i>  Settings</a></li>
                            <li><a href="#"><i class="fa fa-sign-out"></i> Log Out</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!--notification menu end -->
        </div>
        <!-- header section end-->

        <!-- page heading start-->
        <div class="page-heading">
            <ul class="breadcrumb">
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li class="active"> My Dashboard </li>
            </ul>
        </div>
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
            <?= $content?>
        </div>
        <!--body wrapper end-->

         <!--footer section start-->
        <footer>
            2017 &copy; AdminEx by <a href="#" target="_blank">henry</a>
        </footer>
        <!--footer section end-->
    </div>
    <!-- main content end-->
</section>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
