<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function choosedata()
    {
        $searchValues = $this->input->post('search');
        $rows = array();

        $response = [
            'nomenklatura' => []
        ];

        if (!empty($searchValues) && is_array($searchValues)) {
            $this->db->select('mc.nomenklatura_id, dg.name as group_name, pdo.name as text, dcv.value  AS option_value , dcvp.value  AS option_value_presence');
            $this->db->from('b_product_models_connections mc');
            $this->db->join('b_product_details_connections dc', 'dc.model_id = mc.model_id');
            $this->db->join('b_product_details_connection_values dcv', 'dcv.id = dc.value_id');
            $this->db->join('b_product_details_connection_values_presence dcvp', 'dcvp.id = dcv.presence');
            $this->db->join('b_product_models m', 'm.id = mc.model_id');
            $this->db->join('b_product_details_groups dg', 'dg.id = dc.group_id');
            $this->db->join('b_product_details_options pdo', 'pdo.id = dc.option_id');
            $this->db->join('b_product_details_sets s', 's.id = dc.set_id');
            $this->db->where_in('dcv.value', $searchValues);

            $query = $this->db->get('b_product_models_connections');
            $searchId = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $searchId[] = $row->nomenklatura_id;
                }
            }

            $this->db->select('*');
            $this->db->where_in('buh_id', $searchId);
            $query2 = $this->db->get('boo_nomenklatura');
            $response['nomenklatura'] = $query2->result_array();
        }

        echo json_encode($response);
    }


    public function searchdata()
    {
        $searchTerm = $this->input->post('search');
        $rows = array();
        
        $response = [
            'nomenklatura' => [],
            'filtrdata' => []
        ];

        if ($searchTerm !== null && $searchTerm !== '') 
        {
            $this->db->like('name', $searchTerm);
            $query = $this->db->get('boo_nomenklatura');
            $result = $query->result_array();
            $response['nomenklatura'] = $result;
//  START QUERY FILTER
            $searchId = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $searchId[] = $row->buh_id;
                }
            }
            $this->db->select('dg.name as group_name, pdo.name as text, dcv.value  AS option_value , dcvp.value  AS option_value_presence');
            $this->db->from('b_product_models_connections mc');
            $this->db->join('b_product_details_connections dc', 'dc.model_id = mc.model_id');
            $this->db->join('b_product_details_connection_values dcv', 'dcv.id = dc.value_id');
            $this->db->join('b_product_details_connection_values_presence dcvp', 'dcvp.id = dcv.presence');
            $this->db->join('b_product_models m', 'm.id = mc.model_id');
            $this->db->join('b_product_details_groups dg', 'dg.id = dc.group_id');
            $this->db->join('b_product_details_options pdo', 'pdo.id = dc.option_id');
            $this->db->join('b_product_details_sets s', 's.id = dc.set_id');
            
            if (!empty($searchId)) {
                $this->db->where_in('mc.nomenklatura_id', $searchId);
            }
            $this->db->order_by('dc.group_position', 'dc.option_position');
            $query2 = $this->db->get('b_product_models_connections');
            $result2 = $query2->result_array();
            $response['filtrdata'] = $result2;

            echo json_encode($response);
//  END QUERY FILTER

        } else {
            $query = $this->db->get('boo_nomenklatura');
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
        $group_name = array();
        $text = array();
        $option_value = array();

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
            $group_name[] = $row['group_name'];
            $text[] = $row['text'];
            $option_value[] = $row['option_value'];
        }
        $data['characteristic'] = $show_characteristic;
        $data['group_name'] = array_unique($group_name);
        $data['text'] = array_unique($text);
        $data['option_value'] = $option_value;
        
        $this->load->view('interface/header', $data);
        $this->load->view('interface/menu');
        // $this->load->view('interface/filter_menu');
        $this->load->view('interface/content', $data);
        $this->load->view('interface/footer');
	}
}