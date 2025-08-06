<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function searchdata()
    {
        $searchTerm = $this->input->post('search');
        $rows = array();

        if ($searchTerm !== null && $searchTerm !== '') {
            $this->db->like('name_temp', $searchTerm);
            $query = $this->db->get('boo_nomenklatura');
        } else {
            $query = $this->db->get('boo_nomenklatura');
        }

        $html = "";
        if ($query->num_rows() > 0) {
            $headers = array_keys($query->row_array());
            foreach ($query->result_array() as $row) {
                $html .= '<tr>';
                foreach ($headers as $header) {
                    $html .= '<td>' . htmlspecialchars($row[$header]) . '</td>';
                }
                $html .= '</tr>';
            }
            echo $html;
        } else {
            echo '<tr><td colspan="30">No result</td></tr>';
        }
    }


	public function orderview()
	{

        $rows = array();
        $query = $this->db->query('SELECT * FROM boo_nomenklatura');

        foreach ($query->result_array() as $row)
        {
            $rows[] = $row;
        }

        $data['rows'] = $rows;
		$data['page_title'] = 'List';
        
        $this->load->view('interface/header', $data);
        $this->load->view('interface/menu');
        $this->load->view('interface/content', $data);
        $this->load->view('interface/footer');
	}
}