<?php

$hbase = [
            'class' => 'app\library\components\Hbase',
            'host' => '127.0.0.1',
            'port' => 16010
        ];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $hbase['host'] = '127.0.0.1';
    $hbase['port'] = 9090;
}
if (YII_ENV_TEST) {
    // configuration adjustments for 'test' environment
}
if (YII_ENV_PROD) {
    // configuration adjustments for 'prod' environment
    $hbase['host'] = '127.0.0.1';
    $hbase['port'] = 9090;
}

return $hbase;
