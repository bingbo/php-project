<?php

namespace app\services\user;

use app\library\base\Service;
use app\models\User;
use yii\base\UserException;

class ListService extends Service{

    public function process(){
        $data = User::getUserListByConditions();
        $data = array_map(function($item){return $item->attributes;}, $data);
        $this->result['data'] = $data;
    }
}
