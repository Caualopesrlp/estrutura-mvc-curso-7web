<?php
namespace App\Models;
use App\Core\Model;

class Usuario extends Model{
    public function getUserData(){

        return [
            'nome' => 'Cauã Lopes',
            'idade' => 19,
            'email' => 'caua.lopes@salvador.ba.gov.br'
        ];
    }

    public function testDb(){
        $sql = 'SELECT 5 + 5 AS teste';
        $resultado = $this->db->fetch($sql);
        return $resultado;
    }

    public function createUser($nome){
        $sql = "INSERT INTO usuarios (nome) VALUES (:name)";
        $params = ['name' => $nome];
        return $this->db->execute($sql, $params);
    }

    public function getUserById($id){
        
        $sql = 'SELECT * FROM usuarios WHERE id = :id';
        $params = ['id' => $id];
        return $this->db->fetch($sql, $params);
    }

    public function getAllUsers(){
        
        return $this->db->fetch('SELECT COUNT(*) as count FROM usuarios')['count'];
    }
}
?>