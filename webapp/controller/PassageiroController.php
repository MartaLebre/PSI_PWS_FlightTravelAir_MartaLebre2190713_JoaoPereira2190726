<?php
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;


class PassageiroController extends BaseAuthController
{
    public function index()
    {
        $this->authFilterByRole('passageiro');
        $user = User::all();
        return View::make('passageiro.index',['user'=>$user]);
    }

    public function create()
    {
        View::make('passageiro.create');
    }

    public function store()
    {
        $user = new User(Post::getAll());

        if($user-> is_valid()){

            $user -> save();
            Redirect::toRoute('passageiro/index');
        }else{

            Redirect::flashToRoute('passageiro/create',['user'=>$user]);
        }
    }

    public function show($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            // redirect to standard error page
        } else {
            View::make('passageiro.show', ['user' => $user]);
        }
    }

    public function edit($id)
    {
        $user = user::find($id);

        if (is_null($user)){

        }else{
            View::make('passageiro.edit',['user'=>$user]);
        }
    }

    public function update($id){

        $user = User::find($id);

        $user -> update_attributes(Post::getAll());

        if($user->is_valid()){

            $user->save();
            Redirect::toRoute('passageiro/index');

        }else{

            Redirect::flashToRoute('passageiro/edit',['user'=>$user], $id);
        }
    }

    public function destroy($id){

        $user = User::find($id);
        $user->delete();
        Redirect::toRoute('passageiro/index');
    }

}