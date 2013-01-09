<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}


	/**
	 * get_zipcode POSTされた値を元にJSON 形式で住所を返す
	 * 
	 * @access public
	 * @return json
	 */
	public function get_zipcode()
	{
		// Ajax 通信かどうかの判定
		if($this->input->is_ajax_request() === TRUE)
		{
			// ライブラリのロード
			$this->load->library('form_validation');	

			// バリデーションを通過した場合にデータを返す
			if($this->form_validation->run('get_zipcode'))
			{
				// データの取り出し
				$code = $this->input->post('zipcode');

				// モデルのロード
				$this->load->model('zipcode_model');

				// データ取得
				$data = $this->zipcode_model->fetch_row($code);

				// 出力データ整形
				$tmp = array(
					'status'     => 'OK',
					'zipcode'    => $data['zipcode'],
					'prefecture' => $data['prefecture'],
					'address'    => $data['address'],
				);
			}
			else
			{
				$tmp = array('status' => 'NG');
			}

			// 出力
			$this->output->set_content_type('application/json')
						 ->set_output(json_encode($tmp));
		}
	}


	/**
	 * renew_zipcode 住所の更新
	 * 
	 * @access public
	 * @return void
	 */
	public function renew_zipcode()
	{
		// ヘルパーのロード
		$this->load->helper('file');

		// モデルのロード
		$this->load->model('zipcode_model');

		$file = file_get_contents('http://www.post.japanpost.jp/zipcode/dl/kogaki/zip/ken_all.zip');

		if( ! write_file('../zipcode/ken_all.zip', $file))
		{
			echo 'ERROR';
		}
		else
		{
			// DB のデータをクリア
			$this->zipcode_model->truncate();

			// 解凍
			$zip = new ZipArchive();
			$zip->open('../zipcode/ken_all.zip');
			$zip->extractTo('../zipcode/');
			$zip->close();
			unlink('../zipcode/ken_all.zip');

			// 文字コード変換
			$strings = read_file('../zipcode/KEN_ALL.CSV');
			$csv = mb_convert_encoding($strings, 'UTF-8', 'auto');

			// 必要カラムの抽出
			write_file('../zipcode/ken_all.tmp', $csv);
			unlink('../zipcode/KEN_ALL.CSV');

			$csv = shell_exec('cut -d"," -f3,7-9 ../zipcode/ken_all.tmp | sed -e "s/（.*）\|以下に掲載がない場合//g"');
			$csv = preg_split('/\r\n|\n/', $csv);

			foreach($csv as $val)
			{
				// 空行ではない場合 
				if((bool)$val === TRUE)
				{
					$val = explode(',', str_replace('"', '', $val));

					$tmp = array(
						'zipcode'    => $val['0'],
						'prefecture' => $val['1'],
						'address'    => $val['2']. $val['3'],
					);

					// DBに入れる
					$this->zipcode_model->insert($tmp);
				}
			}
		}
	}

}
/* End of file api.php */
/* Location: ./application/controllers/api.php */
