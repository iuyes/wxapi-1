<?php

/**
 * Created by PhpStorm.
 * User: mic101
 * Date: 15/3/19
 * Time: 下午10:11
 * 微信校验功能类
 */
class WechatVerify
{
    //微信校验接口是否有效
    public static function  checkInterfaceOK(){
        echo $_GET['echostr'];
    }
}