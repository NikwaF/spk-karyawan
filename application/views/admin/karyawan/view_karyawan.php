
<link rel="stylesheet" type="text/css" href="<?= base_url('vendor/') ?>app-assets/vendors/css/tables/datatable/datatables.min.css">
<script src="<?= base_url('vendor/') ?>app-assets/vendors/js/datatable/datatables.min.js"></script>
<div class="main-panel">
        <div class="main-content">
          <div class="content-wrapper">
            <div class="container-fluid"><div class="row">

</div>
<!--Basic Table Starts-->

<section id="simple-table">
<?php if($this->session->flashdata('key')): ?>
    <div class="alert alert-<?= $this->session->flashdata('key') ?> alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata($this->session->flashdata('key'));?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>   
        
<?php endif; ?>
    <div class="row">
    <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-title-wrap bar-<?= $mode === 'tambah' ? 'success' : 'warning'?>">
                        <h4 class="card-title"><?= $mode === 'tambah' ? 'Tambah Data' : 'Edit Data'?></h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-block">
                      <form action="<?= $mode === 'tambah' ? site_url('karyawan/insert') : site_url('karyawan/update') ?>" method="POST">
                      <div class="form-body">
                      <div class="form-group">
                      <label for="eventInput1">Divisi</label>
                      <select name="divisi" id="divisi" class="custom-select d-block w-100">
                        <?php foreach($divisi as $div): ?>
                            <option <?= $mode === 'edit' && $data_edit->id_divisi === $div->id_divisi ? 'selected' : '' ?> value="<?= $div->id_divisi ?>"><?= $div->nm_divisi ?></option>
                        <?php endforeach; ?>

                      </select>
                      <?= form_error('divisi', '<ul role="alert"><li style="color:red;">','</li></ul>') ;?>  
                    </div>                       
                    <div class="form-group <?= form_error('nama_karyawan') ? 'error' : '' ?>">
                        <label for="eventInput1">Nama Karyawan</label>
                        <input type="text" id="eventInput1" class="form-control" name="nama_karyawan" value="<?= $mode === 'tambah' ? form_error('nama_karyawan') ? set_value('nama_karyawan') : '' : $data_edit->nama ?>">
                        <?= form_error('nama_karyawan', '<ul role="alert"><li style="color:red;">','</li></ul>') ;?> 
                    </div>
                    <div class="form-group <?= form_error('umur') ? 'error' : '' ?>">
                        <label for="eventInput1">Umur</label>
                        <input type="number" id="eventInput1" class="form-control" name="umur" value="<?= $mode === 'tambah' ? form_error('umur') ? set_value('umur') : '' : $data_edit->umur ?>">
                        <?= form_error('umur', '<ul role="alert"><li style="color:red;">','</li></ul>') ;?> 
                    </div>                    
                    <div class="form-group <?= form_error('no_hp') ? 'error' : '' ?>">
                        <label for="eventInput1">Nomer hp</label>
                        <input type="text" id="eventInput1" class="form-control" name="no_hp" value="<?= $mode === 'tambah' ? form_error('no_hp') ? set_value('no_hp') : '' : $data_edit->no_hp ?>">
                        <?= form_error('no_hp', '<ul role="alert"><li style="color:red;">','</li></ul>') ;?>
                    </div>
                    <div class="form-group <?= form_error('kelamin') ? 'error' : '' ?>">
                      <label for="eventInput1">Jenis Kelamin</label>
                      <select name="kelamin" id="kelamin" class="custom-select d-block w-100">
                        <option <?= $mode === 'edit' && $data_edit->jns_kelamin === 'l' ? 'selected' : '' ?> value="l">Laki-laki</option>
                        <option <?= $mode === 'edit' && $data_edit->jns_kelamin === 'p' ? 'selected' : '' ?> value="p">Perempuan</option>
                      </select>
                      <?= form_error('kelamin', '<ul role="alert"><li style="color:red;">','</li></ul>') ;?>
                    </div>                    
                    <div class="form-group <?= form_error('tgl_lahir') ? 'error' : '' ?>">
                        <label for="eventInput1">Tanggal Lahir</label>
                        <input type="date" id="eventInput1" class="form-control" name="tgl_lahir" value="<?= $mode === 'tambah' ? form_error('tgl_lahir') ? set_value('tgl_lahir') : '' : date("Y-m-d", strtotime($data_edit->tgl_lahir))  ?>">
                        <?= form_error('tgl_lahir', '<ul role="alert"><li style="color:red;">','</li></ul>') ;?>
                    </div>
                    <?php if($mode === 'edit'): ?>
                        <input type="hidden" id="eventInput1" class="form-control" name="id" value="<?= $mode === 'edit' ? $data_edit->id_karyawan : '' ?>">
                    <?php endif; ?>
                    <div class="form-group <?= form_error('alamat') ? 'error' : '' ?>">
                      <label for="eventInput1">Alamat</label>
                      <textarea name="alamat" class="form-control" id="alamat" rows="5"><?= $mode === 'tambah' ? form_error('alamat') ? set_value('alamat') : '' : $data_edit->alamat ?></textarea>
                      <?= form_error('alamat', '<ul role="alert"><li style="color:red;">','</li></ul>') ;?>
                    </div>                    

                    
                    <div class="form-actions center">
                        <button type="submit" class="btn btn-<?= $mode === 'tambah' ? 'success' : 'warning'?>">
                            <i class="icon-note"></i> <?= $mode === 'tambah' ? 'Simpan' : 'Edit'?>
                        </button>
                    </div>                    
                        </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>      
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-title-wrap bar-success">
                        <h4 class="card-title">Data Karyawan Aktif</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-block">
                        <table class="table" id="tabel-aktif">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Divisi</th>
                                    <th>Kelamin</th>
                                    <th>Tgl lahir</th>
                                    <th>No hp</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(count($isinya['aktif']) !== 0):?>
                                <?php $no=1; foreach($isinya['aktif'] as $aktif): ?>
                                <tr>
                                    <th scope="row"><?= $no ?></th>
                                    <td class="text-capitalize"><?= $aktif->nama ?></td>
                                    <td class="text-capitalize"><?= $aktif->nm_divisi ?></td>
                                    <td><?= $aktif->jns_kelamin === 'l' ? 'laki-laki' : 'perempuan' ?></td>
                                    <td><?= tgl_indo($aktif->tgl_lahir) ?></td>
                                    <td><?= $aktif->no_hp ?></td>
                                    <td><a href="<?= site_url('karyawan/edit/').$aktif->id_karyawan ?>" class="btn btn-sm btn-warning"><i class="icon-pencil"></i></a> <a href="<?= site_url('karyawan/nonaktifkan/').$aktif->id_karyawan ?>" class="btn btn-sm btn-danger"><i class="icon-lock"></i></a></td>
                                </tr>
                                <?php $no++; endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title-wrap bar-danger">
                        <h4 class="card-title">Data Karyawan Non Aktif</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-block">
                        <table class="table" id="tabel-non-aktif">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Divisi</th>
                                    <th>Kelamin</th>
                                    <th>Tgl lahir</th>
                                    <th>No hp</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(count($isinya['nonaktif']) !== 0):?>
                                <?php $no=1; foreach($isinya['nonaktif'] as $nonaktif): ?>
                                <tr>
                                    <th scope="row"><?= $no ?></th>
                                    <td class="text-capitalize"><?= $nonaktif->nama ?></td>
                                    <td class="text-capitalize"><?= $nonaktif->nm_divisi ?></td>
                                    <td><?= $nonaktif->jns_kelamin === 'l' ? 'laki-laki' : 'perempuan' ?></td>
                                    <td><?= tgl_indo($nonaktif->tgl_lahir) ?></td>
                                    <td><?= $nonaktif->no_hp ?></td>
                                    <td><a href="<?= site_url('karyawan/aktifkan/').$nonaktif->id_karyawan ?>" class="btn btn-sm btn-success"><i class="icon-lock-open"></i></a></td>
                                </tr>
                                <?php $no++; endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</section>

<script>
    $('#tabel-aktif').DataTable({"pageLength": 5,"lengthMenu": [[5,10],[5,10]]});
    $('#tabel-non-aktif').DataTable({"pageLength": 5,"lengthMenu": [[5,10],[5,10]]});
</script>
<!--Basic Table Ends-->