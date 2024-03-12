<?php

class M_tanaman extends CI_Model {
    
    public function tampil_data()
    {
       return $this->db->get('tb_tanaman');
    }

    public function getDataTanaman()
    {
        return $this->db->count_all('tb_tanaman');
    }

    public function input_data($data)
    {
        $this->db->insert('tb_tanaman', $data);
    }

    public function hapus_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function edit_data($where, $table)
    {
       return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    
    public function detail_data($id)
    {
        $query = $this->db->get_where('tb_tanaman', 
            array('id' => $id))->row();
        return $query;
    }
    /*public function getGambarById($id)
    {
        $this->db->select('gambar');
        $this->db->where('id', $id);
        $query = $this->db->get('tb_tanaman');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->gambar;
        }

        return null;
    }*/


    /*public function get_keyword($keyword)
    {
        $this->db->select('*');
        $this->db->from('tb_tanaman');
        $this->db->like('nama_tanaman', $keyword);
        return $this->db->get()->result();
    }

    /*public function kirim_data($id)
    {
        $query = $this->db->get_where('tb_tanaman', 
            array('id' => $id))->row();
        return $query;
    }*/
}