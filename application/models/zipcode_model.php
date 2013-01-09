<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Zipcode_model extends CI_Model {


	function __construct()
	{
		parent::__construct();

		// DBクラスの初期化
		$this->load->database();
	}


	/**
	 * fetch_row 一行だけ取得
	 * 
	 * @param string $code 
	 * @access public
	 * @return void
	 */
	public function fetch_row($code)
	{
		$query = $this->db->get_where('zipcode', array('zipcode' => $code));

		return $query->row_array();
	}


	/**
	 * insert データの投入
	 * 
	 * @param array $data 
	 * @access public
	 * @return void
	 */
	public function insert($data)
	{
		$data['created'] = date('YmdHis');

		$this->db->insert('zipcode', $data);
	}


	/**
	 * truncate テーブルのクリア
	 * 
	 * @access public
	 * @return void
	 */
	public function truncate()
	{
		$this->db->truncate('zipcode');
	}
}

/* End of file zipcode_model.php */
/* Location: ./application/models/zipcode_model.php */
