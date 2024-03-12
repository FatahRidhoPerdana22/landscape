<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TerimaData extends CI_Controller {

	public function sensor()
	{
        $this->load->model('m_terimadata');
		if(isset($_GET['suhu'])){
            echo $suhu;
            $suhu = $this->load->input->get('data');
            $sensor_suhu = array('sensor_suhu'-> $suhu);
        }else{
            echo "Belum Terkoneksi";
        }
	}

    public function tampil(){
        $this->load->model('m_terimadata');
        $data['sensor'] = $this->m__terimadata->terima_data();
        $this->load->view('v_monitoring', $data);
    }
}