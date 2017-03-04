<?php 

class Employees extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('employee_model');
		$this->load->model('department_model');
		$this->load->library('notification');
	}

	// paparkan senarai employee

	public function index()
	{
		/*
		dapatkan senarai employee dari db menggunakan 
		function get_all() dari employee_model
		*/

		$data = array();

		// $records = $this->employee_model->get_all();
		// $records = $this->employee_model->get_employees_info();
		$records = $this->employee_model->employee_info()->orderBy('first_name','asc')->get_all();
		// var_dump($records);

		//passkan records kepada data untuk di hantar pada view

		$data['records'] = $records;

		//set view content

		$data['content'] = 'backend/employees/index';

		//paparkan view

		$this->load->view('backend/base_template',$data);
		
	}

	//simple report, tuk belajar generate PDF

	public function report()
	{
		$data = array();

		if($this->input->get('department_id'))
		{
			$filter_department_id = $this->input->get('department_id');
			$records = $this->employee_model->employee_info()->orderBy('first_name','asc')->get_many_by('employees.department_id',$filter_department_id);
		}
		else
		{
			$records = $this->employee_model->employee_info()->orderBy('first_name','asc')->get_all();
		}

		//passkan records kepada data untuk di hantar pada view

		$data['records'] = $records;

		$data['department_records'] = $this->getDepartmentsDropdown();

		//set view content

		$data['content'] = 'backend/employees/report';

		//paparkan view

		if ($this->input->get('filter_type')=='PDF') {
			
			// code untuk papar/download PDF disini

			$this->load->helper('dompdf');

			// panggil master template pdf

			$data['content'] = 'backend/employees/report_pdf';

			$html = $this->load->view('backend/pdf_template',$data, true);

			//generate and download PDF

			pdf_create($html,'testreport');
		}
		else
		{
			$this->load->view('backend/base_template',$data);
		}

		
	}

	// paparkan create employee form

    public function create()
    {
    	$this->form_validation->set_rules('first_name', 'First Name', 'required');
    	$this->form_validation->set_rules('last_name', 'Last Name', 'required');
    	$this->form_validation->set_rules('department_id', 'Department', 'required');

    	if ($this->form_validation->run() == FALSE)
		{
			// paparkan halaman bila first time view
			// paparkan balik halaman bila validation error

			$data = array();

			// passkan deparment records ke data

			$data['department_records'] = $this->getDepartmentsDropdown();

			$data['content'] = 'backend/employees/create';

			$this->load->view("backend/base_template",$data);
		}
		else
		{
			// kalau berjaya, simpan ke database

			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
			$department_id = $this->input->post('department_id');

			$data = array(
					'first_name'=>$first_name,
					'last_name'=>$last_name,
					'department_id'=>$department_id
					);

			$employee_id = $this->employee_model->insert($data);

			//send email to admin bagitau emel berjaya

			//send notification email
			$this->notification->newEmployeeRegisteredNotification();

			// echo $this->email->print_debugger();
			// exit;

			//set success message using flashdata
			$this->session->set_flashdata('success', 'Rekod berjaya di simpan');

			//redirect kalau berjaya
			redirect("employees/index");
		}
    	
    }

    // edit form

    public function edit()
    {
    	$this->form_validation->set_rules('first_name', 'Department Name', 'required');
    	$this->form_validation->set_rules('last_name', 'Department Description', 'required');

    	if ($this->form_validation->run() == FALSE)
		{
			//paparkan form jika view atau validation error

			$data = array();

			//dapatkan employee_id dari URL

			$employee_id = $this->uri->segment(3, 0);

			//kalau validation error, amik employee_id dari hidden field

			if (empty($employee_id)) {
				$employee_id = $this->input->post('employee_id');
			}

			// var_dump($employee_id);

			// minta single record dengan model

			$records = $this->employee_model->get($employee_id);

			// var_dump($records);

			//passkan data kepada view

			$data['department_records'] = $this->getDepartmentsDropdown();

			$data['records'] = $records;

			$data['content'] = 'backend/employees/edit';

			// load view bersama data

			$this->load->view("backend/base_template",$data);

		}
		else
		{
			//save changes to database

			//ambil maklumat dari form
			$employee_id = $this->input->post('employee_id');
			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
			$department_id = $this->input->post('department_id');


			//letak maklumat ke dalam array $data

			$data = array(
					'first_name'=>$first_name,
					'last_name'=>$last_name,
					'department_id'=>$department_id
					);

			//suruh model jalankan update

			$this->employee_model->update($employee_id,$data);

			//send notification email
			$this->notification->newEmployeeRegisteredNotification();

			//set success message using flashdata
			$this->session->set_flashdata('success', 'Rekod berjaya di kemaskini');

			//redirect ke senarai department
			redirect("employees/edit/$employee_id");

		}

    }

    // delete department

    public function delete()
    {
    	//ambik employee_id dari hidden field
    	$employee_id = $this->input->post('employee_id');
    	
    	//suruh model delete employee dengan id berikut
    	$this->employee_model->delete($employee_id);

    	//send notification email
		$this->notification->newEmployeeRegisteredNotification();

    	//set success message using flashdata
    	$this->session->set_flashdata('success', 'Rekod berjaya di padam');

    	// kembali ke senarai
    	redirect("employees");
    }

    //prepare department dropdown

    public function getDepartmentsDropdown()
    {
    	//minta maklumat department dari model department

		$department_records = $this->department_model->get_all();

		// prepare dropdown array

		$department_dropdown = array(''=>'Pilih Department');

		foreach ($department_records as $key => $value) {
			$department_dropdown[$value->department_id] = $value->department_name;
		}

		return $department_dropdown;
    }


    public function uploadProfilePicture()
    {
    	$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '300';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			// $error = array('error' => $this->upload->display_errors());

			$result = array(
					'status'=>'error',
					'data'=>$this->upload->display_errors()
					);

			header('Content-Type: application/json');
			echo json_encode($result);
		}
		else
		{
			// $data = array('upload_data' => $this->upload->data());

			$result = array(
					'status'=>'success',
					'data'=>$this->upload->data()
					);

			header('Content-Type: application/json');
			echo json_encode($result);
		}
    }

}//end of class