<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ResetPassword extends CI_Controller {
    public $data = [];
    public $utilities;
    public $AsetModel;

    public function __construct() {
        parent::__construct();
        $this->load->model('AsetModel');
    }

    public function index() {
        $this->data['listDataCategory'] = $this->category_list(true);
        $this->utilities->loadView('market/reset_password', $this->data, 'marketop');
    }

    public function category_list($returnArray = false) {
        $params = array(
            "table" => "product_categories",
            "order" => array(
                array('category_kode', 'ASC')
            )
        );
        $list = $this->AsetModel->category_list($params, $returnArray);
        $data = $this->createTree($list);
        // print "<pre>";
        // print_r($data);
        // print "</pre>";
        return $data;        
    }

    function createBranch(&$parents, $children) {
        $tree = array();
        foreach ($children as $child) {
            $child->children = [];
            if (isset($parents[$child->category_id])) {
                $child->children = $this->createBranch($parents, $parents[$child->category_id]);
            }
            $tree[] = $child;
        } 
        return $tree;
    }

    function createTree($flat, $root = 0) {
        $parents = array();
        foreach ($flat as $a) {
            $parents[$a->parent_id][] = $a;
        }
        // print_r($parents);exit;
        return $this->createBranch($parents, $parents[$root]);
    }
}
