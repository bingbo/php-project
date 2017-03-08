通过composer进行依赖管理的yii2框架demo
### 系统框架

![](https://github.com/bingbo/blog/blob/master/images/yii2_frame_dialog.jpg)

### NGINX配置

```nginx
server {
    listen       8002;
    server_name  localhost;

    charset utf-8;
    client_max_body_size    128M;


    root    html/yii2demo/web;
    index   index.php;

    location / {
        try_files   $uri $uri/  /index.php$is_args$args;
    }

    location ~ \.(js|css|png|jpg|gif|swf|ico)$ {
        expires 1y;
        access_log off;
        add_header Cache-Control "public";
    }


    # redirect server error pages to the static page /50x.html
    #
    error_page   500 502 503 504  /50x.html;
    location = /50x.html {
        root   html;
    }

    location ~ ^/assets/.*\.php$ {
        deny    all;
    }

    # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
    #
    
    location ~ \.php$ {
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        include        fastcgi_params;
        try_files   $uri =404;
    }

    location ~* /\. {
        deny  all;
    }
}

```

### 访问
http://localhost:8002/site/index

