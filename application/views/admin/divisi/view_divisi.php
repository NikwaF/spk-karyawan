
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
                      <form action="<?= $mode === 'tambah' ? site_url('divisi/insert') : site_url('divisi/edit_action') ?>" method="POST">
                      <div class="form-body">
                    <div class="form-group <?= form_error('nama_divisi') ? 'error' : '' ?>">
                        <label for="eventInput1">Nama Divisi</label>
                        <input type="text" id="eventInput1" class="form-control" name="nama_divisi" value="<?= $mode === 'edit' && !form_error('nama_divisi')  ? $data_edit->nm_divisi : '' ?>">
                        <?= form_error('nama_divisi', '<ul role="alert"><li style="color:red;">','</li></ul>') ;?>                                            
                    </div>

                    <?php if($mode === 'edit'): ?>
                        <input type="hidden" id="eventInput1" class="form-control" name="id" value="<?= $mode === 'edit' ? $data_edit->id_divisi : '' ?>">
                    <?php endif; ?>
                    
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
                        <h4 class="card-title">Data Divisi Aktif</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-block">
                        <table class="table" id="tabel-aktif">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Divisi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(count($isinya['aktif']) !== 0):?>
                                <?php $no=1; foreach($isinya['aktif'] as $aktif): ?>
                                <tr>
                                    <th scope="row"><?= $no ?></th>
                                    <td><?= $aktif->nm_divisi ?></td>
                                    <td><a href="<?= site_url('divisi/edit/').$aktif->id_divisi ?>" class="btn btn-sm btn-warning"><i class="icon-pencil"></i></a> <a href="<?= site_url('divisi/nonaktifkan/').$aktif->id_divisi ?>" class="btn btn-sm btn-danger"><i class="icon-lock"></i></a></td>
                                </tr>
                                <?php $no++; endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                    <td colspan="3" class="text-center">Tidak ada data</td>
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
                        <h4 class="card-title">Data Divisi Non Aktif</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-block">
                        <table class="table" id="tabel-non-aktif">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Divisi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(count($isinya['nonaktif']) !== 0):?>
                                <?php $no=1; foreach($isinya['nonaktif'] as $nonaktif): ?>
                                <tr>
                                    <th scope="row"><?= $no ?></th>
                                    <td><?= $nonaktif->nm_divisi ?></td>
                                    <td><a href="<?= site_url('divisi/aktifkan/').$nonaktif->id_divisi ?>" class="btn btn-sm btn-success"><i class="icon-lock-open"></i></a></td>
                                </tr>
                                <?php $no++; endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada data</td>
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