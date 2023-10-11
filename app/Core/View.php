<?php 

class View{
    public static function load($viewname,$data=[]){

        $self=new View();
        $viewname=$self->perpare_path_url($viewname);

        $file=VIEWS.$viewname;

        if(file_exists($file)){
            extract($data);
        
            ob_start();
            require($file);
            ob_end_flush();
        }else{
            echo "View " . $file . " not found";
        }

    }

    public function perpare_path_url($viewname){
        $viewname=explode(".",$viewname);
        $final_viewname='';

        $cnt=0;
        foreach ($viewname as $key) {
            if(++$cnt == count($viewname)){
                $final_viewname.=$key . ".php";
            }else{
                $final_viewname.=$key. "/";
            }
        }

        return $final_viewname;
    }
}