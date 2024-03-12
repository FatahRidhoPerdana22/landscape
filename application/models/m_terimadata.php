<?php

class M_terimadata extends CI_Model {
    
    public function terima_data($sensor_suhu)
    {
       $this->db->insert('sensor',$sensor_suhu);
       return TRUE;
    }

}