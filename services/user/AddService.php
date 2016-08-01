<?php

namespace app\services\user;

use app\library\base\Service;
use app\models\User;
use yii\base\UserException;

class AddService extends Service{

    public function process(){

        $user = new User();
        $user->name = $this->params['name'];
        $user->password = $this->params['password'];
        $user->email = $this->params['email'];
        $data = $user->save();
        $this->result['data'] = $data;
    }

    protected function checkParams(){
    }
}
