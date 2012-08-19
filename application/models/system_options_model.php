<?php

	/**
	 * System_options_model
	 */
class System_options_model extends MY_Model
{

	/**
	 * The class constructer.
	 */
	public function __construct()
	{
		parent::__construct();

		// set the table name
		$this->_table = "system_options";
	}

	public function get_option($name=null, $if_none=null)
	{
		if($name) {
			$row = $this->get_by("option_name", $name);
			if(isset($row->option_value)) {
				return $row->option_value;
			}
		} else {
			return $if_none;
		}
        return $if_none;
	}

	public function update_option($name=null, $value=null)
	{
		$sql = "INSERT INTO `".$this->_table."` (option_name, option_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE option_value=?, id=last_insert_id(id);";
		$this->db->query($sql, array($name, $value, $value));
		return $this->db->insert_id();
	}

}

/**
 * End of File
 */