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
 * @desc 模板信息类
 * @name Template class
 */
var Coupon = function(){
    var _version = '1.0',
        _doc = 'this is coupon service',
        _api_coupon_add = '/api/coupon/add',
        _api_coupon_delete = '/api/coupon/delete',
        _api_coupon_get = '/api/coupon/get';
    this.version = function(){
        return _version;
    };
    this.doc = function(){
        return _doc;
    };
    this.init = function(){};
    this.add = function(data, callback){
        app.utils.post(_api_coupon_add,data,callback);
    };
};
app.coupon = new Coupon(); 

/**
 * @desc 订单信息类
 * @name class
 */
var Order = function(){
    var _version = '1.0',
        _doc = 'this is order service',
        _api_order_list = '/api/order/list',
        _api_order_update = '/api/order/update',
        _api_order_export = '/order/export',
        _api_order_get = '/api/order/get';
    this.version = function(){
        return _version;
    };
    this.doc = function(){
        return _doc;
    };
    this.init = function(){};
    this.list = function(data, callback){
        app.utils.post(_api_order_list,data,callback);
    };
    this.update = function(data, callback){
        app.utils.post(_api_order_update,data,callback);
    };
    this.detail = function(data, callback){
        app.utils.post(_api_order_get,data,callback);
    };
    this.export = function(data, callback){
        app.utils.post(_api_order_export,data,callback);
    };
};
app.order = new Order();

/**
 * @desc 渠道号信息类
 * @name Channel class
 */
var Channel = function(){
    var _version = '1.0',
        _doc = 'this is channel service',
        _api_channel_list = '/api/channel/list',
        _api_channel_delete = '/api/channel/delete',
        _api_channel_update = '/api/channel/update',
        _api_channel_add = '/api/channel/add';
    this.version = function(){
        return _version;
    };
    this.doc = function(){
        return _doc;
    };
    this.init = function(){};
    this.list = function(data, callback){
        app.utils.post(_api_channel_list,data,callback);
    };
    this.update = function(data, callback){
        app.utils.post(_api_order_update,data,callback);
    };
    this.add = function(data, callback){
        app.utils.post(_api_channel_add,data,callback);
    };
    this.delete = function(data, callback){
        app.utils.post(_api_channel_delete,data,callback);
    };
};
app.channel = new Channel();

/**
 * @desc 评论信息类
 * @name Comment class
 */
var Comment = function(){
    var _version = '1.0',
        _doc = 'this is comment service',
        _api_comment_list = '/api/comment/list',
        _api_comment_delete = '/api/comment/delete',
        _api_comment_update = '/api/comment/update';
    this.version = function(){
        return _version;
    };
    this.doc = function(){
        return _doc;
    };
    this.init = function(){};
    this.list = function(data, callback){
        app.utils.post(_api_comment_list,data,callback);
    };
    this.update = function(data, callback){
        app.utils.post(_api_order_update,data,callback);
    };
    this.delete = function(data, callback){
        app.utils.post(_api_comment_delete,data,callback);
    };
};
app.comment = new Comment();

/**
 * @desc 订单物流信息类
 * @name Progress class
 */
var Progress = function(){
    var _version = '1.0',
        _doc = 'this is progress service',
        _api_progress_list = '/api/progress/list';
    this.version = function(){
        return _version;
    };
    this.doc = function(){
        return _doc;
    };
    this.init = function(){};
    this.list = function(data, callback){
        app.utils.post(_api_progress_list,data,callback);
    };
    
};
app.progress = new Progress();
$.app = app;
})(jQuery);
