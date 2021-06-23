<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();

	}

	function index(){

	}

	function tampil_data_keseluruhan($namatabel) //gunakan ini untuk menampilkan tabel yg lebih spesifik 'where'
	{
		$this->db->select("*");
		$this->db->from($namatabel);
		
	 	$query = $this->db->get();
	 	return $query;
	}

	function tampil_data_where($namatabel,$array) //gunakan ini untuk menampilkan tabel yg lebih spesifik 'where'
	{
		$this->db->select("*");
		$this->db->from($namatabel);
		$this->db->where($array);
		// $this->db->limit(1);
	 	$query = $this->db->get();
	 	return $query;
	}

	function tampil_data_keseluruhan_order_by($namatabel,$order_by,$order) //gunakan ini untuk menampilkan tabel yg lebih spesifik 'where'
	{
		$this->db->select("*");
		$this->db->from($namatabel);
		// $this->db->where($array);
		$this->db->order_by($order_by, $order);
		// $this->db->limit(1);
	 	$query = $this->db->get();
	 	return $query;
	}

	function tampil_data_where_order_by($namatabel,$array,$order_by,$order) //gunakan ini untuk menampilkan tabel yg lebih spesifik 'where'
	{
		$this->db->select("*");
		$this->db->from($namatabel);
		$this->db->where($array);
		$this->db->order_by($order_by, $order);
		// $this->db->limit(1);
	 	$query = $this->db->get();
	 	return $query;
	}

	function tampil_data_last($namatabel,$kolom)
	{
		$this->db->select("*");
		$this->db->from($namatabel);
		$this->db->limit(1);
		$this->db->order_by($kolom,"DESC");
		$query = $this->db->get();
		return $query;
	}

	function custom_query($query) 
	{
		$query1 = $this->db->query($query);
		return $query1;

	}

	function insert($namatabel,$array) 
	{
		return $this->db->insert($namatabel,$array);
	}

	function update($table,$array,$array_condition)
	{
		$this->db->where($array);
		$this->db->update($table, $array_condition);
	}

	function delete($table,$array_condition)
	{
		// $this->db->where($array);
		$this->db->delete($table, $array_condition);
		// $this->db->delete(table_name, where_clause)
	}



	function like($namatabel,$field,$like,$kategori)
	{
		if ($kategori == '') {
			$this->db->select("*");
			$this->db->from($namatabel);
			$this->db->like($field, $like, 'both'); 
			// $this->db->limit(1);
		 	$query = $this->db->get();
		 	return $query;
		}else{
			$this->db->select("*");
			$this->db->from($namatabel);
			$this->db->where(array('kategori'=>$kategori));
			$this->db->like($field, $like, 'both'); 
			// $this->db->limit(1);
		 	$query = $this->db->get();
		 	return $query;
		}
	}

	function data_user($nik,$pencarian)
	{
		$data = $this->tampil_data_where('tb_staff_kelurahan',array('nik' => $nik));
		foreach ($data->result() as $key => $value) ;	
		if ($pencarian == "data_diri") {
			return $value;
		}else if ($pencarian == "kelurahan") {
			$kelurahan = $this->tampil_data_where('tb_kelurahan',array('no' => $value->kelurahan));
			foreach ($kelurahan->result() as $key1 => $value1) ;
			return $value1->kelurahan;
		}
		
	}

	function serialize($data){
		$keys = array_column($data,'name');
		$values = array_column($data,'value');
		$data = array_combine($keys, $values);
		return $data;
	}

	function cek_penamaan_foto($imageFileType)
	{
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
		    
		    return 0; 
		}else{
			return 1;
		}
	}


	function bulan($bulan) 
	{
		
		switch ($bulan) {
			case '01':
				$bulannya = 'Januari';
				break;

			case '02':
				$bulannya = 'Februari';
				break;

			case '03':
				$bulannya = 'Maret';
				break;

			case '04':
				$bulannya = 'April';
				break;

			case '05':
				$bulannya = 'Mei';
				break;

			case '06':
				$bulannya = 'Juni';
				break;

			case '07':
				$bulannya = 'Juli';
				break;

			case '08':
				$bulannya = 'Agustus';
				break;

			case '09':
				$bulannya = 'September';
				break;

			case '10':
				$bulannya = 'Oktober';
				break;
			
			case '11':
				$bulannya = 'November';
				break;

			case '12':
				$bulannya = 'Desember';
				break;

			default:
				$bulannya = '';
				break;
		}

		return $bulannya;
	}

	function qrcode_buku($kode){
		include "phpqrcode/qrlib.php"; 
		$kode = $kode;
    
    // $PNG_TEMP_DIR = 'images/'.$kategori;
    
    $PNG_WEB_DIR = 'images/buku/';

    if (!file_exists($PNG_WEB_DIR))
    	mkdir($PNG_WEB_DIR);
   	    
    $errorCorrectionLevel = 'H';

    $matrixPointSize = 10;

    $filename =$PNG_WEB_DIR.md5($kode).'.png';
    QRcode::png($kode, $filename, $errorCorrectionLevel, $matrixPointSize, 2); 

    if (file_exists($PNG_WEB_DIR.md5($kode).'.png') > 0) {
    	return "ada";
    }else{
    	return "tiada";
    }
	}

	function cek_last_ai($tables){
		return $this->db->query("SELECT `AUTO_INCREMENT` as no
			FROM  INFORMATION_SCHEMA.TABLES
			WHERE TABLE_SCHEMA = '".$this->db->database."'
			AND   TABLE_NAME   = '".$tables."'");

	}

}