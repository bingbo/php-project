<?php

namespace app\actions\user;

use Yii;
use app\library\base\CAction;
use app\library\core\Factory;
use app\services\user\GetService;
use yii\base\UserException;

class GetAction extends CAction{

    public function execute(){
        $service = Factory::create(GetService::class);
        $data = $service->execute($this->params->get());
        $this->displayJson($data);
    }
}
