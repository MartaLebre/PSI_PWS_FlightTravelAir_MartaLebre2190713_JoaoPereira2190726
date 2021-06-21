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
        $user = User::all(\ArmoredCore\WebObjects\Session::get('APP_USER_ID'));

       return View::make('passageiro.historicopassagens', ['$tickets' => $tickets, 'user' => $user]);
    }
    

    public function historicopdf($id)
    {
        $tickets = Ticket::find([$id]);

        $pdf = new Dompdf();


        $pdf->loadHtml('<h1>Bilhete nº' . $tickets->id . ' </h1>
        <p>_______________________________________________________________________________________</p>
        <br>
        <h3> Nome do passageiro: ' . $tickets->utilizador->nomecompleto . ' </h3>
        <p class="tagline">Preço: ' . $tickets->precofinal . ' € </p>
        <p>Data e hora de compra do bilhete: ' . $tickets->datahoracompra->format('Y-m-d H:i:s') . ' </p>
        <p>Viagem: ' . $tickets->vooida->origem . ' - ' . $tickets->vooida->destino . ' </p>
        <p>Data Origem: ' . $tickets->vooida->dataorigem->format('Y-m-d') . '</p>
        <p>Data Destino: ' . $tickets->vooida->datadestino->format('Y-m-d') . '</p>
        <p>Checkin: ' . $tickets->checkin . ' </p>
        <br>
        <br>
        <p>Nota: Se o checkin estiver assinalado como 1 significa que já tem o checkin realizado!</p>
        <br>
        <p>_______________________________________________________________________________________</p>');



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
