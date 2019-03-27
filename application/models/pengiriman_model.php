<?php
class Pengiriman_Model extends CI_Model
{
	var $table  = 'pengiriman';
	var $key  = 'id_pengiriman';
	function __construct()
    {
        parent::__construct();
    }
	function getAll($filter = null,$limit = 20,$offset = 0, $orderBy, $orderType)
	{
		$where = "";
		$cond = array();
	  	if (isset($filter))
	  	{
			if (!empty($filter->keyword))
			{
				  $cond[] = "(lower(".$this->key.") like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								 or lower(b.id_barang) like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								 or lower(b.nama) like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								 or lower(k.nama) like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								 or lower(pg.status) like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								 or lower(p.id_pelanggan) like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								 or lower(p.nama) like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								 or lower(kk.nama) like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								 or lower(kk.id_kurir) like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								 or lower(k.id_kategori) like '%" . $this->db->escape_str(strtolower($filter->keyword)) . "%'
								)";
			}
			
			if (!empty($filter->status))
			{
				if(strtolower($filter->status) != "all")
					$cond[] = "(pg.status = '" . $this->db->escape_str(strtolower($filter->status)) . "')"; 
			}
			
			if (!empty($filter->from) || !empty($filter->to))
			{
				$cond[] = "(pg.tanggal >= '" . $this->db->escape_str($filter->from) . "' and pg.tanggal <= '" . $this->db->escape_str($filter->to) . "' )"; 
			}
			
			if(!empty($cond))
				$where = " where ". implode(" and ", $cond);
	  	}
	    
		$limitOffset = "LIMIT $offset,$limit";
		if($limit == 0)
			$limitOffset = "";
		
		if(!$orderBy)
			$orderBy = $this->key;
		
		if(!$orderType)
			$orderType = "asc";
			
		$query = $this->db->query("SELECT SQL_CALC_FOUND_ROWS pg.*,k.nama kategori,k.keterangan kategori_keterangan,kr.nama kurir,p.nama pelanggan,p.alamat
								   ,group_concat(concat(dp.id_barang,'|',b.nama,'|',k.nama,'|',b.satuan,'|',dp.qty,'|',b.del_no)  order by b.nama SEPARATOR '===')  as barang
								   FROM ".$this->table." pg
								   LEFT JOIN detail_pengiriman dp on dp.id_pengiriman = dp.id_pengiriman
								   LEFT JOIN barang b on b.id_barang = dp.id_barang
								   LEFT JOIN kategori k on k.id_kategori = b.id_kategori
								   LEFT JOIN kurir kr on kr.id_kurir = pg.id_kurir
								   LEFT JOIN pelanggan p on p.id_pelanggan = pg.id_pelanggan
								   $where group by pg.id_pengiriman ORDER BY $orderBy $orderType $limitOffset
								   ");
								   
		$result = $query->result_array();
		$query->free_result();
		
		$total = $this->db->query('SELECT found_rows() total_row')->row()->total_row;
		
		return array($result,$total);
	}
	
	public function get_by($field, $value = "",$obj = false)
	{
		if(!$field)
			$field = $this->key;
			
		$where = "WHERE $field = '".$this->db->escape_str(strtolower($value))."'";
		$query = $this->db->query("SELECT SQL_CALC_FOUND_ROWS pg.*,k.nama kategori,k.keterangan kategori_keterangan,kr.nama kurir,p.nama pelanggan,p.alamat
								   ,group_concat(concat(dp.id_barang,'|',b.nama,'|',k.nama,'|',b.satuan,'|',dp.qty,'|',b.del_no)  order by b.nama SEPARATOR '===')  as barang
								   FROM ".$this->table." pg
								   LEFT JOIN detail_pengiriman dp on dp.id_pengiriman = dp.id_pengiriman
								   LEFT JOIN barang b on b.id_barang = dp.id_barang
								   LEFT JOIN kategori k on k.id_kategori = b.id_kategori
								   LEFT JOIN kurir kr on kr.id_kurir = pg.id_kurir
								   LEFT JOIN pelanggan p on p.id_pelanggan = pg.id_pelanggan
								   $where group by pg.id_pengiriman 
								   ");
		
		if(!$obj)
			$result = $query->result_array();
		else
			$result = $query->row();
			
		$query->free_result();
		
		return $result;
	}
	
	function remove($id)
    {
      if (!is_array($id))
		    $id = array($id);
			
		$this->db->where_in($this->key, $id)->delete($this->table);
    }
	
	function save($id = "",$data = array(), $insert_id = false)
	{
		
		if (!empty($id))
		{
			$this->db->where($this->key, $id);
			$this->db->update($this->table, $data);
		}
		else
		{
			$this->db->insert($this->table, $data);
		}
		
		return $this->db->affected_rows();
	}
	
	public function get_last()
	{
		$query = $this->db->query("SELECT  * FROM ".$this->table." order by ".$this->key." desc limit 0,1");
		$result = $query->row();
		$query->free_result();
		
		return $result;
	}
	function remove_detail($id)
    {
      if (!is_array($id))
		    $id = array($id);
			
		$this->db->where_in($this->key, $id)->delete("detail_pengiriman");
    }
	
	function save_detail($data = array())
	{
		$this->db->insert("detail_pengiriman", $data);	
		return $this->db->affected_rows();
	}
}