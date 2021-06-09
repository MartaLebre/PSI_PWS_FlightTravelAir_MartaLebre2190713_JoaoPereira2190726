<?php


class GestorVooController extends BaseAuthController
{
    public function index()
    {
        $this->authFilterByRole('gestorvoo');

        User::all(array('conditions' => array('role != ?', 'passageiro')));

        return \ArmoredCore\WebObjects\View::make('gestorvoo.index');
    }
}