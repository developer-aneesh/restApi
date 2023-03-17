<?php
include_once('ApiBase.php');
class UserModel extends ApiBase
{
    public $userList = [
        0 => 'Vallie Boscoss',
        1 => 'Neha Gorczany',
        2 => 'Kaitlin Kulas',
        3 => 'Vivien Romaguera',
        4 => 'Jamarcus Watsica',
        5 => 'Malika Murphy',
        6 => 'Rebekah Stokes',
        7 => 'Miss Braden Will',
        8 => 'Annie Carroll',
        9 => 'Savanah Rath',
        10 => 'Estell Hayes',
        11 => 'Ronny Leannon',
        12 => 'Broderick West',
        13 => 'Miss Claude Lesch',
        14 => 'Weldon Mosciski MD',
        15 => 'Horacio Anderson',
        16 => 'Astrid Schinner',
        17 => 'Elvis Okuneva III',
        18 => 'Ms. Clay Hansen',
        19 => 'Melissa Bradtke',
    ];

    //return all users
    public function userList()
    {
        return $this->userList;
    }

    //return specific user details
    public function userDetails($id)
    {
        return isset($this->userList[$id]) ? array('User Name' => $this->userList[$id]) : null;
    }
}