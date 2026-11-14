<?php
class ContactController extends Controller {
    public function index(): void
     {
        $this->view('contact', [
            'title' => 'Կապ'
        ]);
     }
     public function send(): void
     {
         header('Location: /contact?sent=1');
        exit;
     }
}