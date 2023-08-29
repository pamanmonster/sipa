<?php defined('BASEPATH') or exit('No direct script access allowed');

class AsetManagement extends CI_Controller {
    public $data = [];
    public $utilities;
    public $AsetModel;
    public $input;
    public $form_validation;
    public $session;
    public $upload;

    public function __construct() {
        parent::__construct();
        $this->load->model('AsetModel');
    }

    public function index() {
        $this->data['meta'] = [
            'title' => 'Aset',
            'subtitle' => 'List Aset'
        ];
        $this->utilities->loadView('aset/asset_list', $this->data);
    }

    public function asset_list() {
        $params = array(
            "table" => "assets",
            "order" => array(
                array('a.asset_id', 'DESC')
            ),
            "limit" => array($_POST['length'], $_POST['start'])
        );
        $list = $this->AsetModel->asset_list($params);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $li) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $li->file_name;
            $row[] = $li->asset_kode;
            $row[] = $li->asset_name;
            $row[] = $li->category;
            $row[] = $li->asset_nup;
            $row[] = $li->asset_merk;
            $row[] = $li->asset_ac_value;
            $row[] = $li->asset_condition;
            $row[] = $li->asset_dep_value;
            $row[] = $li->asset_id;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->AsetModel->count_all($params),
            "recordsFiltered" => $this->AsetModel->asset_list($params, true),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function asset_edit($id = 0) {
        $this->load->library('form_validation');
        // Buat Form Kode untuk upload File

        $this->data['form_kode'] = md5(time());

        $title = "";
        if (!empty($id)) {
            $title = "Edit ";
        } else {
            $title = "Tambah ";
        }
        $this->data['meta'] = [
            'title' => $title . 'Aset',
            'subtitle' => 'ke Daftar Aset'
        ];

        // Inisialisasi Data
        $this->data['listDataCategory'] = $this->category_list(true);
        // print_r($this->data['listDataCategory']);exit;
        $this->data['listData'] = $this->asset_field();
        if (!empty($id)) {
            $data = $this->AsetModel->asset_detail($id);
            $data['file_name'] = json_decode($data['file_name'] ?? "[]", true);
            $this->data['listData'] = $data;
        }

        if ($this->input->method() === 'post') {

            $rules = $this->asset_rules();
            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run() == FALSE) {
                return $this->utilities->loadView('aset/asset_edit', $this->data);
            }

            $defParams = $this->data['listData'];
            // print_r($defParams);exit;
            $params = [];
            foreach ($defParams as $key => $par) {
                $params[$key] = (null !== $this->input->post($key) && !empty($this->input->post($key))) ? $this->input->post($key) : $par;
            }
            // print_r($params);exit;
            $id = $this->AsetModel->asset_update($params, $id);

            if($id) {
                $params = [
                    "form_kode" => $this->input->post('form_kode'),
                    "asset_id" => $id
                ];
                $this->AsetModel->file_update($params);
                $this->session->set_flashdata("flash", "Berhasil Menyimpan");
                redirect(base_url(''));
            }
        }
        $this->utilities->loadView('aset/asset_edit', $this->data);
    }

    public function asset_detail($id) {
        return $this->AsetModel->asset_detail($id);
    }

    private function asset_field() {
        return [
            "category_id" => "",
            "asset_kode" => "",
            "asset_name" => "",
            "asset_description" => "",
            "asset_nup" => "",
            "asset_merk" => "",
            "asset_ac_date" => "",
            "asset_ac_value" => "",
            "asset_dep_value" => "",
            "asset_condition" => "",
            "asset_book_value" => "",
            "asset_lifespan" => "",
            "file_name" => []
        ];
    }

    private function asset_rules() {
        return [
            [
                'field' => 'asset_name',
                'label' => 'Nama Aset',
                'rules' => 'required|min_length[3]'
            ],
        ];
    }

    public function asset_delete() {
        $params = [
            "asset_id" => $this->input->post('asset_id')
        ];
        $msg = $this->AsetModel->asset_delete($params);
        echo json_encode(array(
            "success" => true,
            "msg" => $msg
        ));
    }

    public function asset_promo($id = 0) {
        $this->load->library('form_validation');
        // Buat Form Kode untuk upload File
        $this->data['meta'] = [
            'title' => 'Tambah Promo',
            'subtitle' => 'ke Daftar Aset'
        ];

        // Inisialisasi Data
        $defParams = [
            "promo_discount" => "",
            "promo_price" => "",
            "promo_start" => "",
            "promo_end" => "",
            "active" => 1,
            "promo_desc" => "",
        ];

        $data = $this->AsetModel->asset_detail($id);
        $this->data['listData'] = array_merge($defParams, $data);

        if ($this->input->method() === 'post') {

            $rules = $this->asset_rules();
            // $this->form_validation->set_rules($rules);

            // if ($this->form_validation->run() == FALSE) {
            //     return $this->utilities->loadView('aset/promo_edit', $this->data);
            // }

            $params = [];
            foreach ($defParams as $key => $par) {
                $params[$key] = (null !== $this->input->post($key) && !empty($this->input->post($key))) ? $this->input->post($key) : $par;
            }
            $params['asset_id'] = $id;
            $id = $this->AsetModel->promo_update($params);
            $this->session->set_flashdata("flash", "Berhasil Menyimpan");
            redirect(base_url('asetManagement'));
        }
        $this->utilities->loadView('aset/asset_promo', $this->data);
    }


    public function file_upload() {
        $config['upload_path'] = dirname(__DIR__, 2) . '/upload/photo';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = TRUE; //enkripsi file name upload
        // call library upload
        $this->load->library('upload', $config);
        try {
            if ($this->upload->do_upload("files")) {
                $data = $this->upload->data();
                // print_r($data);exit;
                $params = array(
                    "form_kode" => $this->input->post("form_kode"),
                    "file_name" => $data['file_name'],
                    "file_size" => $data['file_size'],
                    "file_type" => $data['file_type'],
                    "file_ext" => $data['file_ext']
                );
                $insert = $this->AsetModel->file_upload($params);
                if($insert) {
                    echo json_encode(array("success" => true, "result" => $data));
                }
            } else {
                throw new Exception($this->upload->display_errors());
            }
        } catch (Exception $e) {
            echo json_encode(array("success" => false, "msg" => $e->getMessage()));
        }
    }

    public function category() {
        $this->data['meta'] = [
            'title' => 'Kategori Aset',
            'subtitle' => 'List Kategori Aset'
        ];
        $this->utilities->loadView('aset/category_list', $this->data);
    }

    private function category_field() {
        return [
            "category" => "",
            "category_kode" => "",
            "category_description" => "",
            "dep_calc_interval" => "",
            "active" => 1
        ];
    }

    private function category_rules() {
        return [
            [
                'field' => 'category',
                'label' => 'Kategori',
                'rules' => 'required|min_length[3]'
            ],
            [
                'field' => 'category_kode',
                'label' => 'Kode',
                'rules' => 'required|min_length[1]'
            ],
        ];
    }

    public function category_list($returnArray = false, $nested = false) {
        $params = array(
            "table" => "asset_categories",
            "order" => array(
                array('category_kode', 'ASC')
            )
        );
        $list = $this->AsetModel->category_list($params, $returnArray);
        $data = array();
        $no = $returnArray ? 0 : $_POST['start'];
        foreach ($list as $li) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $li->category_kode;
            $row[] = $li->category;
            $row[] = $li->dep_calc_interval;
            $row[] = $li->active;
            $row[] = $li->category_id;
            $data[] = $row;
        }
        if ($returnArray) {
            if ($nested) {
                $data = $this->utilities->createTree($list, 0, 'parent_id', 'category_id');
            }
            return $data;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->AsetModel->count_all($params),
            "recordsFiltered" => $this->AsetModel->count_filtered($params),
            "data" => $data,
        );
        echo json_encode($output);
    }


    public function category_edit($id = 0, $add = 0) {
        $title = "";
        if (!empty($add)) {
            $title = "Tambah Sub ";
        } else if (!empty($id)) {
            $title = "Edit ";
        } else {
            $title = "Tambah ";
        }
        $this->data['meta'] = [
            'title' => $title . 'Kategori Aset',
            'subtitle' => 'ke Daftar Kategori'
        ];

        // Inisialisasi Data
        $this->data['category'] = $this->category_field();
        if (!empty($id)) {
            $data = $this->AsetModel->category_detail($id);
            if (!empty($add)) {
                $this->data['category']['category_kode'] = $data['category_kode'];
                $this->data['meta']['subtitle'] = "ke " . $data['category'];
            } else {
                $this->data['category'] = $data;
            }
        }

        $this->load->library('form_validation');
        if ($this->input->method() === 'post') {

            $rules = $this->category_rules();
            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run() == FALSE) {
                return $this->utilities->loadView('aset/category_edit', $this->data);
            }

            $defParams = $this->data['category'];
            $params = [];
            foreach ($defParams as $key => $par) {
                $params[$key] = (null !== $this->input->post($key) && !empty($this->input->post($key))) ? $this->input->post($key) : $par;
            }
            $update = $this->AsetModel->category_update($params, $id, $add);

            if ($update) {
                $this->session->set_flashdata("flash", "Berhasil Menyimpan");
                redirect(base_url('asetManagement/category'));
            }
        }
        $this->utilities->loadView('aset/category_edit', $this->data);
    }

    public function category_detail($id) {
        return $this->AsetModel->category_detail($id);
    }

    public function category_delete() {
        $params = [
            "category_id" => $this->input->post('category_id')
        ];
        $msg = $this->AsetModel->category_delete($params);
        echo json_encode(array(
            "success" => true,
            "msg" => $msg
        ));
    }


}
