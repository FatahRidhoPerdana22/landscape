<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('m_monitoring'); // Memastikan model m_tanaman sudah di-load
		$this->load->model('m_tanaman');
		$this->load->model('m_terimadata');
    }

	public function index()
	{
		$data['total_tanaman'] = $this->m_tanaman->getDataTanaman();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		//$this->load->view('v_monitoring'); //
		$this->load->view('v_monitoring', $data);
		$this->load->view('templates/footer');
		//echo json_encode($data);
	}

	public function getDataSensor()
	{
		$this->db->order_by('id', 'DESC');
    	$sensor_data = $this->db->get('tb_sensor', 1)->row();
    	echo json_encode($sensor_data);
	}

	public function receiveDataFromESP()
	{
    // Ambil data kelembaban dan pH dari POST request
    	$ph = $this->input->post('ph');
    	$lembab = $this->input->post('lembab');

    // Validasi data
    	if ($ph != null && $lembab != null) {
        // Load model yang diperlukan
       		$this->load->model('m_monitoring');

        // Simpan data ke database
        	$data = array(
            'sensor_ph' => $ph, // Tambahkan timestamp jika diperlukan
            'sensor_lembab' => $lembab,
			'timestamp' => date('Y-m-d H:i:s')
        );

       	 $this->m_monitoring->updateDataSensor($data); // Panggil method insertDataSensor dari model

        // Beri respons ke ESP bahwa data berhasil diterima
        	echo "Data berhasil diterima";
    	} else {
        // Jika ada data yang hilang, beri respons error ke ESP
        	echo "Data tidak lengkap";
    	}
	}


	/*public function valueph()
	{
		$valueSensor = $this->m_monitoring->getDataSensor();
		$data =  array('data_sensor' => $valueSensor->sensor_ph);

		$this->load->view('v_monitoring', $data);
	}

	public function valuelembab()
	{
		$valueSensor = $this->m_monitoring->getDataSensor();
		$data =  array('data_sensor' => $valueSensor);

		$this->load->view('cekLembab', $data);
	}*/
}
