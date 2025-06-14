<?php 
namespace App\Models;

class User{


    private $file;

    // public function __construct(){
    //     $this->file = __DIR__ . '/../../../Storage/users.json';
    //     if(!file_exists($this->file)){
    //         file_put_contents($this->file, json_encode([]));
    //     }
    // }

    public function __construct(){
    $this->file = __DIR__ . '/../../../Storage/users.json';

    $dir = dirname($this->file);

    if (!is_dir($dir)) {
        mkdir($dir, 0777, true); // create directory if it doesn't exist
    }

    if (!file_exists($this->file)) {
        file_put_contents($this->file, json_encode([]));
    }
}


    public function getUsers(): array
    {
        return json_decode(file_get_contents($this->file), true) ?? [];
    }

    public function getAllUsers(){
        if(!file_exists($this->file)){
            return[];
        }

        $json = file_get_contents($this->file);
        return json_decode($json,true);
    }

    public function saveAllUsers($users){
        file_put_contents($this->file, json_encode($users, JSON_PRETTY_PRINT));
    }

    public function register($name,$email,$password){
        $users = $this->getAllUsers();

        if(isset($users[$email])){
            return['error' => 'Email already registered'];
        }

        $users[$email] = [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];
        // var_dump($users);

        $this->saveAllUsers($users);
        return ['success' => true];
    }

    public function login($email, $password){

        $users = $this->getAllUsers();

        if(!isset($users[$email])){
            return ['error' => 'User not found'];
        }

        if(!password_verify($password,$users[$email]['password'])){
            return ['error'=>'Invalid Password'];
        }

        return['success' => true];
    }
}