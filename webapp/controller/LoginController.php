<?php

use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class LoginController
{
    public function LogInForm()
    {
        return View::make('login.login');
    }

    public function RegistoForm()
    {
        return View::make('login.registoform');
    }

    public function Login()
    {
        $username = Post::get('username');
        $password = Post::get('password');

        $user = User::find_by_username_and_password($username, $password);

        if(is_null($user))
        {
            $erro = 'ERRO! Username ou Password errados!';
            Redirect::flashtoRoute('login/getlogin', ['erro' => $erro]);
        }
        else
        {
            $authmgr = new AuthManager();

            $authmgr->setAuthData($user->id, $user->role);

            $role = $user->role;

            switch ($role)
            {
                case 'administrador':
                    Redirect::toRoute('admin/index');
                    break;

                case 'operadorcheckin':
                    Redirect::toRoute('operadorcheckin/index');
                    break;

                case 'gestorvoo':
                    Redirect::toRoute('gestorvoo/index');
                    break;

                case 'passageiro':
                    Redirect::toRoute('passageiro/index');
                    break;

                default:
                    Redirect::toRoute('login/getlogin');
            }
        }
    }
    public function Registo()
    {
        $nif = Post::get('nif');
        $userexists = User::find_by_nif($nif);

        $user = new User(Post::getAll());

        if (is_null($userexists)) {
            $user->role = 'passageiro';

            var_dump($user);

            if ($user->is_valid()) {
                $user->save();
                Redirect::toRoute('login/getlogin');
            } else {
                Redirect::flashToRoute('login/getregisto', ['user' => $user]);
            }
        } else {
            Redirect::flashToRoute('login/getregisto', ['user' => $user]);
        }
    }

    public function logout()
    {
        $authmgr = new AuthManager();

        $authmgr->logOut();

        Redirect::toRoute('home/index');
    }

}