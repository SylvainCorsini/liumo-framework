<?php
namespace App\Bundles\Auth\Controllers;

use Src\CoreController;
use App\Bundles\Auth\AuthClass;

class AuthController extends CoreController
{
    public function getRegister()
    {
        return $this->renderer->draw('auth/register');
    }

    public function postRegister()
    {
        $username = $this->request->getParameter('username');
        $email = $this->request->getParameter('email');
        $password = $this->request->getParameter('password');

        $result = $this->query->table('users')->select('*')
            ->where('username', $username)
            ->orWhere('email', $email)
            ->count();

        if ($result > 0) {
            return $this->response->redirect('/register');
        } else {
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
            while (password_needs_rehash($password_hashed, PASSWORD_DEFAULT)) {
                $password_hashed = password_hash($password, PASSWORD_DEFAULT);
            }
            $result = $this->query->table('users')->insert(array(
                'username' => $username,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ));
            if (!$result) {
                return $this->response->redirect('/register');
            } else {
                return $this->response->redirect('/login');
            }
        }
    }

    public function getLogin()
    {
        return $this->renderer->draw('auth/login');
    }

    public function postLogin()
    {
        $login = $this->request->getParameter('login');
        $password = $this->request->getParameter('password');

        $result = $this->query->table('users')->select('*')
            ->where('username', $login)
            ->orWhere('email', $login)
            ->first();

        if (empty($result)) {
            return $this->response->redirect('/login');
        } else {
            if (password_verify($password, $result->password)) {
                $auth = new AuthClass($this->response, $this->request, $this->query);
                $auth->connectUser($result->user_id, $result->password);
                return $this->response->redirect('/');
            } else {
                return $this->response->redirect('/login');
            }
        }
    }
}