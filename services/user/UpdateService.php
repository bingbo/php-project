<?php

namespace app\services\user;

use app\library\base\Service;
use app\models\User;
use yii\base\UserException;

class UpdateService extends Service{

    public function process(){

        $user = User::findOne($this->params['id']);
        $user->name = $this->params['name'];
        $user->password = $this->params['password'];
        $user->email = $this->params['email'];
        $data = $user->save();
        $this->result['data'] = $data;
    }

    protected function checkParams(){
    }
}
