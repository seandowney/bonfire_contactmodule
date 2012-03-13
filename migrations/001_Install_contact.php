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
 * Migration file for the Contact Us module
 *
 * This class Creates and Destroys the db table and permissions
 *
 * @package		ContactModule
 * @subpackage	Migrations
 * @category	Migration
 * @author		Sean Downey
 */
class Migration_Install_contact extends Migration
{

	
	/**
	 * up
	 * 
	 * Creates the db table and add the permissions to the database
	 * 
	 * @return void
	 */
	public function up() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->add_field('`contact_id` int(11) NOT NULL AUTO_INCREMENT');
		$this->dbforge->add_field('`name` VARCHAR(150) NOT NULL');
		$this->dbforge->add_field('`email_address` VARCHAR(150) NOT NULL');
		$this->dbforge->add_field('`phone` VARCHAR(20) NOT NULL');
		$this->dbforge->add_field('`subject` VARCHAR(50) NOT NULL');
		$this->dbforge->add_field('`message` TEXT NOT NULL');
		$this->dbforge->add_field('`created_on` DATETIME NOT NULL');
		$this->dbforge->add_key('contact_id', true);
		$this->dbforge->create_table('contact');

		// permissions
		$this->db->query("INSERT INTO {$prefix}permissions VALUES (0,'Contact.Content.View','','active');");
		$this->db->query("INSERT INTO {$prefix}permissions VALUES (0,'Contact.Content.Create','','active');");
		$this->db->query("INSERT INTO {$prefix}permissions VALUES (0,'Contact.Content.Edit','','active');");
		$this->db->query("INSERT INTO {$prefix}permissions VALUES (0,'Contact.Content.Delete','','active');");

	}//end up()
	
	
	/**
	 * down
	 * 
	 * Drops the db table and removes the permissions from the database
	 * 
	 * @return void
	 */
	public function down() 
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('contact');
		// permissions
		$query = $this->db->query("SELECT permission_id FROM {$prefix}permissions WHERE name='Contact.Content.View';");
		foreach ($query->result_array() as $row)
		{
			$permission_id = $row['permission_id'];
			$this->db->query("DELETE FROM {$prefix}role_permissions WHERE permission_id='$permission_id';");
		}
		$this->db->query("DELETE FROM {$prefix}permissions WHERE name='Contact.Content.View';");
		$query = $this->db->query("SELECT permission_id FROM {$prefix}permissions WHERE name='Contact.Content.Create';");
		foreach ($query->result_array() as $row)
		{
			$permission_id = $row['permission_id'];
			$this->db->query("DELETE FROM {$prefix}role_permissions WHERE permission_id='$permission_id';");
		}
		$this->db->query("DELETE FROM {$prefix}permissions WHERE name='Contact.Content.Create';");
		$query = $this->db->query("SELECT permission_id FROM {$prefix}permissions WHERE name='Contact.Content.Edit';");
		foreach ($query->result_array() as $row)
		{
			$permission_id = $row['permission_id'];
			$this->db->query("DELETE FROM {$prefix}role_permissions WHERE permission_id='$permission_id';");
		}
		$this->db->query("DELETE FROM {$prefix}permissions WHERE name='Contact.Content.Edit';");
		$query = $this->db->query("SELECT permission_id FROM {$prefix}permissions WHERE name='Contact.Content.Delete';");
		foreach ($query->result_array() as $row)
		{
			$permission_id = $row['permission_id'];
			$this->db->query("DELETE FROM {$prefix}role_permissions WHERE permission_id='$permission_id';");
		}
		$this->db->query("DELETE FROM {$prefix}permissions WHERE name='Contact.Content.Delete';");
		
	}//end down()
	
	
}//end class