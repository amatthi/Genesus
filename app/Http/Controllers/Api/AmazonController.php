<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AmazonController extends Controller
{
    private $s3;
    private $aws_access_key_id = 'AKIAIKTBSRSNTPRV6TNA';
    private $aws_secret_key    = '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';
    private $bucket_name       = '';
    private $base_url          = 'https://tappyn.s3.amazonaws.com/';

    public function __construct()
    {

    }

    protected function get_token(Request $request)
    {
        $this->bucket_name = $request->input('bucket');
        $expire            = gmdate('Y-m-d\TH:i:s\Z', time() + (12 * 60 * 60 * 1000));

        $url             = 'https://' . $this->bucket_name . '.s3.amazonaws.com';
        $policy_document = '
            {"expiration": "' . $expire . '",
             "conditions": [
                {"bucket": "' . $this->bucket_name . '"},
                ["starts-with", "$key", ""],
                {"acl": "public-read"},
                ["content-length-range", 0, 20971520],
                ["starts-with", "$Content-Type", ""]
            ]
        }';
        $policy    = base64_encode($policy_document);
        $hash      = $this->hmacsha1($this->aws_secret_key, $policy);
        $signature = $this->hex2b64($hash);
        $token     = [
            'policy'    => $policy,
            'signature' => $signature,
            'key'       => $this->aws_access_key_id,
            'base_url'  => $this->base_url,
        ];

        return $token;
    }

    private function hmacsha1($key, $data)
    {
        $blocksize = 64;
        $hashfunc  = 'sha1';
        if (strlen($key) > $blocksize) {
            $key = pack('H*', $hashfunc($key));
        }

        $key  = str_pad($key, $blocksize, chr(0x00));
        $ipad = str_repeat(chr(0x36), $blocksize);
        $opad = str_repeat(chr(0x5c), $blocksize);
        $hmac = pack('H*', $hashfunc(($key ^ $opad) . pack('H*', $hashfunc(($key ^ $ipad) . $data))));
        return bin2hex($hmac);
    }

    private function hex2b64($str)
    {
        $raw = '';
        for ($i = 0; $i < strlen($str); $i += 2) {
            $raw .= chr(hexdec(substr($str, $i, 2)));
        }
        return base64_encode($raw);
    }
}
