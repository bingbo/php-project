<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Student extends ActiveRecord{
    
    public static function tableName(){
        return 'student';
    }

    /*
    public function getModule(){
        return $this->hasOne(Module::className(),['id' => 'module_id']);
    }
    */

    /**
     * @desc 根据ID获取指定学生
     * @param $id
     * @return $result
     */
    public static function getStudentById($id){
        $student = self::findOne($id);
        return $student ? $student->attributes : null;
    }

    /**
     * @desc 根据ID删除指定学生
     * @param $id
     * @return $result
     */
    public static function deleteStudentById($id){
        $student = self::findOne($id);
        $student->is_deleted = 1;
        return $student->update();
    }

    /**
     * @desc 根据条件获取列表数据
     * @param $conds
     * @return $result
     */
    public static function getStudentListByConditions($conds){
        $students = self::find()->where($conds)->orderBy('update_time desc')->all();
        $students = array_map(
            function($student){
                $temp = $student->attributes;
                $temp['module_name'] = $student->module->module_name;
                return $temp;
            },
            $students
        );
        return $students;
    }

    public static function getMyStudentList(){
        $uid = Yii::$app->user->identity->name;
        $students = self::find()->where(['uid' => $uid, 'is_public' => 0, 'is_deleted' => 0])->orWhere(['is_public' => 1, 'is_deleted' => 0])->orderBy('update_time desc')->all();
        $students = array_map(
            function($student){
                $temp = $student->attributes;
                $temp['module_name'] = $student->module->module_name;
                return $temp;
            },
            $students
        );
        return $students;
    }
    public static function getStudentList(){
        $students = self::find()->all();
        return $students;
    }
}
