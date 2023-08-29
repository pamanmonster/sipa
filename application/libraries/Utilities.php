<?php

class Utilities {

    protected $CI;

    // We'll use a constructor, as you can't directly call a function
    // from a property definition.
    public function __construct() {
        // Assign the CodeIgniter super-object
        $this->CI = &get_instance();
    }

    /**
     * Load View dengan Parameter
     *
     * @author Said R <saidrr47@gmail.com>
     * @param String $view nama View yang akan di load
     * @param Array $data data yang akan dirender di view. Berupa Array.
     * @param String $template Template yang digunakan merender View. Template harus memiliki head, body dan footer.
     * @param bool $useParser mo pake parser apa enggak.
     * @return void
     */
    public function loadView($view, $data, $template = 'appstack') {
        $data['view'] = $view;
        $this->CI->load->view($template . "/header.php");
        if ($template == 'appstack') {
            $this->CI->load->model("MenuModel");
            $list = $this->CI->MenuModel->adminMenu_list();
            $data['menus'] = $this->createTree($list, 0, 'folder_id');
            // print_r($data);exit;
        }
        $this->CI->load->view($template . "/body.php", $data);
        $this->CI->load->view($view, $data);
        $this->CI->load->view($template . "/footer.php");
    }

    function createBranch(&$parents, $children, $childId = 'id') {
        $tree = array();
        foreach ($children as $child) {
            // $child->children = [];
            if (isset($parents[$child->{$childId}])) {
                $child->children = $this->createBranch($parents, $parents[$child->{$childId}], $childId);
            }
            $tree[] = $child;
        }
        return $tree;
    }

    function createTree($flat, $root = 0, $parentId = 'parent_id', $childId = 'id') {
        $parents = array();
        foreach ($flat as $a) {
            $parents[$a->{$parentId}][] = $a;
        }
        // print_r($parents);exit;
        return $this->createBranch($parents, $parents[$root], $childId);
    }

    function createTreeView($flat, $checked) {
        $html = "";
        foreach ($flat as $a) {
            $check = "";
            if(isset($a->children) && !empty($a->children)) {
                $html .= "<div class='text-secondary'>" . $a->category . "</div>";
                $html .= $this->createTreeView($a->children, $checked);
            } else {
                if(in_array($a->category_id, $checked)) $check = "checked";
                $html .="<label class='form-check'>
                    <input class='form-check-input' type='checkbox' name='category_id[]' value='" . $a->category_id. "'". $check . ">
                    <span class='form-check-label'>" . $a->category ."</span>
                </label>";
            }
        }
        return $html;
    }
}
