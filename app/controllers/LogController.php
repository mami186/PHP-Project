<?php
    require_once __DIR__ . '/../models/LogModel.php';

    class LogController { 

    
        public function index(){
            require_once __DIR__ . '/../views/log.php';
        }

    public function get_all_logs (){
    }
    public function create_log (){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_name = $_POST['user_name'];
            $bg_dep = $_POST['bg_dep'];
            $bg_amount = $_POST['bg_amount'];
            $bg_catagory = $_POST['bg_catagory'];
        
    }        
        $log= new LogModel();
        $log->create_log($user_name,$bg_dep,$bg_amount,$bg_catagory);
        return "you have successfully added a log";
    }

    public function delete_log (){


    }

    public function update_log (){
    }


}
