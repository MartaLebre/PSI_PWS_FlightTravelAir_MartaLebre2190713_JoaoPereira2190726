<?php
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Debug;
use ArmoredCore\WebObjects\Post;

class SearchController extends BaseAuthController
{
    public function index()
    {
        $this->authFilterByRole('passageiro');

        return View::make('search.index');
    }

    public function show()
    {
        $this->authFilterByRole('passageiro');

        $origem = $_POST['origem'];
        $destino = $_POST['destino'];
        $dataorigem = $_POST['dataorigem'];
        $datadestino = $_POST['datadestino'];

        $flights = Flight::all(array('conditions' => array('origem = ? AND destino = ? OR dataorigem = ? OR datadestino = ?', $origem,$destino,$dataorigem,$datadestino)));
        $flightsvolta = Flight::all(array('conditions' => array(' origem = ? AND destino = ? ', $origem,$destino)));

        return View::make('search.show' ,['flights' => $flights, 'flightsvolta' => $flightsvolta] );
    }

    public function detalhes($id)
    {
        $this->authFilterByRole('passageiro');

        $flights = Flight::find([$id]);

        return View::make('search.detalhes' ,['flights' => $flights]);
    }

    public function comprarticket($id)
    {
        $this->authFilterByRole('passageiro');

        $flights = Flight::find([$id]);

        return View::make('search.comprarticket' ,['flights' => $flights]);
    }

    public function pagamentoticket($id)
    {
        $this->authFilterByRole('passageiro');

        $email = Post::get('email');

        $users = User::find(array('conditions' => array(' email = ?', $email,)));;

        $flights = Flight::find([$id]);

        return View::make('search.pagamentoticket' ,['flights' => $flights, 'users', $users]);
    }
}