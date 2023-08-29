<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class AsetModel extends CI_Model {
    var $table = 'assets';
    var $column_order = array(null); //set column field database for datatable orderable
    var $column_search = array(
        "track_id", "cust_name"
    ); //set column field database for datatable searchable 
    var $order = array('wo_id' => 'DESC'); // default order 

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function asset_list($params, $returnRows = false) {
        $this->db->select('a.*, b.category, e.file_name');
        $this->db->from('assets a');
        $this->db->join('asset_categories b', 'a.category_id = b.category_id', 'left');
        $this->db->join('asset_files e', 'a.asset_featured = e.file_id', 'left');
        $this->_get_datatables_query($params);
        if(!$returnRows) {
            if(array_key_exists("limit", $params)) {
                $this->db->limit($params['limit'][0], $params['limit'][1]);
            }
            $query = $this->db->get();
            return $query->result();
        } else {
            $query = $this->db->get();
            return $query->num_rows();
        }
    }

    public function asset_update($params, $id) {    
        if (!$params) {
			return;
		}
        $cat = $params['category_id'];
        unset($params['category_id']);
        unset($params['file_name']);
        $this->db->trans_start();

        if(!empty($id)) {
            $this->db->where('asset_id', $id);
            $this->db->query($this->db->set($params)->get_compiled_update('products'));
            $this->db->where('asset_id', $id);
            $this->db->delete("asset_has_category");
        } else {
            $this->db->query($this->db->set($params)->get_compiled_insert('products'));
            $id = $this->db->insert_id();
        }

        foreach($cat as $ct) {
            $pars = array("category_id" => $ct, "asset_id" => $id);
            $this->db->query($this->db->set($pars)->get_compiled_insert('asset_has_category'));
        }

        $this->db->trans_complete();
        return $id;
    }

    public function asset_delete($params) {
        $this->db->where($params);
        $this->db->delete("products");
        if ($this->db->error()) {
            $result = 'Error! ['. $this->db->error()['message'].']';
        } else if (!$this->db->affected_rows()) {
            $result = 'Error! ID not found';
        } else {
            $result = 'Berhasil Menghapus';
        }
        return $result;
    }

    public function asset_detail($id) {
        $this->db->select('a.*, b.category_id, c.file_name');
        $this->db->from('products a');
        $this->db->join('(SELECT asset_id, JSON_ARRAYAGG(category_id) AS category_id FROM asset_has_category GROUP BY asset_id) b', 'a.asset_id = b.asset_id', 'left');
        $this->db->join('(SELECT asset_id, JSON_ARRAYAGG(file_name) AS file_name FROM asset_files GROUP BY asset_id) c', 'a.asset_id = c.asset_id', 'left');
        $this->db->where('a.asset_id', $id);
        return $this->db->get()->row_array();
        // return $this->db->get_where("products", ["asset_id" => $id])->row_array();
    }

    public function file_upload($params) {    
        if (!$params) {
			return;
		}
        return $this->db->insert("asset_files", $params);
    }

    public function file_update($params) {    
        if (!$params) {
			return;
		}
        $this->db->where('form_kode', $params['form_kode']);
        $this->db->update("asset_files", $params);

        $this->db->select('file_id');
        $this->db->from('asset_files');
        $this->db->where('asset_id', $params['asset_id']);
        $this->db->limit(1);
        $this->db->order_by('file_id', 'ASC');
        $featured = $this->db->get()->row()->file_id;
        $this->db->set('asset_featured', $featured);
        $this->db->where('asset_id', $params['asset_id']);
        return $this->db->update("products");
    }

    public function category_list($params, $returnArray = false) {
        $this->db->select('a.*');
        $this->db->from('asset_categories a');
        if($returnArray) {
            $query = $this->db->get();
            return $query->result();
            exit;
        }
        $this->_get_datatables_query($params);
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function category_update($params, $id, $add = 0) {    
        if (!$params) {
			return;
		}
        if(!empty($id) && empty($add)) {
            $this->db->where('category_id', $id);
            return $this->db->update("asset_categories", $params);
        } else {
            return $this->db->insert("asset_categories", $params);
        }
    }

    public function category_delete($params) {
        $this->db->where($params);
        $this->db->delete("asset_categories");
        if ($this->db->error()) {
            $result = 'Error! ['. $this->db->error()['message'].']';
        } else if (!$this->db->affected_rows()) {
            $result = 'Error! ID not found';
        } else {
            $result = 'Berhasil Menghapus';
        }
        return $result;
    }

    public function category_detail($id) {
        return $this->db->get_where("asset_categories", ["category_id" => $id])->row_array();
    }

    private function _get_datatables_query($params) {         
        $i = 0;     
        if(array_key_exists("where", $params)) {
            foreach($params['where'] as $where) {
                $this->db->where($where);
            }
        }
        foreach ($this->column_search as $item) {
            if(isset($_POST['search']) && $_POST['search']['value']) {                 
                if($i===0) {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else {
                    $this->db->or_like($item, $_POST['search']['value']);
                } 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if(array_key_exists("order", $params)) {
            foreach($params['order'] as $order) {
                $this->db->order_by($order[0], $order[1]);
            }
        }        
        if(isset($_POST['order'])) {            
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
    }

    function count_filtered($params) {
        $this->db->select('a.*,');
        $this->db->from('asset_categories a');
        // $this->db->order_by('category_id', 'DESC');
        $this->_get_datatables_query($params);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all($params) {
        $this->db->from($params['table']);
        return $this->db->count_all_results();
    }

    //select aset dengan id untuk ditampilkan didetail produk
    public function getIdProduct($id){
        //return $this->db->query("SELECT * FROM products WHERE asset_id = '$id'")->result();
        return $this->db->query("SELECT * FROM products LEFT JOIN asset_files ON products.asset_id = asset_files.asset_id
        WHERE products.asset_id = '$id'")->result();
    }

}
