<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * System_options_model
 */
class System_options_model extends CI_Model
{

    var $_table = "system_options";

	/**
	 * The class constructor.
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
    public function get_option($name=null, $if_none=null, $set_if_none=false)
	{
        if( ! isset( $name ) ) { return null; }
		if($name) {
			$this->db->where("option_name", $name);
            $result = $this->db->get($this->_table);
            $row = $result->row();
			if(isset($row->option_value)) {
				return $row->option_value;
			}
		}
        if($set_if_none)
        {
            $this->update_option($name, $if_none);
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
		if( ! isset($name) && ! isset($value))
        {
            return null;
        }

        $this->db->select("option_value");
        $this->db->where("option_name", $name);
        $result = $this->db->get($this->_table);

        if($result->num_rows() > 0)
        {
            $this->db->where("option_name", $name);
            $data = array ( "option_value" => $value );
            $this->db->update( $this->_table, $data );
        }
        else
        {
            $data = array ( "option_name" => $name, "option_value" => $value );
            $this->db->insert($this->_table, $data);
        }

		return $this->db->insert_id();
	}

}

/**
 * End of File
 */