<?php


class OperadorCheckinController extends BaseAuthController
{
    public function index()
    {
        $this->authFilterByRole('operadorcheckin');

        return \ArmoredCore\WebObjects\View::make('operadorcheckin.index');
    }

}