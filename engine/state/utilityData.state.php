<?php 

class utilityData{
   
    private $st;

    public function __construct()
    {
        $this -> st = new state;
    }

    public function getNamaPelanggan($kdPelanggan)
    {
        $this -> st -> query("SELECT nama FROM tbl_pelanggan WHERE id_pelanggan='$kdPelanggan';");
        $qP = $this -> st -> querySingle();
        return $qP['nama'];
    }

}