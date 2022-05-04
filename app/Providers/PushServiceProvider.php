<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PushServiceProvider
{

public function SendPush($user_token) {
    
        $JWT_header = base64_encode('{"alg":"RS256","typ":"JWT"}');
        
        $issue_time = time();
        
        $JWT_claim_set = base64_encode(
        '{
          "type": "service_account",
          "project_id": "sands-8e750",
          "private_key_id": "d85790db9edd6868e0ccac9aea006ca60953380e",
          "client_email": "firebase-adminsdk-f2vj3@sands-8e750.iam.gserviceaccount.com",
          "client_id": "101489880069507777794",
          "auth_uri": "https://accounts.google.com/o/oauth2/auth",
          "token_uri": "https://oauth2.googleapis.com/token",
          "auth_provider_x509_cert_url": "https://www.googleapis.com/oauth2/v1/certs",
          "client_x509_cert_url": "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-f2vj3%40sands-8e750.iam.gserviceaccount.com",
          "iss":"firebase-adminsdk-f2vj3@sands-8e750.iam.gserviceaccount.com",'.
         '"scope":"https://www.googleapis.com/auth/firebase.messaging",'.
         '"aud":"https://www.googleapis.com/oauth2/v4/token",'.
         '"exp":'.($issue_time + 3600).','.
         '"iat":'.$issue_time.'
        }'
        );
         
        
          // см. примечание
        
        $private_key = 
"-----BEGIN PRIVATE KEY-----
MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDDnFmlCyoptwvH
0M+Zgj7WAb8dRLN0eOj4CrnjHoaf3hVixuECgN1KLfghH+mRipWOMWH/7ZtGRoJT
6Zwm39wsvxHVJH9iW1812E7Z7ix08/Mu2CfvN6/fbl1EFfzi9vultU2MkyOhot6Q
XVuAtWFiVHT3uq9jxCFnunTOmAP3Yq1ZwR5uUB2v0PKdj7oBprQysDA0k4D7X80g
nz29xs1gV0+i09COJAmioDoHHgyL36OmFWGeBax58xXJal3EoQYJVjAw5Pn7adWh
CA4jhyaVc6EtKyDo2NjzGub8IMxjG2KsgMAaftWjKRXn9L8wjwxujOhVCDJj9W9G
0ClQTLVrAgMBAAECggEADRVmm5bxFYQ0SgOp9xMSn97TCSKgvDAgKQMSpuHSUFwa
4xX5U+EJrB4CBDkttrnlwfKEowkiAyPRMMql0qXThLys9SwxRwNkjWXv9DythY8R
m3cCyMnZPiEUJOsxlH6/mzhSvQ3UasnJiC9uYOAA6QJMJou6kno6X8VFbdIWJdQ6
XpbrUSMGZW4t5G2wX9YBAtZ9DWSMmfxK6fpbu/dcGh5MZuVfWwnvb4hrpHm2yyCm
W6eeyaejuEQcW2QBrwg+AF3zzPf7Q85GKFc9CCQyOVmooSfp4kSrpyECa1uvYfzR
60zsK6TcSzWhdKkuUOMHMChvCdfkHmSGkSUO6nkx1QKBgQDn+4SPDKdbpBk3Opsk
zD/nXT2WnyHFbKVatEgIhv+1Nw5Ty5+mkcVN0iH+wQQ1LZ12Ws1XcrvJh6f3Lv0A
EZpzaHpc+c4NZ4aL09LxS1JY4ym+aOBT7Q+WY2ALDgqJq7DtxuPT9WKk/JHuDNH3
tZiMVFVa6+phZ9yvRj113tmmVQKBgQDX3NUquXHjdCJLbQZZJFOQ5QLxqL1kKJ7j
PN/ECx4bjL9cbJsyk2+c7BiLo7JW3c8oSHNCewoIVBhzG/BiSBGjRCZsHPfIaSpV
xF2meR3NKwoGk8mslvQ36j3g5t5MbhxozQkVG/f0ujewnRswP1hCTbCxg+0zK04o
8EWbuwcsvwKBgQCwZCcfPlfi7pvdyso86LGOku9JoCZln377wSkkksHMYNicDrCO
TzjfO3Bt7QXuCYk5fUG1xJ/VVTj6Utg9PSVbq42fNLLgrl834xD6OHOc8t3C0qwA
JLk9eMKGpV6N3+bgZeLGQEeJfCLaBxWAbKxZx6Y/RDMrbXX4MEh7X7/PIQKBgQCK
D5fXJ5yL2W9FxolU4kMAXTiwzzeyo7hbpkeH34R2ImMR/fSVOG8ecnKQfTZHEL66
CPyO/JrCEOdCWBA7C9UcEy5v32crKvgEuv8axkQlQO28nzFRzYqNaKgC/CYZxCMv
dFPmyGiigae0sgb9qMYOQhpMrxA6tevbizE6FTjViQKBgHCwpxMIKunnsC74suYY
ndN+84egeHY2+VA2EPF6hiaZaxFV7eM6NIBeck6iFmj0EUhrgfTRN4HfnIqaL/Mv
miYoT8MeLt7oD5NC88jT3fG1Gk5i6JKzHKpo6lcdnLzReNixtX0iE0fKKdS1PDnd
DVvGPGnol7sXK4Y7FKExJyNA
-----END PRIVATE KEY-----";
        $data = $JWT_header.'.'.$JWT_claim_set;
        $binary_signature = '';
        
        openssl_sign($data, $binary_signature, $private_key, 'SHA256');
        
        $JWT_signature = base64_encode($binary_signature);
        
        
        $JWT = $JWT_header.'.'.$JWT_claim_set.'.'.$JWT_signature;
        
        
        
          // -- шаг 2. авторизируемся и получаем токен -- //
        
        $socket = @fsockopen('ssl://www.googleapis.com', 443, $errno, $errstr, 10);
        
        if (!$socket)  die('error: remote host is unreachable.');
        
        
        $payload = 'grant_type=urn%3Aietf%3Aparams%3Aoauth%3Agrant-type%3Ajwt-bearer&assertion='.rawurlencode($JWT);
        
        $send  = '';
        $send .= 'POST /oauth2/v4/token HTTP/1.1'."\r\n";
        $send .= 'Host: www.googleapis.com'."\r\n";
        $send .= 'Connection: close'."\r\n";
        $send .= 'Content-Type: application/x-www-form-urlencoded'."\r\n";
        $send .= 'Content-Length: '.strlen($payload)."\r\n";
        $send .= "\r\n";
        
        $send .= $payload;
        
        
        $result = fwrite($socket, $send);
        
        $receive = '';
        while (!feof($socket))  $receive .= fread($socket, 8192);
        
        fclose($socket);
        
        echo '<pre>'.$receive.'</pre>';
        
        
        
          // -- parse answer JSON (lame) -- //
        
        $line = explode("\r\n", $receive);
        if ($line[0] != 'HTTP/1.1 200 OK')  die($line[0]);
        
        $pos = FALSE;
        if (($pos = strpos($receive, "\r\n\r\n", 0)) !== FALSE ) {
          if (($pos = strpos($receive, "{", $pos+4)) !== FALSE ) {
            if (($pose = strpos($receive, "}", $pos+1)) !== FALSE ) {
              $post = substr($receive, $pos, ($pose - $pos+1) );
              $aw = json_decode($post, TRUE);
              $access_token = $aw['access_token'];
              }
            else die('} not found.');
            }
          else die('{ not found.');
          }
        else die('\r\n\r\n not found.');
        
        
        
            // -- шаг 3. отправляем запрос на Firebase сервер -- //
        
        $socket = @fsockopen('ssl://fcm.googleapis.com', 443, $errno, $errstr, 10);
        
        if (!$socket)  die('error: remote host is unreachable.');
        
        $tokenn = "";
        //// "token": "'.$user_token.'",
        // die($tokenn);
        $payload = '{
          "message":{
          "token": "'.$user_token.'",
            "notification" : {
              "title" : "Замена!",
              "body" : "Для Вас есть новая замены, откройте приложние, чтобы посмотреть."
              }
           }
        }';
        echo($payload);
        // die($payload);
        $send  = '';
        $send .= 'POST /v1/projects/sands-8e750/messages:send HTTP/1.1'."\r\n";
        $send .= 'Host: fcm.googleapis.com'."\r\n";
        $send .= 'Connection: close'."\r\n";
        $send .= 'Content-Type: application/json'."\r\n";
        $send .= 'Authorization: Bearer '.$access_token."\r\n";
        $send .= 'Content-Length: '.strlen($payload)."\r\n";
        $send .= "\r\n";
        
        $send .=$payload;
        
        
        $result = fwrite($socket, $send);
        
        $receive = '';
        while (!feof($socket))  $receive .= fread($socket, 8192);
        
        fclose($socket);
        echo '<pre>'.$receive.'</pre>';
  }
}