<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\{Url, UrlLog,};
use yii\filters\ContentNegotiator;
use yii\web\NotFoundHttpException;
use app\helpers\{Qr as HelperQr, Url as HelperUrl};

/**
* API
*/
class ApiController extends Controller
{
    public function behaviors()
    {
        return parent::behaviors() + ['contentNegotiator' => [
            'class' => ContentNegotiator::class
            , 'formats' => ['application/json' => Response::FORMAT_JSON,]
            ,
        ],];
    }

    /**
    * Создать URL
    *
    * @return array
    * - string url - URL для перехода через редирект
    * - string qr - URL QR-кода
    */
    public function actionUrlAdd()
    {
        $model = new Url();

        try {
            $model->href = Yii::$app->request->get('href');

            if (!$model->validate())
                return ['error' => $model->errors,];

            $model->save(false);
        } catch (\Throwable $exception) {
            return ['error' => $exception->getMessage(),];
        }

        $url = new HelperUrl(\Yii::$app->request->hostInfo);

        return [
            'url' => $url->getAliasUrl($model->alias)
            , 'qr' => $url->getQrUrl($model->alias)
            ,
        ];
    }

    /**
    * Изображение QR
    *
    * @param string $alias
    */
    public function actionQr(string $alias)
    {
        $result = HelperQr::get((new HelperUrl(\Yii::$app->request->hostInfo))->getAliasUrl($alias));

        \Yii::$app->response->format = Response::FORMAT_RAW;
        \Yii::$app->response->headers->add('Content-Type', $result->getMimeType());

        return $result->getString();
    }

    /**
    * Редирект по alias к URL
    *
    * @param string $alias
    */
    public function actionUrl(string $alias)
    {
        $url = Url::find()->select(['id', 'href',])->where(['alias' => $alias,])->one();

        if (is_null($url))
            return new NotFoundHttpException('ссылка не существует');

        $urlLog = new UrlLog();
        $urlLog->url_id = $url->id;
        $urlLog->ip = $this->request->getUserIP();
        $urlLog->save();

        return $this->redirect($url->href);
    }
}
