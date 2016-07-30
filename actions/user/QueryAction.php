<?php

namespace app\actions\user;

use Yii;
use app\library\base\CAction;
use app\library\core\Factory;
use app\services\user\QueryService;
use yii\base\UserException;

class QueryAction extends CAction{

    public function execute(){
        $service = Factory::create(QueryService::class);
        $data = $service->execute($this->params->post());
        $this->displayJson($data);
    }
}
