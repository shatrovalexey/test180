<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Url;

/**
* Прочие запросы
*/
class SiteController extends Controller
{
    public function beforeAction($action)
    {
        $this->layout = false;

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        return $this->render('index2');
    }
}
