/**
 * @author 张冰冰
 * @desc 应用
 */
(function($){
/**
 * @desc 全局app
 * @name App class
 */
var App = function(){
    var _version = 1.0,
        _author = 'zhangbingbing',
        _doc = 'this is app';
    this.doc = function(){
        return _doc;
    };
    this.version = function(){
        return _version;
    };
    this.author = function(){
        return _author;
    };
};
var app = new App();

/**
 * @desc 全局app的工具类
 * @name Utils class
 */
var Utils = function(){
    var _doc = 'this is utils class, provider some common tools for app';
    this.doc = function(){
        return _doc;
    };

    function _request(url,data,method,successFun,errorFun){
        $.ajax({
                type:method,
                dataType:'json',
                data:data,
                url:url,
                success:function(res){
                    successFun && successFun(res);
                },
                error:function(e){
                    errorFun && errorFun(e);
                }
            });
    };
    this.get = function(url,data,successFun){
        _request(url,data,'get',successFun);
    };
    this.post = function(url,data,successFun){
        _request(url,data,'post',successFun);
    };
};
app.utils = new Utils();

/**
 * @desc 用户信息类
 * @name User class
 */
var User = function(){
    var _version = '1.0',
        _doc = 'this is user service',
        _api_user_add = '/user/add',
        _api_user_delete = '/user/delete',
        _api_user_update = '/user/update',
        _api_user_get = '/user/get';
    this.version = function(){
        return _version;
    };
    this.doc = function(){
        return _doc;
    };
    this.init = function(){};
    this.add = function(data, callback){
        app.utils.post(_api_user_add,data,callback);
    };
    this.delete = function(data, callback){
	    app.utils.get(_api_user_delete,data,callback);
    };
    this.get = function(data, callback){
	    app.utils.get(_api_user_get,data,callback);
    };
    this.update = function(data, callback){
	    app.utils.post(_api_user_update,data,callback);
    }
};
app.user = new User(); 



$.app = app;
})(jQuery);
