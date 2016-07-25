<?php

namespace app\services\user;

use app\library\base\Service;
use app\models\Student;
use yii\base\UserException;

class IndexService extends Service{

    public function process(){
        $data = Student::getStudentList();
        $this->result['data'] = $data;
    }
}
