<?php
namespace backend\assets;

use yii\web\AssetBundle;

class CreateJobAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl  = '@web';
    public $css      = [
        'css/font-awesome.min.css'
    ];
    public $js       = [
        'js/bootstrap-formhelpers.js',
        'js/bootstrap-formhelpers-phone.js',
    ];
    public $depends  = [
        'backend\assets\AppAsset',
    ];
}