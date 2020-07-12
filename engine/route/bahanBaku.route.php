<?php

class bahanBaku extends Route{

    private $sn = 'bahanBakuData';

    public function index()
    {
        $data['bahanBaku'] = $this -> state($this -> sn) -> getDataBahanBaku();
        $this -> bind('dasbor/bahanBaku/bahanBaku', $data);
    }

    public function tambahBahanBaku()
    {
        $nama = $this -> inp('nama');
        $deks = $this -> inp('deks');
        $satuan = $this -> inp('satuan');
        $kategori = $this -> inp('kategori');
        $stok = $this -> inp('stok');
        $kdBahan = $this -> rnint(4);
        //cek kode bahan & nama 
        $cek = $this -> state($this -> sn) -> cekNamaBahan($nama);
        if($cek === true){
            $data['status'] = 'error';
        }else{
            $this -> state($this -> sn) -> tambahBahan($kdBahan, $nama, $deks, $kategori, $satuan, $stok);
            $data['status'] = 'success';
        }
        $this -> toJson($data);
    }

}