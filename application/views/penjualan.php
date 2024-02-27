<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">

    <div id="menghilang">
        <?= $this->session->flashdata('notifikasi') ?>
    </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Penjualan Hari ini</h3>
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                            data-target="#modalTambah"><i class="fas fa-plus"></i> Add Penjualan</button>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Nota</th>
                                    <th>Nominal</th>
                                    <th>Pelanggan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($penjualan as $p) { ?>
                                    <tr>
                                        <th scope="row">
                                            <?= $no; ?>
                                        </th>
                                        <td>
                                            <?= $p['kode_penjualan'] ?>
                                        </td>
                                        <td>
                                            Rp.<?= number_format($p['total_harga']) ?>
                                        </td>
                                        <td>
                                            <?= $p['pelanggan_nama'] ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('penjualan/invoice/'.$p['kode_penjualan']) ?>"
                                                class="btn btn rounded-pill btn-warning"><i class="fas fa-check"></i>
                                                cek penjualan</a>
                                        </td>
                                    </tr>
                                    <?php $no++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modalTambah">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Penjualan</h4>
            </div>
                <div class="modal-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No Telp</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($pelanggan as $plg) { ?>
                                <tr>
                                    <th scope="row">
                                        <?= $no; ?>
                                    </th>
                                    <td>
                                        <?= $plg['pelanggan_nama'] ?>
                                    </td>
                                    <td>
                                        <?= $plg['pelanggan_alamat'] ?>
                                    </td>
                                    <td>
                                        <?= $plg['pelanggan_telp'] ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('penjualan/transaksi/' . $plg['pelanggan_id']); ?>"
                                            class="btn btn-sm rounded-pill btn-success"><i class="fas fa-check"></i>
                                            Pilih</a>
                                    </td>
                                </tr>
                                <?php $no++;
                            } ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>