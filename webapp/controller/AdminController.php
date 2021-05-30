<?php


class AdminController extends BaseAuthController
{
    public function index()
    {
        $this->authFilterByRole('administrador');

        return \ArmoredCore\WebObjects\View::make('admin.index');
    }
}