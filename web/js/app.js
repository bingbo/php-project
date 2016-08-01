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

    this.title = 'User Model';

    this.fields = [
        {name: 'id', showName: 'id', editable: true, deletable: true, searchable: true},
        {name: 'name', showName: '姓名', editable: true, deletable: true, searchable: true},
        {name: 'password', showName: '密码', editable: true, deletable: true, searchable: false},
        {name: 'email', showName: '邮箱', editable: true, deletable: true, searchable: false}
    ];
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


var Model = function(){
    var _options = {
        edit: true,
        add: true,
        delete: true,
        search: true
    };
    
    var _models = {};

    var _$container = null;
    this.setContainer = function($con){
        _$container = $con;
    };
    this.setOptions = function(opts){
        _options = $.extend(_options, opts);
    };
    this.registerModel = function(key, mod){
        _models[key] = mod;
    };
    this.loadModel = function(key){
        if(key == '' || key == null){
            return;
        }
        var curMod = _models[key];
        _createPageHeader(curMod);
        _createPageBody(curMod);
    };

    var _createPageHeader = function(mod){
        var _$pHeader = $('<div class="page-header">'),
            _$pTitle = $('<h1>' + mod.title + '</h1>');
        _$pHeader.append(_$pTitle);
        _options.search && _createSearchBox(mod, _$pHeader);
        _$container && _$container.append(_$pHeader);
    };
    var _createSearchBox = function(mod, _$pHeader){
        var _$form = $('<form class="form-inline search-box">');
        var _fields = mod.fields;
        for(var i=0; i<_fields.length; i++){
            var _fld = _fields[i];
            if(_fld.searchable){
                var _$group = $('<div class="form-group">');
                _$group.append($('<label>').html(_fld.showName));
                var _$fd = $('<input type="text" class="form-control">');
                _$fd.attr('name', _fld.name);
                _$group.append(_$fd);
                _$form.append(_$group);
            }
        }
        _$form.append('<button type="submit" class="btn btn-default" data-loading-text="Search...">查询</button>');
        _$form.append('<button type="submit" class="btn btn-success pull-right" data-target="#add-modal">添加</button>');
        _$pHeader.append(_$form);
    };
    var _createPageBody = function(mod){
        var $table = $('<table class="table table-borderd">');
        _createTableHead(mod, $table);
        _createTableBody(mod, $table);
        _$container && _$container.append($table);
    };

    var _createTableHead = function(mod, $table){
        var $thead = $('<thead>'),
            $row = $('<tr>');
        for(var i=0; i<mod.fields.length; i++){
            $row.append('<th>' + mod.fields[i].showName + '</th>');
        }
        (_options.edit || _options.delete) && $row.append('<th>操作</th>');
        $table.append($thead.append($row));
    };

    var _createTableBody = function(mod, $table){
        var $tbody = $('<tbody>');
        var data = [
            {id:1,name:'bill',password:'1111',email:'bill@126.com'},
            {id:1,name:'bill',password:'1111',email:'bill@126.com'}
        ];
        for(var i=0; i<data.length; i++){
            var $row = $('<tr>');
            for(var idx in data[i]){
                $row.append('<td>' + data[i][idx] + '</td>');
            }
            $row.append('<td><span onclick="update()" class="btn btn-warning btn-xs">修改</span><span onclick="delete()" class="btn btn-danger btn-xs">删除</span></td>');
            $tbody.append($row);
        }
        $table.append($tbody);
    };


};
app.model = new Model();
$.app = app;
})(jQuery);
