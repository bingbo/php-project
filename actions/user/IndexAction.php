<?php

namespace app\actions\user;

use Yii;
use app\library\base\CAction;
use app\library\core\Factory;
use app\services\user\IndexService;
use yii\base\UserException;

class IndexAction extends CAction{

    public function execute(){
        $service = Factory::create(IndexService::class);
        $data = $service->execute($this->params->get());
        
        return $this->display('index', $data);
    }
}
