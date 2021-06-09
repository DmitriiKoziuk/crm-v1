<?php declare(strict_types=1);


namespace backend\components;

use Yii;
use backend\components\settings\Admin;

class Settings
{
    protected $admin;

    public function __construct()
    {
        $this->admin = new Admin(Yii::$app->params['settings']['admin']);
    }

    public function admin(): Admin
    {
        return $this->admin;
    }
}