<?php
/**
 * @link http://www.tesjin.ru/
 * @copyright Copyright (c) 2014 TesJin Group
 * @license BSD-3-Clause
 */

namespace yii\angularjs;

use yii\web\AssetBundle;

/**
 * This asset bundle provides the [angular javascript library](https://angularjs.org/)
 *
 * @author Vladislav Orlov <orlov@tesjin.ru>
 */
class AngularAsset extends AssetBundle
{
    public $sourcePath = '@vendor/tesjin/yii2-angularjs';
    public $js = [
        'js/angular.js',
        'js/angular-animate.js',
        'js/angular-cookies.js',
        'js/angular-loader.js',
        'js/angular-mocks.js',
        'js/angular-resource.js',
        'js/angular-route.js',
        'js/angular-sanitize.js',
        'js/angular-scenario.js',
        'js/angular-touch.js',
    ];
}
