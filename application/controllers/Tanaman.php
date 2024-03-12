<?php

class Tanaman extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('m_tanaman'); // Memastikan model m_tanaman sudah di-load
    }

	public function index()
	{
		$data['tanaman'] = $this-> m_tanaman ->tampil_data()->result();

        $this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('v_tanaman', $data);
		$this->load->view('templates/footer');
	}
	
	public function tambahAksi()
	{
		$config['upload_path']		= './assets/img';
		$config['allowed_types']	= 'jpg|png|gif';
		$config['max_size']			= '2048';
		$this->load->library('upload', $config);
		if(!$this->upload->do_upload('gambar')){
			echo "Upload Gagal"; die();
		}else{
			$gambar = $this->upload->data();
			$gambar	= $gambar['file_name'];
			$nama_tanaman   = $this->input->post('nama_tanaman');
			$min_ph         = $this->input->post('min_ph');
			$max_ph         = $this->input->post('max_ph');
			$min_lembab     = $this->input->post('min_lembab');
			$max_lembab     = $this->input->post('max_lembab');

			$data = array(
				'nama_tanaman'      => $nama_tanaman,
				'min_ph'            => $min_ph,
				'max_ph'            => $max_ph,
				'min_lembab'        => $min_lembab,
				'max_lembab'        => $max_lembab,
				'gambar'       		=> $gambar
			);
		}

		$this->m_tanaman->input_data($data, 'tb_tanaman');
		redirect('tanaman/index');
	}

	public function hapus($id)
	{
		$where = array('id' => $id);
		$this->m_tanaman->hapus_data($where, 'tb_tanaman');
		redirect('tanaman/index');
	}

	public function edit($id)
	{
		$where = array('id' => $id);
		$data ['tanaman'] = $this->m_tanaman->edit_data($where, 'tb_tanaman')->result();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('edit', $data);
		$this->load->view('templates/footer');
	}

	public function update()
	{
		$id = $this->input->post('id');
		$config['upload_path']		= './assets/img';
		$config['allowed_types']	= 'jpg|png|gif';
		$config['max_size']			= '2048';
		$this->load->library('upload', $config);

		if(!$this->upload->do_upload('gambar')){
			$nama_tanaman   = $this->input->post('nama_tanaman');
			$min_ph         = $this->input->post('min_ph');
			$max_ph         = $this->input->post('max_ph');
			$min_lembab     = $this->input->post('min_lembab');
			$max_lembab     = $this->input->post('max_lembab');

			$data = array(
				'nama_tanaman'      => $nama_tanaman,
				'min_ph'            => $min_ph,
				'max_ph'            => $max_ph,
				'min_lembab'        => $min_lembab,
				'max_lembab'        => $max_lembab,
				'gambar'       		=> $gambar
			);
		}else{
			$gambar_info = $this->upload->data();
        	$gambar      = $gambar_info['file_name'];

        	// MeReplace gambar lama dari server
        	$gambarLama = $this->db->query("SELECT gambar FROM tb_tanaman WHERE id='$id'")->row();
        	if ($gambarLama) {
        	    $target = "assets/img/" . $gambarLama->gambar;
        	    if (file_exists($target)) {
        	        unlink($target);
        	    }
        	}

        	$nama_tanaman   = $this->input->post('nama_tanaman');
        	$min_ph         = $this->input->post('min_ph');
        	$max_ph         = $this->input->post('max_ph');
        	$min_lembab     = $this->input->post('min_lembab');
        	$max_lembab     = $this->input->post('max_lembab');

        	$data = array(
        	    'nama_tanaman'  => $nama_tanaman,
        	    'min_ph'        => $min_ph,
        	    'max_ph'        => $max_ph,
        	    'min_lembab'    => $min_lembab,
        	    'max_lembab'    => $max_lembab,
        	    'gambar'        => $gambar
        	);
		}

		$where = array
		('id' => $id);
		$this->m_tanaman->update_data($where, $data, 'tb_tanaman');
		redirect('tanaman/index');
	}

	public function detail($id)
	{
		$this->load->model('m_tanaman');
		$detail = $this->m_tanaman->detail_data($id);
		$data['detail'] = $detail;
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('detail', $data);
		$this->load->view('templates/footer');
	}

	public function send_data()
	{
    	$id = $this->input->get('id');
    	$nama_tanaman 	= $this->input->get('nama_tanaman');
    	$min_ph			= $this->input->get('min_ph');
    	$max_ph 		= $this->input->get('max_ph');
    	$min_lembab 	= $this->input->get('min_lembab');
    	$max_lembab 	= $this->input->get('max_lembab');

    	// Kirim data ke ESP8266
    	$url = 'http://192.168.4.1/path/to/endpoint?' . http_build_query([
    	    'id' => $id,
    	    'nama_tanaman' 	=> $nama_tanaman,
    	    'min_ph' 		=> $min_ph,
    	    'max_ph' 		=> $max_ph,
    	    'min_lembab'	=> $min_lembab,
    	    'max_lembab' 	=> $max_lembab
    	]);

    	$result = file_get_contents($url);

    	echo $result;
	}

	/*public function search()
	{
		$keyword =$this->input->post('keyword');
		$data['tanaman']=$this->m_tanaman->get_keyword($keyword);

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('v_tanaman', $data);
		$this->load->view('templates/footer');
	}
/*
	public function kirim($id)
	{
		$this->load->model('m_tanaman');
	}

	public function endpoint()
	{
		$id_tanaman = $this->input->post('id_tanaman');
		$status 	= $this->input->post('status');
  
		// Lakukan sesuatu dengan status, misalnya kirim ke ESP
		$this->sendDataToESP($id_tanaman, $status);
  
		// Kirim respons ke client (JavaScript)
		echo json_encode(['status' => 'success', 'message' => 'Data berhasil dikirim ke ESP']);
	 }
  
	 private function sendDataToESP($id_tanaman, $status)
	 {
		// Lakukan implementasi untuk mengirim data ke ESP
		// Misalnya, gunakan library cURL untuk mengirim HTTP Request ke ESP
		// ...
		 $ch = curl_init();
		 curl_setopt($ch, CURLOPT_URL, 'http://esp-address/toggle-endpoint');
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		 curl_setopt($ch, CURLOPT_POST, 1);
		 curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['status' => $status]));
		 curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		 $response = curl_exec($ch);
		 curl_close($ch);
	 }*/

}
