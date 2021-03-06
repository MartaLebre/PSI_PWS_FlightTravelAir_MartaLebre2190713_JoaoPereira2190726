<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

/**
 * CRUD Resource Controller for ActiveRecord Model User
 *
 * Code generated by WebLogicMVC Code Builder
 *
 * Date: 2021-05-26
 *
 * WL Code Builder developed by Sílvio Priem Mendes
 * *
 */
class FuncionarioController extends BaseAuthController
{
    /**
     * Returns index view with all records
     */
    public function index()
    {
        $this->authFilterByRole('administrador');

        $funcionarios = User::all(array('conditions' => array('role != ? AND role != ?', 'passageiro', 'administrador')));

        return View::make('funcionario.index', ['funcionarios' => $funcionarios]);
    }


    /**
     * Returns a view with a form to create a new record
     */
    public function create()
    {
        $this->authFilterByRole('administrador');

        return View::make('funcionario.create');
    }


    /**
     * Receives new record data through POST method and stores it in the DB table
     */
    public function store()
    {
        $this->authFilterByRole('administrador');

        //create new resource (activerecord/model) instance with data from POST
        //your form name fields must match the ones of the table fields
        $funcionario = new User(Post::getAll());

        if ($funcionario->is_valid()) {
            $funcionario->save();
            Redirect::toRoute('funcionario/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('funcionario/create', ['funcionario' => $funcionario]);
        }
    }


    /**
     * return a detailed view with record where PK = $id
     */
    public function show($id)
    {
        $this->authFilterByRole('administrador');

        $funcionario = User::find([$id]);

        if (is_null($funcionario)) {
            //TODO redirect to standard error page
        } else {
            return View::make('funcionario.show', ['funcionario' => $funcionario]);
        }
    }


    /**
     * return a editable form view with record where PK = $id
     */
    public function edit($id)
    {
        $this->authFilterByRole('administrador');

        $funcionario = User::find([$id]);

        if (is_null($funcionario)) {
            //TODO redirect to standard error page
        } else {
            return View::make('funcionario.edit', ['funcionario' => $funcionario]);
        }
    }


    /**
     * Receives record data through POST method and updates it in the DB table
     */
    public function update($id)
    {
        $this->authFilterByRole('administrador');

        //find resource (activerecord/model) instance where PK = $id
        //your form name fields must match the ones of the table fields
        $funcionario = User::find([$id]);
        $funcionario->update_attributes(Post::getAll());

        if ($funcionario->is_valid()) {
            $funcionario->save();
            Redirect::toRoute('funcionario/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('funcionario/edit', ['funcionario' => $funcionario]);
        }
    }


    /**
     * deletes the record where PK = $id
     */
    public function destroy($id)
    {
        $this->authFilterByRole('administrador');

        $funcionario = user::find([$id]);
        $funcionario->delete();
        Redirect::toRoute('funcionario/index');
    }
}