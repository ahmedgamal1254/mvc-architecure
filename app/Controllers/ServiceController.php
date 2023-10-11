<?php

class ServiceController{

    public function index(){
        echo "Service Page";
    }

    public function show($id,$teacher_id){
        echo "Service single " . $id  . " and " . $teacher_id;
    }
}