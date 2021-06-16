<?php


class OperadorCheckinController extends BaseAuthController
{
    public function index()
    {
        $this->authFilterByRole('operadorcheckin');

        return \ArmoredCore\WebObjects\View::make('operadorcheckin.index');
    }

    public function checkin()
    {

        $tickets = Ticket::all();
        $users = User::all(array('conditions' => array('role = ?', 'passageiro')));

        return \ArmoredCore\WebObjects\View::make('operadorcheckin.checkin', ['users' => $users, 'tickets' => $tickets]);
    }

}