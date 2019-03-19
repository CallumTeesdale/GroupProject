<?php
require __DIR__  . '/vendor/autoload.php';
use \PayPal\Rest\ApiContext;
use \PayPal\Auth\OAuthTokenCredential;
$paypal = new \PayPal\Rest\ApiContext(
  new \PayPal\Auth\OAuthTokenCredential(
    'AdsycS8HU1uZvmTpatpgsE1dSiynHk9qYcv25Fscx0IRE6Nj4y6QF5su23v7-OU0OG2OSMDB4YPTZH0U',
    'ELi5HMQi5UvgXX-8VuD1W7uq7SI587IdWJz-u1zd2wFIKUBIgb4935IwJYiGzDih6g1JF2HoLoCGKDL_'
    )
  );
