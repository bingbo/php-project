<?php

namespace app\actions\user;

use Yii;
use app\library\base\CAction;
use app\library\core\Factory;
use app\services\user\ListService;
use yii\base\UserException;

class ListAction extends CAction{

    public function execute(){
        $service = Factory::create(ListService::class);
        $data = $service->execute($this->params->get());
        $this->displayJson($data);
    }
}
