<?php

namespace app\actions\user;

use Yii;
use app\library\base\CAction;
use app\library\core\Factory;
use app\services\user\UpdateService;
use yii\base\UserException;

class UpdateAction extends CAction{

    public function execute(){
        $service = Factory::create(UpdateService::class);
        $data = $service->execute($this->params->post());
        $this->displayJson($data);
    }
}
