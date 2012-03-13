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
 * Model file for the Contact Us module
 *
 * This class handles the DB interation
 *
 * @package		ContactModule
 * @subpackage	Models
 * @category	Model
 * @author		Sean Downey
 */
class Contact_model extends BF_Model
{

	protected $table		= "contact";
	protected $key			= "contact_id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= true;
	protected $set_modified = false;

}//end class()