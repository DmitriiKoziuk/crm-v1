<?php
namespace backend\assets;

use yii\web\AssetBundle;

class JobIndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl  = '@web';

    public $js       = [
        'js/job-index.js',
    ];
    public $depends  = [
        'backend\assets\AppAsset',
    ];
}