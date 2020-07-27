<?php

class Chat extends CI_Controller{
    
    public function index()
    {
        $this->template->load('home/template','menu/chat');
    }
}
?>