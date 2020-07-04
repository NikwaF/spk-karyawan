
<link rel="stylesheet" type="text/css" href="<?= base_url('vendor/') ?>app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
<script src="<?= base_url('vendor/') ?>app-assets/vendors/js/datatable/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
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
                      <form action="<?= $mode === 'tambah' ? site_url('kriteria/insert') : site_url('kriteria/update') ?>" method="POST">
                      <div class="form-body">
                      <div class="form-group <?= form_error('tahun') ? 'error' : '' ?>">
                        <label for="eventInput1">Tahun</label>
                        <input type="text" id="eventInput1" class="form-control" name="tahun" value="<?= $mode === 'tambah' ? form_error('tahun') ? set_value('tahun') : '' : $data_edit->tahun ?>">
                        <?= form_error('tahun', '<ul role="alert"><li style="color:red;">','</li></ul>') ;?> 
                    </div>                   
                    <div class="form-group">
                    <label for="eventInput1">Periode</label>
                      <select name="periode" id="kelamin" class="custom-select d-block w-100">
                        <option value="1" <?= $mode === 'edit' && $data_edit->periode === 'l' ? 'selected' : '' ?>>1</option>
                        <option value="2" <?= $mode === 'edit' && $data_edit->periode === '2' ? 'selected' : '' ?>>2</option>
                      </select>
                    </div>  
                    <div class="form-group  <?= form_error('nama_kriteria') ? 'error' : '' ?>">
                        <label for="eventInput1">Nama Kriteria</label>
                        <input type="text" id="eventInput1" class="form-control" name="nama_kriteria" value="<?= $mode === 'tambah' ? form_error('nama_kriteria') ? set_value('nama_kriteria') : '' : $data_edit->nm_kriteria ?>">
                        <?= form_error('nama_kriteria', '<ul role="alert"><li style="color:red;">','</li></ul>') ;?> 
                    </div>
                    <?php if($mode === 'edit'): ?>
                        <input type="hidden" id="eventInput1" class="form-control" name="id" value="<?= $mode === 'edit' ? $data_edit->id_kriteria : '' ?>">
                    <?php endif; ?>                    
                    <div class="form-group  <?= form_error('bobot') ? 'error' : '' ?>">
                        <label for="eventInput1">Bobot</label>
                        <input type="text" id="eventInput1" class="form-control" name="bobot" value="<?= $mode === 'tambah' ? form_error('bobot') ? set_value('bobot') : '' : $data_edit->bobot ?>">
                        <?= form_error('bobot', '<ul role="alert"><li style="color:red;">','</li></ul>') ;?> 
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
                        <h4 class="card-title">Cari Data Kriteria</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-block">
                    <div class="mb-3">
                    <form action="<?= site_url('kriteria'); ?>" method="POST">
                      <div class="form-body">
                      <div class="row">
                        <div class="col-6">
                        <div class="form-group">
                            <label for="eventInput1">Tahun</label>
                            <input type="text" id="eventInput1" class="form-control" name="tahun-filter" value="<?= $isinya !== 'ehem' ? $tahun : '' ?>">
                         </div> 
                        </div>
                        <div class="col-6">
                        <div class="form-group">
                    <label for="eventInput1">Periode</label>
                      <select name="periode-filter" id="kelamin" class="custom-select d-block w-100">
                        <option value="1">1</option>
                        <option value="2">2</option>
                      </select>
                    </div>    
                        </div>
                      </div>
                        <button style="margin-bottom:0px;" type="submit" class="btn btn-primary">
                            <i class="icon-magnifier"></i> Cari
                        </button>
                        </div>
                      </form>                    
                      </div>
                    <div class="card-title-wrap mb-3">
                        <h4 class="card-title">Data Kriteria Aktif<?= $isinya !== 'ehem' ? ', Periode '.$periode. ' Tahun '. $tahun : ''?></h4>
                    </div>
                        <table class="table" id="tabel-aktif">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Kriteria</th>
                                    <th>Bobot</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if($isinya !== 'ehem'): ?>
                            <?php if(count($isinya['aktif']) !== 0):?>
                                <?php $no=1; foreach($isinya['aktif'] as $aktif): ?>
                                <tr>
                                    <th scope="row"><?= $no ?></th>
                                    <td><?= $aktif->nm_kriteria ?></td>
                                    <td><?= $aktif->bobot ?></td>
                                    <td><a href="<?= site_url('kriteria/edit/').$aktif->id_kriteria ?>" class="btn btn-sm btn-warning"><i class="icon-pencil"></i></a> <a href="<?= site_url('kriteria/nonaktifkan/').$aktif->id_kriteria ?>" class="btn btn-sm btn-danger"><i class="icon-lock"></i></a></td>
                                </tr>
                                <?php $no++; endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                                <?php endif; ?>
                                <?php else: ?>
                                    <tr>
                                    <td colspan="4" class="text-center">Pilih periode dan tahun dulu</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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
                        <h4 class="card-title">Data Kriteria Non Aktif<?= $isinya !== 'ehem' ? ', Periode '.$periode. ' Tahun '. $tahun : ''?></h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-block">
                        <table class="table" id="tabel-non-aktif">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Kriteria</th>
                                    <th>Bobot</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if($isinya !== 'ehem'): ?>
                            <?php if(count($isinya['nonaktif']) !== 0):?>
                                <?php $no=1; foreach($isinya['nonaktif'] as $nonaktif): ?>
                                <tr>
                                    <th scope="row"><?= $no ?></th>
                                    <td><?= $nonaktif->nm_kriteria ?></td>
                                    <td><?= $nonaktif->bobot ?></td>
                                    <td><a href="<?= site_url('kriteria/aktifkan/').$nonaktif->id_kriteria ?>" class="btn btn-sm btn-success"><i class="icon-lock-open"></i></a></td>
                                </tr>
                                <?php $no++; endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <?php endif; ?>
                                <?php else: ?>
                                    <tr>
                                    <td colspan="4" class="text-center">Pilih periode dan tahun dulu</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        </div>              
        </div>
        </div>
</section>
<script>
    $('input[name="tahun-filter"],input[name="tahun"]').datepicker({
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years"
    });
    $('#tabel-aktif').DataTable({"pageLength": 5,"lengthMenu": [[5,10],[5,10]]});
    $('#tabel-non-aktif').DataTable({"pageLength": 5,"lengthMenu": [[5,10],[5,10]]});
</script>
<!--Basic Table Ends-->