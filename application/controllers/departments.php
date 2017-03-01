<?php 

class Departments extends CI_Controller{

	public function __construct()
    {            
    	parent::__construct();
    	$this->load->model("department_model");
    }

    // paparkan senarai Department

    public function index()
    {
    	$data = array();

    	$records = $this->department_model->get_all();

    	$data['records'] = $records;

    	$data['content'] = 'backend/departments/index';

    	$this->load->view("backend/base_template",$data);
    }

    // paparkan create department form

    public function create()
    {
    	$this->form_validation->set_rules('department_name', 'Department Name', 'required');
    	$this->form_validation->set_rules('department_description', 'Department Description', 'required');

    	if ($this->form_validation->run() == FALSE)
		{
			// paparkan halaman bila first time view
			// paparkan balik halaman bila validation error

			$data = array();

			$data['content'] = 'backend/departments/create';

			$this->load->view("backend/base_template",$data);
		}
		else
		{
			// kalau berjaya, simpan ke database

			$department_name = $this->input->post('department_name');
			$department_description = $this->input->post('department_description');

			$data = array(
					'department_name'=>$department_name,
					'department_description'=>$department_description
					);

			$department_id = $this->department_model->create($data);

			//set success message using flashdata
			$this->session->set_flashdata('success', 'Rekod berjaya di simpan');

			//redirect kalau berjaya
			redirect("departments/index");
		}
    	
    }

    // edit form

    public function edit()
    {
    	$this->form_validation->set_rules('department_name', 'Department Name', 'required');
    	$this->form_validation->set_rules('department_description', 'Department Description', 'required');

    	if ($this->form_validation->run() == FALSE)
		{
			//paparkan form jika view atau validation error

			$data = array();

			//dapatkan department_id dari URL

			$department_id = $this->uri->segment(3, 0);

			//kalau validation error, amik department_id dari hidden field

			if (empty($department_id)) {
				$department_id = $this->input->post('department_id');
			}

			// var_dump($department_id);

			// minta single record dengan model

			$records = $this->department_model->get($department_id);

			// var_dump($records);

			//passkan data kepada view

			$data['records'] = $records;

			$data['content'] = 'backend/departments/edit';

			// load view bersama data

			$this->load->view("backend/base_template",$data);

		}
		else
		{
			//save changes to database

			//ambil maklumat dari form
			$department_id = $this->input->post('department_id');
			$department_name = $this->input->post('department_name');
			$department_description = $this->input->post('department_description');

			//letak maklumat ke dalam array $data

			$data = array(
					'department_name'=>$department_name,
					'department_description'=>$department_description
					);

			//suruh model jalankan update

			$this->department_model->update($department_id,$data);

			//set success message using flashdata
			$this->session->set_flashdata('success', 'Rekod berjaya di kemaskini');

			//redirect ke senarai department
			redirect("departments/edit/$department_id");

		}

    }

    // delete department

    public function delete()
    {
    	//ambik department_id dari hidden field
    	$department_id = $this->input->post('department_id');
    	
    	//suruh model delete department dengan id berikut
    	$this->department_model->delete($department_id);

    	//set success message using flashdata
    	$this->session->set_flashdata('success', 'Rekod berjaya di padam');

    	// kembali ke senarai
    	redirect("departments");
    }


} // end of Departments class
