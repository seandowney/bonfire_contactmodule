<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Bonfire Contact Module
 *
 * An open source module for use in the Bonfire project
 *
 * @package		ContactModule
 * @author		Sean Downey
 * @copyright	Copyright (c) 2012, Sean Downey
 */

// ------------------------------------------------------------------------

/**
 * Frontend Controller Class
 *
 * This class is used to handle the frontend functionality of the Contact Us module.
 *
 * @package		ContactModule
 * @subpackage	Controllers
 * @category	Controllers
 * @author		Sean Downey
 */
class Contact extends Front_controller
{

	
	/**
	 * Constructor
	 * 
	 * @return void
	 */
	function __construct()
	{
 		parent::__construct();

		$this->output->cache(0);

		$this->load->library('form_validation');
		$this->load->database();
		$this->load->model('contact_model');
		$this->lang->load('contact');
		
	}//end __construct()
	
	
	/**
	 * index
	 * 
	 * Displays the form and handles the form post
	 * 
	 * @return void
	 */
	public function index() 
	{
		Template::set_view('contact/index');
		
		// Check if the form was submitted
		if ($this->input->post('submit'))
		{
			// try to save the details
			if ($this->_save_contact())
			{
				Template::set_message(lang("contact_create_success"), 'success');
				Template::set_view('contact/success');
				
				// send an email to the site owner
				$this->_send_email();
			}
			else 
			{
				Template::set_message(lang("contact_create_failure") . $this->contact_model->error, 'error');
			}
		}
	
		Template::render();

	}//end index()
	
	
	/**
	 * _save_contact
	 * 
	 * Save the details to the database
	 * 
	 * @return boolean TRUE/FALSE whether the data saved successfully or not
	 */
	private function _save_contact() 
	{	
			
		$this->form_validation->set_rules('name','Your Name','required|trim|xss_clean|max_length[150]');			
		$this->form_validation->set_rules('email_address','Email Address','required|trim|xss_clean|valid_email|max_length[150]');			
		$this->form_validation->set_rules('phone','Phone Number','trim|xss_clean|is_numeric|max_length[20]');			
		$this->form_validation->set_rules('subject','Subject','required|trim|xss_clean|max_length[150]');			
		$this->form_validation->set_rules('message','Message','required|trim|xss_clean');
		
		// validate the details passed in
		if ($this->form_validation->run() === false)
		{
			return FALSE;
		}
		
		$_POST['created_on'] = date('Y-m-d H:i:s');
		
		// insert the records into the database
		$id = $this->contact_model->insert($_POST);

		if (is_numeric($id))
		{
			return TRUE;
		}
		
		return FALSE;
		
	}//end _save_contact()
	
	
	/**
	 * _send_email
	 * 
	 * Send an email to the Bonfire system_email address containing the details of the form
	 * 
	 * return boolean Result of sending the email
	 */
	private function _send_email()
	{
		
		$this->load->library('email');

		$this->email->from($this->input->post('email_address'), $this->input->post('name'));
		$this->email->to($this->settings_lib->item('site.system_email')); 

		$this->email->subject($this->input->post('subject'));

		$message = $this->input->post('message')."\n\n";
		$message .= lang('contact_form_name').": ".$this->input->post('name')."\n";
		$message .= lang('contact_form_email').": ".$this->input->post('email_address')."\n";
		$phone_num = $this->input->post('phone');
		if(!empty($phone)) {
			$message .= lang('contact_form_phone').": ".$phone."\n";
		}
		$this->email->message($message);	

		return $this->email->send();
		
	}//end _send_email()


}//end class()
