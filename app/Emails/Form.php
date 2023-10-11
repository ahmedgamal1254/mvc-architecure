<?php 

class Form extends Email{
    protected $from="engahmedgamal086@gmail.com";
    protected $to="ahmgamal372@gmail.com";
    protected $title="ارسال ايميل";

    protected $body;

    public function __construct($params=[]){
        $this->body=$this->array_data($params);
    }
}