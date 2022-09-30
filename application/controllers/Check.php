<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Check extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('m_data');
    }

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function checkCondition()
	{
		$date = date("Y-m-d H:i:s");
		for ($i=1; $i <= 7; $i++) { 
			$id_line = $i;
			$data = $this->m_data->checkCondition($id_line);

			if ($data[0]['status_ticket'] == 'Close' || $data[0]['status_ticket'] == 'Setting') {
				$status_line = 'Running';
				$nama_mesin = '';
				$permasalahan = '';
				$id_ticket = '';
			} else {
				$id_line = $data[0]['id_line'];
				$status_line = 'Breakdown';
				$nama_mesin = $data[0]['nama_mesin'];
				$permasalahan = $data[0]['permasalahan'];
				$id_ticket = $data[0]['id_ticket'];
			}

			$this->m_data->updateStatus($id_line, $status_line, $nama_mesin, $permasalahan, $id_ticket, $date);
		}
	}
}
