<?php

class DBController{
    private $host = 'localhost';
    private $db = 'babybundles_database';
    private $user= 'root';
    private $pass = '';
    // private $attr = "mysql:host=$host;dbname=$db";
    // private $table = 'product_table';
    public $conn;

    // constructor
    function __construct(){
        $attr = "mysql:host=".$this->host.";dbname=".$this->db;
        $opts =
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->conn = new PDO($attr, $this->user, $this->pass, $opts);
    }

    // Insert
    function insertQuery($query){
        $result = $this->conn->query($query);
        return $result;
    }

    // Select user
    function selectUser($query){
        $result = $this->conn->query($query);
        $row = $result->fetch();
        return $row;
    }

    // Select single product
    function selectSingleProduct($query){
        $result = $this->conn->query($query);
        $row = $result->fetch();
        return $row;
    }

    // Select all product
    function selectProduct($query){
        $result = $this->conn->query($query);
        $row = $result->fetchAll();
        return $row;
    }

    // Update shopping cart
    function updateCart($query){
        $result = $this->conn->query($query);
        return $result;
    }

    // count num of rows
    function numRows($query){
        $result = $this->conn->query($query);
        return $result->rowCount();
    }

    // limit text (title)
    function limit_text($text, $limit) {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos   = array_keys($words);
            $text  = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }

    // sanitise()
    function sanitise($string){
        $string = htmlentities($string);
        return $string;
    }

}
?>