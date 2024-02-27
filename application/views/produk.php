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
                        <h3 class="card-title">Data Produk</h3>
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                            data-target="#modalTambah">+ Add Produk</button>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($produk as $p) { ?>
                                    <tr>
                                        <th scope="row">
                                            <?= $no; ?>
                                        </th>
                                        <td>
                                            <?= $p['produk_kode'] ?>
                                        </td>
                                        <td>
                                            <?= $p['produk_nama'] ?>
                                        </td>
                                        <td>
                                            Rp.<?= number_format($p['produk_harga']) ?>
                                        </td>
                                        <td>
                                            <?= number_format($p['produk_stok']) ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo site_url('produk/delete_data/' . $p['produk_id']); ?>"
                                                class="btn btn-sm rounded-pill btn-danger"
                                                onclick="return confirm('yakin deck, mau hapus?')">
                                                hapus</a>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-sm rounded-pill btn-warning"
                                                data-toggle="modal" data-target="#modalEdit<?= $no; ?>">
                                                edit
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="modalEdit<?= $no; ?>">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Tambah Produk</h4>
                                                        </div>
                                                        <form action="<?= base_url('produk/update') ?>" method="post">
                                                            <input type="hidden" name="produk_id"
                                                                value="<?= $p['produk_id'] ?>">
                                                            <div class="modal-body">
                                                            
                                                            <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Kode
                                                                        Produk</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control"
                                                                            name="produk_kode"
                                                                            value="<?= $p['produk_kode'] ?>"></input>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Nama
                                                                        Produk</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control"
                                                                            name="produk_nama"
                                                                            value="<?= $p['produk_nama'] ?>"></input>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Harga</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control"
                                                                            name="produk_harga"
                                                                            value="<?= $p['produk_harga'] ?>"></input>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Stok</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="number" class="form-control"
                                                                            name="produk_stok"
                                                                            value="<?= $p['produk_stok'] ?>"></input>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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
                <h4 class="modal-title">Tambah Produk</h4>
            </div>
            <form action="<?= base_url('produk/simpan') ?>" method="post">
                <div class="modal-body">

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kode Produk</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" required name="produk_kode"
                                placeholder="Kode Produk"></input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama Produk</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" required name="produk_nama"
                                placeholder="Nama Produk"></input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" required name="produk_harga"
                                placeholder="Harga"></input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Stok</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" required name="produk_stok"
                                placeholder="Stok"></input>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>