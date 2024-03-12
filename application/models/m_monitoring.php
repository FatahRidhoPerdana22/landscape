<?php

class M_monitoring extends CI_Model {
    
    public function updateDataSensor($data) {
        // Lakukan update data pada database berdasarkan id atau kunci unik lainnya
        $this->db->where('id', 1); // Ganti 'id' dengan kolom kunci unik yang sesuai
        $this->db->update('tb_sensor', $data);
        
        // Periksa apakah proses update berhasil atau tidak
        if ($this->db->affected_rows() > 0) {
            return true; // Return true jika berhasil
        } else {
            return false; // Return false jika gagal
        }
    }
    
    /*public function insertDataSensor($data) {
        // Masukkan data ke database
        $this->db->insert('tb_sensor', $data);

        // Periksa apakah proses insert berhasil atau tidak
        if ($this->db->affected_rows() > 0) {
            return true; // Return true jika berhasil
        } else {
            return false; // Return false jika gagal
        }

        $this->db->select('*');
        $this->db->from('tb_sensor');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();

        return $query->row();
    }*/
    
    
}