<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class HbaseController extends Controller
{

    public function actionIndex()
    {
        $tables = Yii::$app->hbase->showTables();
        $data['tables'] = $tables;
        $member_row = Yii::$app->hbase->getRow('test:member','bingbing.zhang');
        $data['table_member'] = $member_row;
        return $this->render('index',['data' => $data]);
    }

    
}
