<?php

namespace Khoirulh1610\Helpers;

class Whatsapp{	
	public static function start($data)
    {
        return self::curl("new", $data);
    }

    public static function qrcode($data)
    {
        return self::curl("qrcode", $data, "GET");
    }

    public static function send($data)
    {
        return self::curl("send", $data);
    }

    public static function reset($data)
    {
        $close = self::curl("close", $data, "GET");
        return   self::curl("new", $data);
    }

    public static function getcontacts($data)
    {
        return self::curl("getcontacts", $data, "GET");
    }

    public static function getgroup($data)
    {
        return self::curl("group-info", $data, "GET");
    }

    public static function logout($data)
    {
        return self::curl("logout", $data, "GET");
    }

    static function curl($url, $data, $method = "POST")
    {
        $device = Device::where('id', $data['device_id'])->first();
        // return $device;
        if ($device) {
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $device->server->ip . ":" . $device->server->port . "/" . $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json"
                ],
            ]);
            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return [
                    'status' => false,
                    'message' => "cURL Error #:" . $err,
                ];
            } else {
                return $response;
            }
        } else {
            return $data;
        }
    }
}