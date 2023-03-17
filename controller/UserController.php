<?php
include_once ROOT_DIR . '/config.php';
include_once ROOT_DIR . '/models/UserModel.php';
include_once ROOT_DIR . '/models/ApiBase.php';
class UserController extends ApiBase
{

    //list all users
    public function list()
    {
        $model = new UserModel();
        return $this->apiResponse(200, 'User List', $model->userList());
    }

    //get specific user details
    public function userDetails($id)
    {
        $model = new UserModel();
        if ($model->userDetails($id) != null) {
            return $this->apiResponse(200, 'User Details', $model->userDetails($id));
        } else {
            return $this->apiResponse(404, 'Invalid User');
        }
    }

    //check the function existance
    public function __call($func, $args)
    {
        if (!method_exists($this, $func)) {
            return $this->apiResponse(404, 'Invalid Request');
        }
    }
}