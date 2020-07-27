<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_inventory extends CI_Controller {

	function __construct() {
        parent:: __construct();
		check_not_login();
    }

	public function print() {
		$data['inventory'] = $this->db->query("SELECT * FROM inventory")->result();
	    $this->load->library('Pdf');

	    $this->pdf->setPaper('A4', 'landscape');
	    $this->pdf->filename = "laporan-inventory.pdf";
	    $this->pdf->load_view('laporan/inventory', $data);
	}

}

/* End of file Laporan_inventory.php */
/* Location: ./application/controllers/laporan/Laporan_inventory.php */