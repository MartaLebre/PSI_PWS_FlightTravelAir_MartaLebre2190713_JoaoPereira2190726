<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

/**
 * CRUD Resource Controller for ActiveRecord Model Plane
 *
 * Code generated by WebLogicMVC Code Builder
 *
 * Date: 2021-05-24
 *
 * WL Code Builder developed by Sílvio Priem Mendes
 * *
 */

class PlaneController extends BaseController implements ResourceControllerInterface
{
    /**
     * Returns index view with all records
     */
    public function index()
    {
        $plane = Plane::all();
        return View::make('plane.index', ['plane' => $plane]);
    }


    /**
     * Returns a view with a form to create a new record
     */
    public function create()
    {
        return View::make('plane.create');
    }


    /**
     * Receives new record data through POST method and stores it in the DB table
     */
    public function store()
    {
        //create new resource (activerecord/model) instance with data from POST
        //your form name fields must match the ones of the table fields
        $plane = new Plane(Post::getAll());

        if($plane->is_valid()){
            $plane->save();
            Redirect::toRoute('plane/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('plane/create', ['plane' => $plane]);
        }
    }


    /**
     * return a detailed view with record where PK = $id
     */
    public function show($id)
    {
        $plane = Plane::find([$id]);

        if (is_null($plane)) {
            //TODO redirect to standard error page
        } else {
            return View::make('plane.show', ['plane' => $plane]);
        }
    }


    /**
     * return a editable form view with record where PK = $id
     */
    public function edit($id)
    {
        $plane = Plane::find([$id]);

        if (is_null($plane)) {
            //TODO redirect to standard error page
        } else {
            return View::make('plane.edit', ['plane' => $plane]);
        }
    }


    /**
     * Receives record data through POST method and updates it in the DB table
     */
    public function update($id)
    {
        //find resource (activerecord/model) instance where PK = $id
        //your form name fields must match the ones of the table fields
        $plane = Plane::find([$id]);
        $plane->update_attributes(Post::getAll());

        if($plane->is_valid()){
            $plane->save();
            Redirect::toRoute('plane/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('plane/edit', ['plane' => $plane]);
        }
    }


    /**
     * deletes the record where PK = $id
     */
    public function destroy($id)
    {
        $plane = plane::find([$id]);
        $plane->delete();
        Redirect::toRoute('plane/index');
    }
}