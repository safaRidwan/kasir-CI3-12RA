<div id="menghilang">
    <?= $this->session->flashdata('notifikasi') ?>
</div>

<div class="row">
    <div class="col-md-4">
        <!-- pemilihan produk -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Pilih Produk</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Pelanggan</label>
                    <input type="text" name="kode_penjualan" class="form-control" value="<?= $namapelanggan; ?>"
                        readonly>
                </div>
                <form action="<?= base_url('penjualan/addtemp') ?>" method="post">
                <input type="hidden" name="pelanggan_id" value="<?= $pelanggan_id ?>">
                    <div class="form-group">
                        <label>Produk</label>
                        <input type="hidden" name="kode_penjualan" value="<?= $nota; ?>">
                        <select name="produk_id" class="form-control">
                            <?php foreach ($produk as $p) { ?>
                                <option value="<?= $p['produk_id'] ?>">
                                    <?= $p['produk_nama'] ?> - (
                                    <?= $p['produk_stok'] ?>)
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" placeholder="Jumlah yang dijual"
                            required>
                    </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Tambah Keranjang</button>
            </div>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <!-- Tabel penjualan -->
        <div class="card">
            <div class="card-header">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Sub Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; $cek=0;
                        $total = 0;
                        foreach ($temp as $dtl) { ?>
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
                                    <?php
                                        if($dtl['jumlah']>$dtl['produk_stok']){
                                            echo '<span class="badge bg-warning">stok tidak cukup!</span>';
                                            $cek=1;
                                        }
                                    ?>
                                </td>
                                <td>Rp.
                                    <?= number_format($dtl['produk_harga']) ?>
                                </td>
                                <td>Rp.
                                    <?= number_format($dtl['jumlah'] * $dtl['produk_harga']) ?>
                                </td>

                                <td>
                                    <a href="<?php echo site_url('penjualan/hapus_temp/' . $dtl['temp_id']); ?>"
                                        class="btn btn-sm rounded-pill btn-danger"
                                        onclick="return confirm('yakin deck, mau hapus produk dari keranjang?')">
                                        hapus</a>
                                </td>
                            </tr>
                            <?php $no++;
                            $total = $total + $dtl['jumlah'] * $dtl['produk_harga'];
                        } ?>
                        <tr>
                            <td colspan="5"><strong>Total Harga</strong></td>
                            <td>Rp.
                                <?= number_format($total); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- bayaran -->
            <form action="<?= base_url('penjualan/bayarv2') ?>" method="post">
                <div class="card-footer">
                    <input type="hidden" name="pelanggan_id" value="<?= $pelanggan_id; ?>">

                    <?php if (($temp<>NULL) AND ($cek==0)) { ?>
                        <button type="submit" class="btn btn-primary">Bayar</button>
                    <?php } ?>
                </div>
            </form>
        </div>


    </div>

</div>