<?php

class meja extends Route{

    private $sn = 'mejaData';

    public function index()
    {   $data['meja'] = $this -> state($this -> sn) -> getDataMeja();     
        $this -> bind('dasbor/meja/meja', $data);
    }

    public function prosesTambahMeja()
    {
        $kdMeja = $this -> rnint(4);
        $nama = $this -> inp('namaMeja');
        $deks = $this -> inp('deks');
        $waktu = $this -> waktu();
        //cek apakah nama meja sudah ada
        $jlhMeja = $this -> state($this -> sn) -> cekMeja($nama);
        if($jlhMeja < 1){
            $data['status'] = 'sukses';
            $this -> state($this -> sn) -> tambahMeja($kdMeja, $nama, $deks, $waktu); 
        }else{
            $data['status'] = 'meja_name_error';
        }
        $this -> toJson($data);
    }

}