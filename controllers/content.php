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
 * Backend Controller Class for the COntent context
 *
 * This class is used to handle the backend functionality of the Contact Us module.
 *
 * @package		ContactModule
 * @subpackage	Controllers
 * @category	Controllers
 * @author		Sean Downey
 */
class Content extends Admin_Controller
{
               
	/**
	 * Constructor
	 * 
	 * @return void
	 */
	function __construct()
	{
 		parent::__construct();
		
		$this->auth->restrict('Contact.Content.View');
		
		$this->load->model('contact_model');
		$this->lang->load('contact');
		
	}//end __construct()
	
	
	/** 
	 * index
	 *
	 * List form data
	 * 
	 * @return void
	 */
	public function index()
	{
		
		$records = $this->contact_model->find_all();

		Template::set("data", $records);
		Template::set("toolbar_title", "Manage Contacts");
		Template::render();
		
	}//end index()
	
	
	/**
	 * view
	 * 
	 * Display the content of one contact form entry
	 */
	public function view() 
	{
		$this->auth->restrict('Contact.Content.Edit');

		$id = (int)$this->uri->segment(5);
		
		if (empty($id))
		{
			Template::set_message(lang("contact_invalid_id"), 'error');
			redirect(SITE_AREA.'/content/contact');
		}
	
		Template::set('contact', $this->contact_model->find($id));
	
		Template::set('toolbar_title', lang("contact_edit_heading"));
		Template::set_view('content/view');
		Template::set("toolbar_title", "View Contact");
		
		Template::render();
		
	}//end view()
	
	
	/**
	 * delete
	 * 
	 * Delete a form entry
	 */
	public function delete() 
	{	
		$this->auth->restrict('Contact.Content.Delete');

		$id = $this->uri->segment(5);
	
		if (!empty($id))
		{	
			if ($this->contact_model->delete($id))
			{
				Template::set_message(lang("contact_delete_success"), 'success');
			}
			else
			{
				Template::set_message(lang("contact_delete_failure") . $this->contact_model->error, 'error');
			}
		}
		
		redirect(SITE_AREA.'/content/contact');
		
	}//end delete()
		

}//end class
