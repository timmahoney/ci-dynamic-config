<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

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
	}

    /**
     * get_option
     * Will return the option passed by name, or return the default if it is set,
     * Will return null if nothing is found.
     *
     * @param null $name
     * @param null $if_none
     * @return null
     */
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

    /**
     * update_option
     * Will allow you to insert options if they don't exist, or will update ones that exist currently.
     * Returns the new option's database id, or the already existing option's database id if existing.
     *
     * @param null $name
     * @param null $value
     * @return mixed
     */
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