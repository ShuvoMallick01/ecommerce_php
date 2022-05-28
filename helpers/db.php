<?php

class DbController{
    private $DB_HOST='localhost', $DB_USER='root', $DB_PASS='', $DB_NAME='ecommerce';
    private $connection;

    public function __construct(){
        $this->connection= mysqli_connect($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_NAME);
        if(!$this->connection){
            throw new Exception('Database not connected');
        }
    }

    public function register($name, $email, $password){
        $hashPassword= password_hash($password, PASSWORD_BCRYPT);
        $query="INSERT INTO USERS VALUES(DEFAULT, '$name', '$email', '$hashPassword')";
        if(mysqli_query($this->connection, $query)){
            return "User Created Successfully";
        }
    }

    public function login($email, $password) {
        $query = "SELECT * FROM USERS WHERE email= '$email'";
        $response = mysqli_query($this->connection, $query);
        $user = mysqli_fetch_assoc($response);

        if ($user) {
            $verifyPassword = password_verify($password, $user['password']);
            if ($verifyPassword) {
                return [
                    'name'  => $user['name'],
                    'email' => $user['email'],
                    'id'    => $user['id'],
                ];
            } else {
                throw new Exception('Invalid Password');
            }
        } else {
            throw new Exception('Not Found with given email address');
        }
    }

    public function getCurrentUser($id){
        $query="SELECT * FROM users WHERE id='$id'";
        $response= mysqli_query($this->connection, $query);
        
        if($user= mysqli_fetch_assoc($response)){
            return[
                'name'=> $user['name'],
                'email' => $user['email'],
                'id' => $user['id'],
            ];
        } else{
            throw new Exception('User Not Found!', 404);
        }
    }

    public function getProducts(){
        $products=[];
        $query= "SELECT * FROM products";
        $response= mysqli_query($this->connection, $query);
        while($product=mysqli_fetch_assoc($response)){
            array_push($products, $product);
        }

        return$products;
    }


   

} 