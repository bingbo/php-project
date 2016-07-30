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
 * @desc 全局cookie操作工具类
 * @name Cookie class
 */
var Cookie = function(){
    var _version = 1.0,
        _author = 'ibingbo',
        _doc = 'this is cookie class, provider some cookie operations',
        _cookieKeyPrefix = '';

    var _generateCookieKeyPrefix = function(value){
        var simpleHash = function(value){
            var hash = 0;
            if(value.length == 0){
                return hash;
            }

            for(var i = 0; i < value.length; i++){
                var ch = value.charCodeAt(i);
                hash = ((hash << 5) - hash) + ch;
                hash = hash & hash;
            }
            return hash;
        };

        return value ? simpleHash(value) : simpleHash('demo'); 
    };
    var _init = function(){
        _cookieKeyPrefix = _generateCookieKeyPrefix();
    };

	/**
     * @desc 设置cookie，默认为30天过期，
     * @param key,value,expire-自定义过期时间，单位秒
     * @return void
     */
    this.set = function(key, value, expire){
        key = _cookieKeyPrefix + key;

        var expireDate = new Date();
        if(expire){
	        expireDate.setTime(expireDate.getTime() + expire * 1000);
        }else{
        	expireDate.setDate(expireDate.getDate() + 30);
        }
        document.cookie = encodeURIComponent(key) + '=' + encodeURIComponent(value) + "; expires=" + expireDate.toUTCString();
    };

    this.get = function(key){
        key = _cookieKeyPrefix + key;

        var equalities = document.cookie.split('; ');
        for (var i = 0; i < equalities.length; i++) {
            if (!equalities[i]) {
                continue;
            }

            var splitted = equalities[i].split('=');
            if (splitted.length != 2) {
                continue;
            }

            if (decodeURIComponent(splitted[0]) === key) {
                return decodeURIComponent(splitted[1] || '');
            }
        }
        return null;
    };

    _init();
};
app.cookie = new Cookie();
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
