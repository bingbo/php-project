<?php

namespace app\actions\user;

use Yii;
use app\library\base\CAction;
use app\library\core\Factory;
use app\services\user\AddService;
use yii\base\UserException;

class AddAction extends CAction{

    public function execute(){
        $service = Factory::create(AddService::class);
        $data = $service->execute($this->params->post());
        $this->displayJson($data);
    }
}
