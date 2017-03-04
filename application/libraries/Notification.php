<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Notification {

    private $_CI;

    public function __construct()
    {
    	 // use $this->_CI if using custom library to load other model/library
    	 
    	 $this->_CI =& get_instance();
    	 $this->_CI->load->library('email');
    }

    // send new email notification after add new employee

    public function newEmployeeRegisteredNotification()
    {
		//send email to admin bagitau emel berjaya

		$this->_CI->email->from('system@mycompany.dev', 'Your Name');
		$this->_CI->email->to('admin@mycompany.dev'); 
		$this->_CI->email->cc('another@mycompany.dev'); 
		$this->_CI->email->bcc('them@their-example.com'); 

		$this->_CI->email->subject('New Employee Registered');
		$this->_CI->email->message('<h1>Testing</h1> the email with <i>Mailtrap</i>.');	

		$this->_CI->email->attach('./assets/img/logo.png');

		$this->_CI->email->send();
    }
}

/* End of file Notification.php */