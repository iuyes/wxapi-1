<?php
include_once "WechatVerify.php";
include_once "wxCrypt/wxBizMsgCrypt.php";

//公众平台配置信息
$encodingAesKey = "TcRw0JEu2lNgc6M75asAgsRzFvHgr0sqFWEC4azQzkO";
$token = "zcdmx101";
$appId = "wxe4390e3ac4ce8ba4";
$appSecret = "ca949dbe0e87c697855161c15bf56a5d";
$pc = new WXBizMsgCrypt($token, $encodingAesKey, $appId);
$wechatVerify = new WechatVerify($appId,$appSecret);
echo $wechatVerify->getAccessToken();
exit;
//get方式接收的参数
$timeStamp = $_GET['timestamp'];
$nonce = $_GET['nonce'];
$msg_sign = $_GET['signature'];
//post收到的消息密文
$encryptMsg = $GLOBALS["HTTP_RAW_POST_DATA"];
$xml_tree = new DOMDocument();
$xml_tree->loadXML($encryptMsg);
$array_e = $xml_tree->getElementsByTagName('ToUserName');
$array_s = $xml_tree->getElementsByTagName('FromUserName');
$tousername = $array_e->item(0)->nodeValue;
$fromusername = $array_s->item(0)->nodeValue;
$content = $xml_tree->getElementsByTagName('Content')->item(0)->nodeValue;
$format = "<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>12345678</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[<a href=\"http://isogu.cn/stock/quotes/S/code/%s\">%s</a>]]></Content></xml>";
$from_xml = sprintf($format, $fromusername,$tousername,$content,$content);
echo $from_xml;

exit;
$msg = '';
$errCode = $pc->decryptMsg($msg_sign, $timeStamp, $nonce, $encryptMsg, $msg);
if ($errCode == 0) {
        print("解密后: " . $msg . "\n");
} else {
        print($errCode . "\n");
}