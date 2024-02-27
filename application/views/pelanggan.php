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
                        <h3 class="card-title">Data Pelanggan</h3>
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                            data-target="#modalTambah">+ Add Pelanggan</button>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
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
                                            <a href="<?php echo site_url('pelanggan/delete_data/' . $plg['pelanggan_id']); ?>"
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
                                                            <h4 class="modal-title">Tambah pelanggan</h4>
                                                        </div>
                                                        <form action="<?= base_url('pelanggan/update') ?>" method="post">
                                                            <input type="hidden" name="pelanggan_id"
                                                                value="<?= $plg['pelanggan_id'] ?>">
                                                            <div class="modal-body">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Nama
                                                                        pelanggan</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control"
                                                                            name="pelanggan_nama" required
                                                                            value="<?= $plg['pelanggan_nama'] ?>"></input>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Alamat</label>
                                                                    <div class="col-sm-10">
                                                                        <textarea type="text" class="form-control"
                                                                            name="pelanggan_alamat"  required><?= $plg['pelanggan_alamat'] ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">No Telepon</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="number" class="form-control"
                                                                            name="pelanggan_telp" required
                                                                            value="<?= $plg['pelanggan_telp'] ?>"></input>
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
                <h4 class="modal-title">Tambah pelanggan</h4>
            </div>
            <form action="<?= base_url('pelanggan/simpan') ?>" method="post">
                <div class="modal-body">

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama pelanggan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" required name="pelanggan_nama"
                                placeholder="Nama pelanggan"></input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control" required name="pelanggan_alamat"
                                placeholder="Alamat"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">No Telepon</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" required name="pelanggan_telp"
                                placeholder="Telpon"></input>
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