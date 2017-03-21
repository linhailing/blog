<?php

namespace backend\assets;

use yii\web\AssetBundle;
use backend\services\UrlService;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    // public $css = [
    //     'css/site.css',
    // ];
    // public $js = [
    // ];
    // public $depends = [
    //     'yii\web\YiiAsset',
    //     'yii\bootstrap\BootstrapAsset',
    // ];
    public function registerAssetFiles($view)
    {
        $version = "20170322";
        $this->css = [
            UrlService::buildUrl('static/js/iCheck/skins/minimal/minimal.css', [ 'v' => $version]),
            UrlService::buildUrl('static/js/iCheck/skins/square/square.css', [ 'v' => $version]),
            UrlService::buildUrl('static/js/iCheck/skins/square/red.css', [ 'v' => $version]),
            UrlService::buildUrl('static/js/iCheck/skins/square/blue.css', [ 'v' => $version]),
            UrlService::buildUrl('static/css/style.css', [ 'v' => $version]),
            UrlService::buildUrl('static/css/style-responsive.css', [ 'v' => $version]),
        ];
        $this->js = [
            UrlService::buildUrl('static/js/jquery-1.10.2.min.js', [ 'v' => $version]),
            UrlService::buildUrl('static/js/jquery-ui-1.9.2.custom.min.js', [ 'v' => $version]),
            UrlService::buildUrl('static/js/jquery-migrate-1.2.1.min.js', [ 'v' => $version]),
            UrlService::buildUrl('static/js/bootstrap.min.js', [ 'v' => $version]),
            UrlService::buildUrl('static/js/modernizr.min.js', [ 'v' => $version]),
            UrlService::buildUrl('static/js/jquery.nicescroll.js', [ 'v' => $version]),
            // UrlService::buildUrl('static/js/iCheck/jquery.icheck.js', [ 'v' => $version]),
            // UrlService::buildUrl('static/js/icheck-init.js', [ 'v' => $version]),
            UrlService::buildUrl("static/js/scripts.js", [ 'v' => $version])
        ];
        return parent::registerAssetFiles($view);
    }
}
