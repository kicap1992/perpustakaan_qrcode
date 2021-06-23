<?php
 
class M_tabel_ss extends CI_Model {
 
    // var $table = 'tb_kategori'; //nama tabel dari database
    // var $column_order = array(null, 'user_nama','user_email','user_alamat'); //field yang ada di table user
    // var $column_order = array(null, 'tb_kategori.kategori','tb_list_buku.judul','tb_list_buku.pengarang',null); //field yang ada di table user
    // var $column_search = array('user_nama','user_email','user_alamat'); //field yang diizin untuk pencarian 
    // var $column_search = array('tb_kategori.kategori','tb_list_buku.judul','tb_list_buku.pengarang'); //field yang diizin untuk pencarian 
    // var $order = array('no' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query($a,$b,$c,$d,$e,$f)
    {
        $column_search = $b;
        $column_order = $c;
        $order = $d;

        if ($e != null) {
           $this->db->select("*,b.no as nomor_kategori,a.no as nomornya");
        }

        $this->db->from($a);
        if ($e != null) {
           $this->db->join($e,$f);
        }


        // $column_search = array('tb_kategori.kategori','tb_list_buku.judul','tb_list_buku.pengarang');
        // $column_search = array('kategori');
        // $column_search = array('a.judul','b.kategori','a.pengarang','a.tahun_terbit');
        // $column_order = array(null, 'tb_kategori.kategori','tb_list_buku.judul','tb_list_buku.pengarang',null);
        // $column_order = array(null, 'kategori',null);
        // $column_order = array(null, 'a.judul','b.kategori','a.pengarang','a.tahun_terbit',null);
        // $order = array('no' => 'asc');
        // $this->db->from("tb_kategori");
        // $this->db->from("tb_kategori");


        // $this->db->from("tb_list_buku a");
        // $this->db->join('tb_kategori b', 'a.kategori = b.no');
 
        $i = 0;
     
        // foreach ($this->column_search as $item) // looping awal
        foreach ($column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                // if(count($this->column_search) - 1 == $i) 
                if(count($column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            // $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables($a,$b,$c,$d,$e,$f)
    {
        $this->_get_datatables_query($a,$b,$c,$d,$e,$f);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered($a,$b,$c,$d,$e,$f)
    {
        $this->_get_datatables_query($a,$b,$c,$d,$e,$f);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all($a,$e,$f)
    {
        if ($e == null) {
           $this->db->from($a);
        }else{
            $this->db->from($a);
            $this->db->join($e,$f);
        }
        
        return $this->db->count_all_results();
    }
 
}