<?php

namespace app\services\user;

use app\library\base\Service;
use app\models\User;
use yii\base\UserException;

class IndexService extends Service{

    public function process(){
        $data = User::getUserListByConditions();
        $this->result['data'] = $data;
    }
}
