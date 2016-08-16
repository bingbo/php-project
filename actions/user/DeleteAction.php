<?php

namespace app\actions\user;

use Yii;
use app\library\base\CAction;
use app\library\core\Factory;
use app\services\user\DeleteService;
use yii\base\UserException;

class DeleteAction extends CAction{

    public function execute(){
        $service = Factory::create(DeleteService::class);
        $data = $service->execute($this->params->get());
        $this->displayJson($data);
    }
}
