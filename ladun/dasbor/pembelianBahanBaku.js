var arrItemDipilih = [];
var divPembelian = new Vue({
    el : '#divPembelian',
    data : {
        itemBahanBaku : [],
        kategoriDipilih : '',
        itemDipilih : [],
        mitra : '',
        nominal : 0
    },
    methods : {
        tambahPembelianAtc : function()
        {
            tambahPembelian();
        },
        kembaliAtc : function()
        {
            kembali();
        },
        setItem : function()
        {
            setItem(this.kategoriDipilih);
        },
        tambahItemAtc : function(kdBahan, satuan, nama)
        {
            tambahItem(kdBahan, satuan, nama);
        },
        hapusItemAtc : function(kdBahan)
        {
            hapusItem(kdBahan);
        },
        prosesAtc : function()
        {
            proses();
        }
    }
});

//inisialisasi 
$('#pembelianBaru').hide();
$(".select2").select2();
var nominal = document.getElementById('txtNominal');
$('#tblHistoryPembelian').dataTable();

function proses()
{
    let nominal = divPembelian.nominal;
    let mitra = divPembelian.mitra;
    let cekItem = divPembelian.itemDipilih.length;
    // console.log(mitra);
    let dataSend = {'mitra':mitra, 'nominal':nominal}
    if(nominal === '' || nominal === 0 || mitra === '' || cekItem === 0 || nominal < 1){
        pesanUmumApp('error', 'warning', 'Isi field!!, dan pastikan nominal benar');
    }else{
        Swal.fire({
            title: "Konfirmasi pembelian?",
            text: "Proses pembelian bahan baku?",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
          }).then((result) => {
            if(result.value) {
                //buat pesanan 
                // console.log(dataSend);
              $.post('pengeluaran/prosesPembelian', dataSend, function(data){
                let obj = JSON.parse(data);
                let kdPembelian = obj.kdPembelian;
                let itemPesanan = divPembelian.itemDipilih;
                itemPesanan.forEach(renderTemp);
                function renderTemp(item, index){
                    let dts = {'kdPembelian':kdPembelian, 'kdItem':itemPesanan[index].kdBahan, 'qt':itemPesanan[index].value}
                    $.post('pengeluaran/updateTempPembelian', dts, function(data){
                    });
                }
                pesanUmumApp('success', 'Sukses', 'Pembelian bahan baku item sukses..');
                renderMenu(pembelianBahanBaku);
                divJudul.judulForm = "Pembelian bahan baku";
              });
            }
          });
    }

}

nominal.addEventListener('keyup', function(e){
    divPembelian.nominal = this.value;
    nominal.value = formatRupiah(this.value, 'Rp.');
});

function setMitra()
{
    divPembelian.mitra = document.getElementById('txtMitra').value;
}

function hapusItem(kdBahan)
{
    let cekArray = arrItemDipilih.includes(kdBahan);
    if(cekArray === true){
        let cekPos = arrItemDipilih.indexOf(kdBahan);
        console.log(cekPos);
        arrItemDipilih.splice(cekPos, 1);
        divPembelian.itemDipilih.splice(cekPos, 1);
    }else{
        pesanUmumApp('warning', 'No item', 'Tidak ada item untuk dihapus!!');
    }
}

function tambahItem(kdBahan, satuan, nama)
{
    let valueItem = document.getElementById(kdBahan).value;
    let cekArray = arrItemDipilih.includes(kdBahan);
    if(cekArray === true){
        let cekPos = arrItemDipilih.indexOf(kdBahan);
        divPembelian.itemDipilih[cekPos].value = valueItem;
    }else{
        if(valueItem === '' || valueItem === '0'){
            pesanUmumApp('warning', 'Isi nilai', 'Masukkan nilai item!!');
        }else{
            arrItemDipilih.push(kdBahan);
            divPembelian.itemDipilih.push({
                nama : nama,
                satuan : satuan,
                value : valueItem,
                kdBahan : kdBahan
            });
        }
    }
    // console.log(arrItemDipilih);
}

function setItem(kategori)
{
    $.post('pengeluaran/getDataBahanBakuKategori', {'kategori':kategori}, function(data){
        let obj = JSON.parse(data);
        let bb = obj.bahanBaku;
        let pjgArray = divPembelian.itemBahanBaku.length;
        var i;
        for(i = 0; i < pjgArray; i++){
            divPembelian.itemBahanBaku.splice(0,1);
        }
        bb.forEach(renderItem);
        function renderItem(item, index)
        {
            divPembelian.itemBahanBaku.push({
                nama : bb[index].nama,
                satuan : bb[index].satuan,
                kdBahan : bb[index].kd_bahan
            });
        }
    });
}

function setKategori()
{
   divPembelian.kategoriDipilih = document.getElementById('txtKategori').value;
   $('.txtNilai').val('');
   divPembelian.setItem();
}

function tambahPembelian()
{
    $('#historyPembelian').hide();
    $('#pembelianBaru').show();
}

function kembali()
{
    renderMenu(pembelianBahanBaku);
    divJudul.judulForm = "Pembelian bahan baku";
}

function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
}