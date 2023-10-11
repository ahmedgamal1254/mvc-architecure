<?php 
class PostController{
    
    public function index(){
        // echo "<pre>";
        // print_r(User::all());
        // echo "<pre>";

        // echo "<pre>";
        // print_r(Teacher::all());
        // echo "<pre>";

        // $data["title"]="Post";
        // View::load("admin.index",$data);

        // $post=new Form([
        //     "name" => "ahmedgamal",
        //     "phone" => "010911536978"
        // ]);
        
        // $post->SendEmail();

        echo "ahmed";
    }

    public function show($id,$teacher_id){
        echo "Post Page " . $id . " and " . $teacher_id;
    }
}