<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Email Sender
 */
class EmailSender{
    private $ci; // CI Instance

    public function __construct(){
        $this->ci = &get_instance();
        $this->ci->load->library('email');

        $this->ci->load->config('email');
        $this->ci->email->initialize($this->ci->config->item('email'));
    }

    public function send($from_,$from_name_,$to_,$subject_,$message_){
        // $this->ci->email->from('your@example.com', 'Carlos Levano');

        // $this->ci->email->to($destinatario);
        // // $this->ci->email->cc('another@another-example.com');
        // // $this->ci->email->bcc('them@their-example.com');

        // $this->ci->email->subject('Email Test');
        // $this->ci->email->message('Testing the email class from CodeIgniter using EmailSender. ');

        $this->ci->email->from($from_, $from_name_);
        $this->ci->email->to($to_);

        $this->ci->email->subject($subject_);
        $this->ci->email->message($message_);

        $this->ci->email->send();
    }
}
