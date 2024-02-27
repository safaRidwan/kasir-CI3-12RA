
<?php $tanggalHariIni = date("d-m-Y"); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="callout callout-info">
                    <h5><i class="fas fa-info"></i> Catatan:</h5>
                    Periksa kembali, pastikan data sesuai.
                </div>

                <div class="invoice p-3 mb-3">
                    <div class="row">
                        <div class="col-12">
                            <h4>
                            <img src="<?= base_url('asset/AdminLTE/') ?>dist/img/credit/rexus.png" width="50">
                                Dwan Maret ID.
                                <small class="float-right">
                                    Tanggal:
                                    <?= $tanggalHariIni; ?>
                                </small>
                            </h4>
                        </div>
                    </div>

                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong>Musafa Ridwan</strong><br>
                                Tempursari, Gentungan, Mojogedang, Karanganyar<br>
                                Phone: +62 812 2899 1969<br>
                            </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong>
                                    <?= $penjualan->pelanggan_nama ?>
                                </strong><br>
                                <?= $penjualan->pelanggan_alamat ?><br>
                                Phone:
                                <?= $penjualan->pelanggan_telp ?><br>
                            </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <b>No nota: #<?= $nota ?>
                            </b>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    $total = 0;
                                    foreach ($detail as $dtl) { ?>
                                        <tr>
                                            <th scope="row">
                                                <?= $no; ?>
                                            </th>
                                            <td>
                                                <?= $dtl['produk_kode'] ?>
                                            </td>
                                            <td>
                                                <?= $dtl['produk_nama'] ?>
                                            </td>
                                            <td>
                                                <?= $dtl['jumlah'] ?>
                                            </td>
                                            <td>Rp.
                                                <?= number_format($dtl['produk_harga']) ?>
                                            </td>
                                            <td>Rp.
                                                <?= number_format($dtl['jumlah'] * $dtl['produk_harga']) ?>
                                            </td> hapus</a>
                                            </td>
                                        </tr>
                                        <?php $no++;
                                        $total = $total + $dtl['jumlah'] * $dtl['produk_harga'];
                                    } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-6">
                            <p class="lead">Metode Pembayaran:</p>
                            <img src="<?= base_url('asset/AdminLTE/') ?>dist/img/credit/shopeepay2.jpg" width="80">
                            <img src="<?= base_url('asset/AdminLTE/') ?>dist/img/credit/bri.jpg" width="60">
                            <img src="<?= base_url('asset/AdminLTE/') ?>dist/img/credit/mandiri.jpg" width="60">
                            <img src="<?= base_url('asset/AdminLTE/') ?>dist/img/credit/ovo.jpg" width="70">
                            <img src="<?= base_url('asset/AdminLTE/') ?>dist/img/credit/dana.jpg" width="85">
                            <img src="<?= base_url('asset/AdminLTE/') ?>dist/img/credit/gopay.jpg" width="90">

                            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                        </div>

                        <div class="col-6">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Total:</th>
                                            <td>Rp.
                                                <?= number_format($total); ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>


                    <div class="row no-print">
                        <div class="col-12">
                            <button type="button" class="btn btn-warning float-right" onclick="window.print()"><i class="fas fa-print"></i>
                                Print Invoice
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
