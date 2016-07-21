<?php

namespace app\services\site;

use app\library\base\Service;
use app\models\User;
use yii\base\UserException;

class SmartyService extends Service{

    public function process(){
        //return $this->controller->render('index');
        //return $this->display('index.tpl');
        //throw new UserException('get data fail', 1000);
        $this->result['data'] = 'success';
    }
}
