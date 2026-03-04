<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\Usuario;

class HomeController extends Controller {
    public function index(){
        $usuario = new Usuario();
        $data = $usuario->getUserData();

        $database = new Database();

        $consulta = $database->query('SELECT 1+1 AS teste');
        dd($consulta->fetch());

        $this->view('home/index', $data);
    }

    public function contact(){
        $this->view('home/contact');
    }
}
?>