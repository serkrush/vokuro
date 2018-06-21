<?php
/**
 * Created by PhpStorm.
 * User: kalin-mv
 */

namespace Vokuro;


class Result {
    private static $_error = true;
    private static $_message = "";
    private static $_code = 0;

    public static function isError() { return self::$_error; }
    public static function getMessage() { return self::$_message; }
    public static function getCode() { return self::$_code; }

    public static function to($message = null, $error = true, $code = 0) {
        if (is_array($message)) {
            self::$_message = isset($message["message"])?$message["message"]:"Unexpected error with result!";
            self::$_error = isset($message["error"])?$message["error"]:true;
            self::$_code = isset($message["code"])?$message["code"]:true;
        } else if ($message !== null) {
            self::$_message = $message;
            self::$_error = $error;
            self::$_code = $code;
        }
        return array("error" => self::$_error, "message" => self::$_message, "code" => self::$_code);
    }

    public static function get($data = null) {
        $data = ($data == null ? Result::to() : $data);
        $result = array(
            "error" => true,
            "result" => array("message" => "The server has returned empty response.", "code" => 0));
        if (is_array($data) && count($data) > 0) {
            $result["error"] = isset($data["error"]) ? $data["error"] : false;
            unset($data["error"]);
            $result["result"] = isset($data["result"]) ? $data["result"] : $data;
            $result["result"]["code"] = isset($data["code"]) ? $data["code"] : 0;
        } else {
            $result = self::to();
        }
        return $result;
    }
}