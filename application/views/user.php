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
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Pangkat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($user as $u) { ?>
                                    <tr>
                                        <th scope="row">
                                            <?= $no; ?>
                                        </th>
                                        <td>
                                            <?= $u['nama'] ?>
                                        </td>
                                        <td>
                                            <?= $u['username'] ?>
                                        </td>
                                        <td>
                                            <?= $u['level'] ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo site_url('user/delete_data/' . $u['user_id']); ?>"
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
                                                            <h4 class="modal-title">Tambah User</h4>
                                                        </div>
                                                        <form action="<?= base_url('user/update') ?>" method="post">
                                                            <input type="hidden" name="user_id"
                                                                value="<?= $u['user_id'] ?>">
                                                            <div class="modal-body">
                                                            <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Username</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control"
                                                                            name="produk_harga"
                                                                            value="<?= $u['username'] ?>" readonly></input>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Nama User</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" name="nama"
                                                                            value="<?= $u['nama'] ?>"></input>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">Pangkat</label>
                                                                    <div class="col-sm-10">
                                                                        <select class="form-control" name="level">
                                                                            <option value="">-- pilih --</option>
                                                                            <option value="admin" <?= ($u['level'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                                                            <option value="pegawai" <?= ($u['level'] == 'pegawai') ? 'selected' : ''; ?>>Pegawai</option>
                                                                        </select>
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
                <h4 class="modal-title">Tambah User</h4>
            </div>
            <form action="<?= base_url('user/simpan') ?>" method="post">
                <div class="modal-body">    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" required name="username"
                                placeholder="Username"></input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama User</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" required name="nama"
                                placeholder="Nama User"></input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" required name="password"
                                placeholder="Password"></input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Pangkat</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="level">
                                <option value="">-- pilih --</option>
                                <option value="admin" <?= ($u['level'] == 'admin'); ?>>Admin</option>
                                <option value="pegawai" <?= ($u['level'] == 'pegawai'); ?>>Pegawai
                                </option>
                            </select>
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