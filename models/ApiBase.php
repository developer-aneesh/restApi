<?php
include_once ROOT_DIR . '/config.php';
header("Content-Type: application/json; charset=UTF-8");
session_start();
class ApiBase
{

    public $max_call_limit; //maximum request allowed in specific time period
    public $time_period; //in seconds
    public $user_ip;

    public function __construct()
    {
        $this->max_call_limit = MAX_REQUESTS;
        $this->time_period = MAX_TIME_PERIOD;
    }

    //get the client IP address for throttle request
    public function getClient()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $this->user_ip = $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_HOST'])) {
            $this->user_ip = $_SERVER['HTTP_HOST'];
        } else {
            $this->user_ip = $_SERVER['REMOTE_ADDR'];
        }
        return $this->user_ip;
    }

    //check the request count meets with allowded rate limit
    public function check()
    {
        if (!isset($_SESSION['requestLog'])) {
            $_SESSION['requestLog'] = [];
        }
        $currTime = time();
        $requestIp = $this->getClient();
        if (!isset($_SESSION['requestLog'][$requestIp])) {
            $_SESSION['requestLog'][$requestIp]['requestTimes'][] = $currTime;
            $firstRequestTime = $currTime;
        } else {
            $_SESSION['requestLog'][$requestIp]['requestTimes'][] = $currTime;
            $requestTimeList = $_SESSION['requestLog'][$requestIp]['requestTimes'];
            $new_list = array_slice($requestTimeList, '-' . $this->max_call_limit);
            $_SESSION['requestLog'][$requestIp]['requestTimes'] = $new_list;
        }
        $firstRequestTime = $_SESSION['requestLog'][$requestIp]['requestTimes'][0];
        if ($firstRequestTime > $currTime -  $this->time_period) {
            return false;
        } else {
            return true;
        }
    }

    //api response base function
    public function apiResponse($responseCode, $message = null, $data = null)
    {
        http_response_code($responseCode);
        $response['status'] = $responseCode;
        $response['message'] = $message;
        $response['data'] = $data;
        echo json_encode($response);
        exit;
    }
}