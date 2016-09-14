<?php
namespace App\Middlewares;

use Src\CoreMiddleware;
use App\Classes\AuthClass;

class AuthMiddleware extends CoreMiddleware
{
    public function isConnected()
    {
        $auth = new AuthClass($this->response, $this->request, $this->query);
        if ($auth->isConnected()) {
            return true;
        }
        $this->response->redirect('/login');
        return false;
    }

    public function isNotConnected()
    {
        $auth = new AuthClass($this->response, $this->request, $this->query);
        if ($auth->isConnected()) {
            $this->response->redirect('/');
            return false;
        }
        return true;
    }
}