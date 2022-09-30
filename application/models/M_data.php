<?php
class M_data extends CI_Model 
{
    public function __construct(){
		parent::__construct();
        $this->db2 = $this->load->database('sqlsrv', TRUE);
	}

	function input($data) {
        $this->db->insert('date',$data);
    }

    function show() {
        return $this->db->get('date')->result_array();
    }

    function checkCondition($id_line) {
        $this->db->select('*');
        $this->db->from('ticket_assy');
        $this->db->where('id_line', $id_line);
        $this->db->where('kategori_perbaikan', 'DT');
        $this->db->order_by('id_ticket', 'desc');
        $this->db->limit(1);
        return $this->db->get()->result_array();
    }

    function updateStatus($id_line, $status_line, $nama_mesin, $permasalahan, $id_ticket, $date) {
        $this->db2->set('status_line', $status_line);
        $this->db2->set('nama_mesin', $nama_mesin);
        $this->db2->set('permasalahan', $permasalahan);
        $this->db2->set('id_ticket', $id_ticket);
        $this->db2->set('last_update', $date);
        $this->db2->where('id_line', $id_line);
        $this->db2->update('status_assy_breakdown');
    }
}
