<?php 

class ContactController{

    public function index(){
        echo "Contact Page";
    }

    public function store(){
        echo "<pre>";
        print_r($_SERVER);
        echo "<pre>";
        echo "Stored";
    }
}