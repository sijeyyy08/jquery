<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Information_model extends Model {
	
    public function read() {

        return $this->db->table('cjwa_users')->get_all();
    }

    public function create($cjwa_last_name, $cjwa_first_name, $cjwa_email, $cjwa_gender, $cjwa_address) {
        $data = array(
            'cjwa_last_name' => $cjwa_last_name,
            'cjwa_first_name' => $cjwa_first_name,
            'cjwa_email' => $cjwa_email,
            'cjwa_gender' => $cjwa_gender,
            'cjwa_address' => $cjwa_address
        );

        return $this->db->table('cjwa_users')->insert($data);

    }

    public function get_one($id) {
        return $this->db->table('cjwa_users')->where('id', $id)->get();
    }

    public function update($cjwa_last_name, $cjwa_first_name, $cjwa_email, $cjwa_gender, $cjwa_address, $id) {
        $data = array(
            'cjwa_last_name' => $cjwa_last_name,
            'cjwa_first_name' => $cjwa_first_name,
            'cjwa_email' => $cjwa_email,
            'cjwa_gender' => $cjwa_gender,
            'cjwa_address' => $cjwa_address
        );

        return $this->db->table('cjwa_users')->where('id', $id)->update($data);
    }

    public function delete($id) {
        return $this->db->table('cjwa_users')->where('id', $id)->delete();
    }
}
?>
