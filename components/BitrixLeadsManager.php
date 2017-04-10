<?php
namespace app\components;

use yii\base\Component;
use yii\base\Object;

class BitrixLeadsManager extends Object {
    const FIELD_TITLE = 'TITLE';
    const FIELD_NAME = 'NAME';
    const FIELD_PHONE = 'PHONE_WORK';
    const FIELD_EMAIL = 'EMAIL_WORK';
    const FIELD_ADDRESS = 'ADDRESS';
    const FIELD_COMMENT = 'COMMENTS';
    const FIELD_DESCRIPTION = 'SOURCE_DESCRIPTION';
    const FIELD_ASSIGNED_BY_ID = 'ASSIGNED_BY_ID';
    const FIELD_SOURCE_ID = 'SOURCE_ID';

    public $host;
    public $port = '443';
    public $path;

    public $login;
    public $password;

    public function sendRequest(array $data) {
        $requestData = [];
        $requestData['LOGIN'] = $this->login;
        $requestData['PASSWORD'] = $this->password;
        $requestData = array_merge($requestData, $data);

        // open socket to CRM
        $output = false;
        $fp = fsockopen("ssl://".$this->host, $this->port, $errno, $errstr, 30);
        if ($fp)
        {
            // prepare POST data
            $strPostData = '';
            foreach ($requestData as $key => $value)
                $strPostData .= ($strPostData == '' ? '' : '&').$key.'='.urlencode($value);
            // prepare POST headers
            $str = "POST ".$this->path." HTTP/1.0\r\n";
            $str .= "Host: ".$this->host."\r\n";
            $str .= "Content-Type: application/x-www-form-urlencoded\r\n";
            $str .= "Content-Length: ".strlen($strPostData)."\r\n";
            $str .= "Connection: close\r\n\r\n";
            $str .= $strPostData;

            // send POST to CRM
            fwrite($fp, $str);

            // get CRM headers
            $result = '';
            while (!feof($fp))
            {
                $result .= fgets($fp, 128);
            }
            fclose($fp);


            // cut response headers
            $response = explode("\r\n\r\n", $result);
            $resp_str = str_replace('\'', '"', $response[1]);
            $output = json_decode($resp_str, true);
        }
        else
        {
            echo 'Connection Failed! '.$errstr.' ('.$errno.')';
        }

        return $output;
    }
}