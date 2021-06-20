<?php
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use Dompdf\Dompdf;


class PassageiroController extends BaseAuthController
{
    public function index()
    {
        $this->authFilterByRole('passageiro');
        $user = User::all();
        return View::make('passageiro.index',['user'=>$user]);
    }

    public function historicopassagens()
    {
        $tickets = Ticket::all(array('conditions' => array('idutilizador = ?', \ArmoredCore\WebObjects\Session::get('APP_USER_ID'))));

       return View::make('passageiro.historicopassagens', ['$tickets' => $tickets]);
    }

//    public function historicodetalhes($id)
//    {
//        $tickets = Ticket::find([$id]);
//
//        return View::make('passageiro.historicodetalhes', ['$tickets' => $tickets]);
//    }

    public function historicopdf($id)
    {
        $tickets = Ticket::find([$id]);

        $pdf = new Dompdf();

        $pdf->loadHtml('<h1> '.$tickets->id.' </h1>
        <h1> '.$tickets->precofinal.' </h1>
        <h1> '.$tickets->datahoracompra.' </h1>
        <h1> '.$tickets->vooida->origem.' </h1>
        <?=  ?>
        <h1>'.$tickets->checkin.'</h1>
        <h1> '.$tickets->voovolta->origem.' </h1>
    

');

        $pdf->render();

        $pdf->stream(
            'Bilhete_voo_'.$tickets->id.'',
            array("Attachement" => true)
        );

//        $tickets = Ticket::find([$id]);
//
//        return View::make('passageiro.historicopdf', ['$tickets' => $tickets]);
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

    public function show()
    {
        $user = User::all(\ArmoredCore\WebObjects\Session::get('APP_USER_ID'));

        if (is_null($user)) {
            // redirect to standard error page
        } else {
            View::make('passageiro.show', ['user' => $user]);
        }
    }

    public function edit()
    {
        $user = User::all(\ArmoredCore\WebObjects\Session::get('APP_USER_ID'));

        if (is_null($user)){

        }else{
            View::make('passageiro.edit',['user'=>$user]);
        }
    }

    public function update($id){


        $user = User::find([$id]);

        $user -> update_attributes(Post::getAll());

        if($user->is_valid()){

            $user->save();

            Redirect::toRoute('passageiro/edit');

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