<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Config extends CI_Config {

	function __construct()
	{
		parent::__construct();
	}


	/**
	 * Fetch a config file item - adds slash after item (if item is not empty)
	 *
	 * @access  public
	 * @param   string  the config item name
	 * @param   bool
	 * @return  string
	 */
	function slash_item($item)
	{
		if ( ! isset($this->config[$item]))
		{
			return FALSE;
		}
		if( trim($this->config[$item]) == '')
		{
			return '';
		}

		if($_SERVER['SERVER_PORT'] === '443')
		{
			return rtrim(str_replace('http:', 'https:', $this->config[$item]), '/').'/';
		}
		else
		{
			return rtrim($this->config[$item], '/').'/';
		}
	}

}
/* End of file MY_Config.php */
/* Location: ./application/core/MY_Config.php */
