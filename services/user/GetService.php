<?php

namespace app\services\user;

use app\library\base\Service;
use app\models\User;
use yii\base\UserException;

class GetService extends Service{

    public function process(){

        $data = User::getUserById($this->params['id']);
        $this->result['data'] = $data;
    }

    protected function checkParams(){
    }
}
