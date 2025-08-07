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
		$data['page_title'] = 'List of products';


        $show_characteristic = array();
        $query2 = $this->db->query('SELECT dg.name as group_name, pdo.name as text, dcv.value  AS option_value , dcvp.value  AS option_value_presence 
                                    FROM b_product_models_connections mc
                                    JOIN b_product_details_connections dc ON dc.model_id = mc.model_id
                                    JOIN b_product_details_connection_values dcv ON dcv.id = dc.value_id
                                    JOIN b_product_details_connection_values_presence dcvp ON dcvp.id = dcv.presence
                                    JOIN b_product_models m ON m.id = mc.model_id
                                    JOIN b_product_details_groups dg ON dg.id = dc.group_id
                                    JOIN b_product_details_options pdo ON pdo.id = dc.option_id
                                    JOIN b_product_details_sets s ON s.id = dc.set_id
                                    WHERE  mc.nomenklatura_id IN (470518, 417825, 401335, 536528, 462571, 453419 ,481621)
                                    ORDER BY  dc.group_position, dc.option_position');

        foreach ($query2->result_array() as $row)
        {
            $show_characteristic[] = $row;
        }
        $data['characteristic'] = $show_characteristic;
        
        $this->load->view('interface/header', $data);
        $this->load->view('interface/menu');
        // $this->load->view('interface/filter_menu');
        $this->load->view('interface/content', $data);
        $this->load->view('interface/footer');
	}
}