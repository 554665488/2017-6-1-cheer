
<?php
/**
 * 数据加密，解密，验证签名
 * @edit http://www.lai18.com
 * @date 2015-07-08
 **/
 
//header('Content-Type: text/xml; charset=utf-8');
 
include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'phpsec'.DIRECTORY_SEPARATOR.'Math'.DIRECTORY_SEPARATOR.'BigInteger.php');
 
include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'phpsec'.DIRECTORY_SEPARATOR.'Crypt'.DIRECTORY_SEPARATOR.'AES.php');
 
include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'phpsec'.DIRECTORY_SEPARATOR.'Crypt'.DIRECTORY_SEPARATOR.'RSA.php');
 
//密文
 
$crypttext = 'v66YKULHFld2JElhm/J9qik2Edr1JHdZIc/k/OesU2GbTX2usXyvF4jGvzvoihrrE8FsfKmllmjsMIjO5fdrS/FD20bYFii4JW3BO3bzshXmz6AEs2DWwG4sK9mNojfOC0IsMoV311X5/JlgUoQXkDy4F5HHpYE9d/xGb0g2XE/hnGSSy2cpQcvQtBlBmixwSckNhsEG92lovlOz8ULwkqG5o7x+qB7P/EMII/WaFAXBJXDXvZX7lmGcOgon6wLhKJLGXorP6BIxOg6LGc6Ux7BAt3i9+0lujNgxIq/sDsl23hsr3yOUpV5C5a813nrHx4HJyd/hBT1UvIUml+eTmJwWCpSfs2cvxIUr0CE57JAZVyXjK13shK3IsZHLPPsm/JcDCrdy0Co/d5uIGJAdzXdsQ56xsju+tlvnA1J6yq2tDIfYK/x6k911A5WXLKYxztD1nq+bTYN3Gv/WFfrzVtgWQBrh06ihS2cwvna0S9EV/YPmhnAjJmrX4trNr9NXQ9xaZaW4lGRg87U5QDV+nQjj1THk0XHFc69N9g2+DsAGyEs9tK6U0ZQ72hJZqZhBCDH1UKw0PLyIhJdxpgPPOWGp8/QVVU2julTeKunvgAAEc3n+GoZfqjsCDi1S6T2MTnjWYWNoFRBhvEZFD/revgpasTOzDQa5NqR1B+mUF70r6uw6MWLJ7cT9Tz3jq+CA';
 
$aeskey = base64_decode('qZe60QZFxuirub2ey4+7+Q==');
 
//AES解密，采用ECB模式
 
$aes = new Crypt_AES(CRYPT_MODE_ECB);
 
//设置AES密钥
 
$aes->setKey($aeskey);
 
//解密AES密文
 
$plaintext = $aes->decrypt(base64_decode($crypttext));
 
echo $plaintext;
 
echo '<hr />';
 
//AES加密明文
 
//echo $aes->encrypt($plaintext);
 
//rsa公钥
 
$publickey = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCffOeIVYut9jW5w1L5uKX4aDvd837a8JhaWm5S8YqNQfgEmfD9T+rDknXLqMT+DXeQAqGo4hBmcbej1aoMzn6hIJHk3/TfTAToNN8fgwDotHewsTCBbVkQWtDTby3GouWToVsRi1i/A0Vfb0+xM8MnF46DdhhrnZrycERBSbyrcwIDAQAB';
 
//echo base64_decode($publickey);
 
//rsa签名
 
$signature = 'XHin4uUFqrKDEhKBD/hQisXLFFSxM6EZCvCPqnWCQJq3uEp3ayxmFuUgVE0Xoh4AIWjIIsOWdnaToL1bXvAFKwjCtXnkaRwUpvWrk+Q0eqwsoAdywsVQDEceG5stas1CkPtrznAIW2eBGXCWspOj+aumEAcPyYDxLhDN646Krzw=';
 
//echo base64_decode($signature);
 
$rsa = new Crypt_RSA();
 
//设置RSA签名模式 CRYPT_RSA_SIGNATURE_PSS or CRYPT_RSA_SIGNATURE_PKCS1
 
$rsa->setSignatureMode(CRYPT_RSA_SIGNATURE_PKCS1);
 
//var_dump($rsa->createKey());
 
//生成RSA公钥、私钥
 
//extract($rsa->createKey());
 
//使用RSA私钥生成签名
 
//$rsa->loadKey($privatekey);
 
//$signature = $rsa->sign($plaintext);
 
//使用RSA公钥验证签名
 
echo $plaintext;
 
$rsa->loadKey(base64_decode($publickey));
 
echo $rsa->verify($plaintext, base64_decode($signature)) ? 'verified' : 'unverified';
 
echo '<hr />';
 
//生成RSA公钥、私钥
 
//var_dump($rsa->createKey());
 
extract($rsa->createKey());
 
//使用RSA私钥加密数据
 
$rsa->loadKey($privatekey);
 
$ciphertext = $rsa->encrypt($plaintext);
 
//使用RSA公钥解密数据
 
$rsa->loadKey($publickey);
 
echo $rsa->decrypt($ciphertext);
