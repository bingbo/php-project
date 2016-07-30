<?php

namespace app\services\user;

use app\library\base\Service;
use app\models\User;
use yii\base\UserException;

class QueryService extends Service{

    public function process(){

        $data = User::getUserListByConditions($this->params);
        $data = array_map(function($item){return $item->attributes;}, $data);
        $this->result['data'] = $data;
    }

    protected function checkParams(){
    }
}
