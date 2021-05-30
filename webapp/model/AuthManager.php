<?php
use ArmoredCore\WebObjects\Session;

class AuthManager
{
    public function setAuthData($userId, $userRole)
    {
        Session::set('APP_USER_ID', $userId);
        Session::set('APP_USER_ROLE', $userRole);
    }

    public function logOut()
    {
        Session::destroy();
    }

    static public function isUserLoggedIn()
    {
        return Session::has('APP_USER_ID');
    }

    static public function getLoggedRole()
    {
        if(self::isUserLoggedIn())
        {
            return Session::get('APP_USER_ROLE');
        }
    }

    static public function getLoggedId()
    {
        if(self::isUserLoggedIn())
        {
            return Session::get('APP_USER_ID');
        }
    }

}