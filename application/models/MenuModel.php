<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class MenuModel extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function adminMenu_list() {
        return $this->db->get("menus")->result_object();
    }

}
