<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_m extends CI_Model {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public $table;

	public function create($data){
        return $this->db->insert($this->table,$data);
    }

    public function read(){
        return $this->db->get($this->table);
    }

    public function read_where($where){
        return $this->db->get_where($this->table,$where);
    }

    public function update($data,$where){
        return $this->db->update($this->table,$data,$where);
    }

    public function delete($where){
        return $this->db->delete($this->table,$where);
    }

}
