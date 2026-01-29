<?php

namespace Modules\Premier\Http\Classes;

use App\Http\Controllers\Controller;

class Paytabs  extends Controller
{
    public   $profile_id = 107635;
    public    $server_key = 'SGJNHJRBMB-JH92KBZKNJ-TG2WZNLH92';//@env('merchant_secretKey');
    public    $base_url = 'https://secure.paytabs.sa/';

    function send_api_request($request_url, $data, $request_method = null)
    {
        $data['profile_id'] = $this->profile_id;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . $request_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_CUSTOMREQUEST => isset($request_method) ? $request_method : 'POST',
            CURLOPT_POSTFIELDS => json_encode($data, true),
            CURLOPT_HTTPHEADER => array(
                'authorization:' . $this->server_key,
                'Content-Type:application/json'
            ),
        ));

        $response = json_decode(curl_exec($curl), true);
        curl_close($curl);
        return $response;
    }

    function getBaseUrl()
    {
        $currentPath = $_SERVER['PHP_SELF'];
        $pathInfo = pathinfo($currentPath);
        $hostName = $_SERVER['HTTP_HOST'];
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'https://';
        $current_directory = substr(strrchr($pathInfo['dirname'],'/'), 1);
        $parent_directory = substr($pathInfo['dirname'], 0, - strlen($current_directory));
        return   $protocol.$hostName.'/'.$current_directory.'/';
    }

    function is_valid_redirect($post_values)
    {
        $serverKey = $this->server_key;

        // Request body include a signature post Form URL encoded field
        // 'signature' (hexadecimal encoding for hmac of sorted post form fields)
        $requestSignature = $post_values["signature"];
        unset($post_values["signature"]);
        $fields = array_filter($post_values);

        // Sort form fields
        ksort($fields);

        // Generate URL-encoded query string of Post fields except signature field.
        $query = http_build_query($fields);

        $signature = hash_hmac('sha256', $query, $serverKey);
        if (hash_equals($signature, $requestSignature) === TRUE) {
            // VALID Redirect
            return true;
        } else {
            // INVALID Redirect
            return false;
        }
    }
}
