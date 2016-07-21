<?php

namespace app\library\base;

use Yii;
use yii\base\Action;
use yii\base\UserException;


abstract class CAction extends Action{

    //请求参数
    protected $params = null;
    //需要登录访问
    protected $need_login = 0;
    //需要管理员访问
    protected $need_admin = 0;
    //模板数据变量
    private $_pageData = array();

    public function run(){
        try{
            $this->_initParams();
            $this->need_login && $this->_checkLogin();
            $this->need_admin && $this->_checkAdmin();
            return $this->execute();
        }catch(UserException $e){
            $exception = array(
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            );
            $this->controller->redirect(['index/error', 'msg' => $e->getMessage(), 'code' => $e->getCode()]);
        }
    }

    /**
     * @desc 检查是否登录，没有则先进行登录
     * @param void
     * @return void
     */
    private function _checkLogin(){
        //if(Yii::$app->user->isGuest){
        //    Yii::$app->user->login();
        //} 
    }

    /**
     * @desc 检查是否是管理员身份，非管理员则跳错误页
     * @param void
     * @return void
     */
    private function _checkAdmin(){
        if(!Yii::$app->user->identity->isAdmin){
            throw new UserException('you are not admin', 2000);
        }
        
    }

    /**
     * @desc 初始化请求参数
     * @param null
     * @return null
     */
    private function _initParams(){
        $this->params = Yii::$app->request;
    }

    /**
     * @desc 返回json数据
     * @params $data
     * @return null
     */
    protected function displayJson($data){
        header('Content-type: text/javascript');
        if($this->params->get('callback')){
            echo $this->params->get('callback') . '(' . json_encode($data) . ')';
        }else{
            echo json_encode($data);
        }
    }

    /**
     * @desc 渲染模板
     * @params $tpl, $data
     * @return $render
     */
    protected function display($tpl, $data = array()){
        $data = array_merge(array('content' => $data), $this->_pageData);
        return $this->controller->render($tpl, $data);
    }

    /**
     * @desc 给页面传数据
     * @params $data
     * @return void
     */
    protected function assign($key, $value){
        $this->_pageData[$key] = $value;
    }

    /**
     * @desc 执行方法，供子类具体实现
     * @params null
     * @return void
     */
    abstract protected function execute();
}
