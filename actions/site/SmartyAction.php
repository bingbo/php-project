<?php

namespace app\actions\site;

use Yii;
use app\library\base\CAction;
use app\library\core\Factory;
use app\services\site\SmartyService;
use yii\base\UserException;

class SmartyAction extends CAction{

    public function execute(){
        

        $service = Factory::create(SmartyService::class);
        $data = $service->execute($this->params->get());
        return $this->display('index.tpl');
        //var_dump($this->params);
        //echo "say hello";
    }
}
