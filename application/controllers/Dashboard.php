<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public $utilities;
    public $ion_auth;
    public function index() {
        if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
        $this->utilities->loadView('dashboard', array());
    }
}
