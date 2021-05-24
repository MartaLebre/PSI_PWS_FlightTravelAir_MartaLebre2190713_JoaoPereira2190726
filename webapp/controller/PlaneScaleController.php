<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

/**
 * CRUD Resource Controller for ActiveRecord Model PlaneScale
 *
 * Code generated by WebLogicMVC Code Builder
 *
 * Date: 2021-05-24
 *
 * WL Code Builder developed by Sílvio Priem Mendes
 * *
 */

class PlaneScaleController extends BaseController implements ResourceControllerInterface
{
    /**
     * Returns index view with all records
     */
    public function index()
    {
        $planescales = PlaneScale::all();
        return View::make('planescale.index', ['planescales' => $planescales]);
    }


    /**
     * Returns a view with a form to create a new record
     */
    public function create()
    {
        return View::make('planescale.create');
    }


    /**
     * Receives new record data through POST method and stores it in the DB table
     */
    public function store()
    {
        //create new resource (activerecord/model) instance with data from POST
        //your form name fields must match the ones of the table fields
        $planescale = new PlaneScale(Post::getAll());

        if($planescale->is_valid()){
            $planescale->save();
            Redirect::toRoute('planescale/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('planescale/create', ['planescale' => $planescale]);
        }
    }


    /**
     * return a detailed view with record where PK = $id
     */
    public function show($id)
    {
        $planescale = PlaneScale::find([$id]);

        if (is_null($planescale)) {
            //TODO redirect to standard error page
        } else {
            return View::make('planescale.show', ['planescale' => $planescale]);
        }
    }


    /**
     * return a editable form view with record where PK = $id
     */
    public function edit($id)
    {
        $planescale = PlaneScale::find([$id]);

        if (is_null($planescale)) {
            //TODO redirect to standard error page
        } else {
            return View::make('planescale.edit', ['planescale' => $planescale]);
        }
    }


    /**
     * Receives record data through POST method and updates it in the DB table
     */
    public function update($id)
    {
        //find resource (activerecord/model) instance where PK = $id
        //your form name fields must match the ones of the table fields
        $planescale = PlaneScale::find([$id]);
        $planescale->update_attributes(Post::getAll());

        if($planescale->is_valid()){
            $planescale->save();
            Redirect::toRoute('planescale/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('planescale/edit', ['planescale' => $planescale]);
        }
    }


    /**
     * deletes the record where PK = $id
     */
    public function destroy($id)
    {
        $planescale = planescale::find([$id]);
        $planescale->delete();
        Redirect::toRoute('planescale/index');
    }
}