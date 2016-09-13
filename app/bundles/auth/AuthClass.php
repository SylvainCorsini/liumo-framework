<?php
namespace App\Bundles\Auth;

use Src\CoreClass;
use Src\Http\HttpCookie;

class AuthClass extends CoreClass
{
    public function connectUser($id = 0, $password = null)
    {
        $cookieId = new HttpCookie("auth_id", $id);
        $cookiePwd = new HttpCookie("auth_pwd", $password);
        $this->response->addCookie($cookieId);
        $this->response->addCookie($cookiePwd);
    }

    public function disconnectUser()
    {
        $this->response->deleteCookie("auth_id");
        $this->response->deleteCookie("auth_pwd");
    }

    public function isConnected()
    {
        $userId = $this->request->getCookie("auth_id");
        $password = $this->request->getCookie("auth_pwd");

        $result = $this->query->table('users')->select('*')
            ->where('user_id', $userId)
            ->first();

        if (!empty($result) && (strcmp($password, $result->password) || $password == $result->password)) {
            return true;
        }
        return false;
    }
}