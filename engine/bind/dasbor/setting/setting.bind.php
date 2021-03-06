<div class="row" id='divSetting'>
    <div class="col-12 col-sm-6 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Pengaturan Umum</h4>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Basic</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Akun</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                            aria-controls="contact" aria-selected="false">Keuangan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="other-tab" data-toggle="tab" href="#other" role="tab"
                            aria-controls="other" aria-selected="false">Lainnya</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="form-group">
                            <label>Nama Restoran</label>
                            <input type="text" class="form-control" id='txtNamaResto' v-model='namaResto' disabled>
                        </div>
                        <div class="form-group">
                            <label>Alamat Restoran </label><small> Pisahkan daerah dengan koma (,). Cth Kec. Pariaman,
                                Kab. Pariaman, Sumatera Barat</small>
                            <input type="text" class="form-control" id='txtAlamatResto' v-model='alamatResto' disabled>
                        </div>
                        <div class="form-group">
                            <label>Nama Owner</label>
                            <input type="text" class="form-control" id='txtNamaOwnser' v-model='namaOwner' disabled>
                        </div>
                        <div class="form-group">
                            <label>Nomor Handphone Restoran</label>
                            <input type="text" class="form-control" id='txtHpRestoran' v-model='nomorHandphone' disabled>
                        </div>
                        <div class="form-group">
                            <label>Email Restoran</label>
                            <input type="text" class="form-control" id='txtEmailRestoran' v-model='emailResto' disabled>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="form-group">
                            <label>Email Host </label><small>(Alamat email untuk pengiriman notifikasi ke
                                pelanggan)</small>
                            <input type="text" class="form-control" id='txtEmailHost' v-model='emailHost' disabled>
                        </div>
                        <div class="form-group">
                            <label>Password Email Host </label><small>(Password akun email untuk pengiriman notifikasi
                                ke
                                pelanggan)</small>
                            <input type="text" class="form-control" id='txtPasswordEmailHost' v-model='emailHostPassword' disabled>
                        </div>
                        <div class="form-group">
                            <label>API Key Waresponder </label><small>(API Key dari wa responder untuk aktifkan
                                notifikasi via whatsapp)</small>
                            <input type="text" class="form-control" id='txtApiKey' v-model='apiWaResponder' disabled>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="form-group">
                            <label>Tahun pembukuan awal</label>
                            <input type="number" class="form-control" id='txtPembukuanAwal' v-model='awalPembukuan' disabled>
                        </div>
                        <div class="form-group">
                            <label>Saldo Awal</label>
                            <input type="number" class="form-control" id='txtSaldoAwal' v-model='saldoAwal' disabled>
                        </div>
                        <div class="form-group">
                            <label>Pajak (pph & ppn)</label>
                            <input type="number" class="form-control" id='txtPajak' v-model='tax' disabled>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="other-tab">
                        <div class="form-group">
                            <label>Koneksi Printer</label>
                            <select class="form-control" disabled>
                                <option>USB</option>
                                <option>LAN</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Alamat IP Printer (Kasir)</label>
                            <input type="text" class="form-control" id='txtIpPrinter' v-model='ipAddressPrintKasir' disabled>
                        </div>
                        <div class="form-group">
                            <label>Alamat IP Printer (Dapur)</label>
                            <input type="text" class="form-control" id='txtIpDapur' v-model='ipAddressPrintKichen' disabled>
                        </div>
                        <div class="form-group">
                            <label>Alamat IP Printer (Other)</label>
                            <input type="text" class="form-control" id='txtIpOther' v-model='ipAddressPrintOther' disabled>
                        </div>
                    </div>
                </div>
                <div>
                    <a href='#!' class="btn btn-lg btn-primary btn-icon icon-left" v-on:click='updateAtc'><i :class='btnClass'></i> {{btnCap}}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-6">
    <div class="card card-primary">
        <div class="card-header">
        <h4>Detail Informasi Restoran</h4>
        </div>
        <div class="card-body">
            <div style="text-align: center;">
            <img v-bind:src="'ladun/'+logo" style="width: 200px;">
            </div>
            <table class="table">
                <tr>
                    <td>Nama Restoran</td><td style="text-align: left;">{{namaResto}}</td>
                </tr>
                <tr>
                    <td>Nama Owner</td><td style="text-align: left;">{{namaOwner}}</td>
                </tr>
                <tr>
                    <td>Nomor Handphone Restoran</td><td style="text-align: left;">{{nomorHandphone}}</td>
                </tr>
                <tr>
                    <td>Alamat Restoran</td><td style="text-align: left;">{{alamatResto}}</td>
                </tr>
                <tr>
                    <td>Email Restoran</td><td style="text-align: left;">{{emailResto}}</td>
                </tr>
                <tr>
                    <td>Email Host</td><td style="text-align: left;">{{emailHost}}</td>
                </tr>
                <tr>
                    <td>API Key Wa</td><td style="text-align: left;">{{apiWaResponder}}</td>
                </tr>
                <tr>
                    <td>Tahun Pembukuan Awal</td><td style="text-align: left;">{{awalPembukuan}}</td>
                </tr>
                <tr>
                    <td>Saldo Awal</td><td style="text-align: left;">Rp. {{ Number(saldoAwal).toLocaleString() }}</td>
                </tr>
                <tr>
                    <td>Pajak</td><td style="text-align: left;">{{tax}}</td>
                </tr>
                

            </table>
        </div>
    </div>    
</div>
</div>
<script src="<?=STYLEBASE; ?>/dasbor/setting.js"></script>