<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

/**
 * CRUD Resource Controller for ActiveRecord Model Aeroport
 *
 * Code generated by WebLogicMVC Code Builder
 *
 * Date: 2021-05-24
 *
 * WL Code Builder developed by Sílvio Priem Mendes
 * *
 */

class AeroportController extends BaseController implements ResourceControllerInterface
{
    /**
     * Returns index view with all records
     */
    public function index()
    {
        $aeroports = Aeroport::all();
        return View::make('aeroport.index', ['aeroports' => $aeroports]);
    }


    /**
     * Returns a view with a form to create a new record
     */
    public function create()
    {
        return View::make('aeroport.create');
    }


    /**
     * Receives new record data through POST method and stores it in the DB table
     */
    public function store()
    {
        //create new resource (activerecord/model) instance with data from POST
        //your form name fields must match the ones of the table fields
        $aeroport = new Aeroport(Post::getAll());

        if($aeroport->is_valid()){
            $aeroport->save();
            Redirect::toRoute('aeroport/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('aeroport/create', ['aeroport' => $aeroport]);
        }
    }


    /**
     * return a detailed view with record where PK = $id
     */
    public function show($id)
    {
        $aeroport = Aeroport::find([$id]);

        if (is_null($aeroport)) {
            //TODO redirect to standard error page
        } else {
            return View::make('aeroport.show', ['aeroport' => $aeroport]);
        }
    }


    /**
     * return a editable form view with record where PK = $id
     */
    public function edit($id)
    {
        $aeroport = Aeroport::find([$id]);

        if (is_null($aeroport)) {
            //TODO redirect to standard error page
        } else {
            return View::make('aeroport.edit', ['aeroport' => $aeroport]);
        }
    }


    /**
     * Receives record data through POST method and updates it in the DB table
     */
    public function update($id)
    {
        //find resource (activerecord/model) instance where PK = $id
        //your form name fields must match the ones of the table fields
        $aeroport = Aeroport::find([$id]);
        $aeroport->update_attributes(Post::getAll());

        if($aeroport->is_valid()){
            $aeroport->save();
            Redirect::toRoute('aeroport/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('aeroport/edit', ['aeroport' => $aeroport]);
        }
    }


    /**
     * deletes the record where PK = $id
     */
    public function destroy($id)
    {
        $aeroport = aeroport::find([$id]);
        $aeroport->delete();
        Redirect::toRoute('aeroport/index');
    }
}