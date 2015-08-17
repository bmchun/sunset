<?php 
header("Content-type: text/html; charset=utf-8");
require_once '../../../third_party/TopSdk.php';
$c = new TopClient;
$c->appkey = '23210056';
$c->secretKey = '70ae4ec986cf0e9bcfbcd61c3f52d8cf';
$req = new AtbItemsDetailGetRequest;
$req->setFields("open_iid,detail_url");
$req->setOpeniids("45034933113");
$resp = $c->execute($req); 
print_r($resp);
/* $c = new TopClient;
$c->appkey = appkey;
$c->secretKey = secret;
$req = new TaeItemDetailGetRequest;
$req->setBuyerIp("127.0.0.1");
$req->setFields("itemInfo,priceInfo,skuInfo,stockInfo,rateInfo,descInfo,sellerInfo,mobileDescInfo,deliveryInfo,storeInfo,itemBuyInfo,couponInfo");
$req->setOpenIid("AAF123A");
$req->setId("AAF123A");
$resp = $c->execute($req, $sessionKey); */

?>