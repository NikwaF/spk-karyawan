<link rel="stylesheet" type="text/css" href="<?= base_url('vendor/') ?>app-assets/vendors/css/tables/datatable/datatables.min.css">
<script src="<?= base_url('vendor/') ?>app-assets/vendors/js/datatable/datatables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
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
                      <form action="<?= $mode === 'tambah' ? site_url('range_nilai/insert') : site_url('range_nilai/update') ?>" method="POST">
                    <div class="form-body">
                    <div class="form-group <?= form_error('tahun') ? 'error' : '' ?>">
                        <label for="eventInput1">Tahun</label>
                        <input type="text" id="eventInput1" class="form-control" name="tahun" value="<?= $mode === 'tambah' ? form_error('tahun') ? set_value('tahun') : '' : $data_edit->tahun ?>">
                        <?= form_error('tahun', '<ul role="alert"><li style="color:red;">','</li></ul>') ;?>
                    </div>
                    <div class="form-group">
                    <label for="eventInput1">Periode</label>
                      <select name="periode" class="custom-select d-block w-100">
                        <option value="1">1</option>
                        <option value="2">2</option>
                      </select>
                    </div>                     
                    <div class="form-group">
                      <label for="eventInput1">Kriteria</label>
                      <select name="kriteria" id="kelamin" class="custom-select d-block w-100">

                      </select>
                    </div>                          
                <div class="form-group  <?= form_error('nama_parameter') ? 'error' : '' ?>">
                    <label for="eventInput1">Nama Parameter</label>
                    <input type="text" id="eventInput1" class="form-control" name="nama_parameter" value="<?= $mode === 'tambah' ? form_error('nama_parameter') ? set_value('nama_parameter') : '' : $data_edit->nm_parameter ?>">
                    <?= form_error('nama_parameter', '<ul role="alert"><li style="color:red;">','</li></ul>') ;?>
                </div>
                <?php if($mode === 'edit'): ?>
                        <input type="hidden" id="eventInput1" class="form-control" name="id" value="<?= $mode === 'edit' ? $data_edit->id_parameter : '' ?>">
                    <?php endif; ?>                
                <div class="form-group  <?= form_error('nilai') ? 'error' : '' ?>">
                    <label for="eventInput1">Nilai Parameter</label>
                    <input type="text" id="eventInput1" class="form-control" name="nilai" value="<?= $mode === 'tambah' ? form_error('nilai') ? set_value('nilai') : '' : $data_edit->nilai ?>">
                    <?= form_error('nilai', '<ul role="alert"><li style="color:red;">','</li></ul>') ;?>
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
                        <h4 class="card-title">Data Range Nilai</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-block">
                    <div class="mb-3">
                    <form action="<?= site_url('range_nilai'); ?>" method="POST">
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
                        <option <?= $isinya !== 'ehem' && $periode === '1' ?  'selected' : '' ?> value="1">1</option>
                        <option <?= $isinya !== 'ehem' && $periode === '2' ?  'selected' : '' ?> value="2">2</option>
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
                        <table class="table" id="tabel-aktif">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Kriteria</th>
                                    <th class="text-center">Range Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if($isinya !== 'ehem'): ?>
                                <?php $no = 1; for($i = 0 ; count($isinya) > $i ; $i++){ ?>
                                    <tr>
                                    <td style="vertical-align : middle;line-height:100%; text-align:center;" scope="row"><?= $no++ ?></td>
                                    <td class="text-uppercase" style="vertical-align : middle;line-height:100%; text-align:center;"><?= $isinya[$i]['kriteria'] ?></td>
                                    <td>
                                <?php if(count($isinya[$i]['parameter']) !== 0): ?>
                                    <?php for($j= 0 ; count($isinya[$i]['parameter']) > $j ; $j++){ ?>
                                        <p style="margin:0px;"><?= $isinya[$i]['parameter'][$j]->nilai ?> <span class="text-capitalize"><?= $isinya[$i]['parameter'][$j]->nm_parameter ?></span><a style="color:#FF9149;margin-left:3px;" href="<?= site_url('range_nilai/edit/').$isinya[$i]['parameter'][$j]->id_parameter ?>" class=""><i class="icon-pencil"></i></a> <a  style="color:red;"href="<?= site_url('range_nilai/nonaktifkan/').$isinya[$i]['parameter'][$j]->id_parameter ?>" class=""><i class="icon-trash"></i></a></p>
                                    <?php } ?>
                                <?php else: ?>  
                                    Belum ada range nilainya
                                    
                                <?php endif; ?>
                                    </td>
                                    </tr>

                                <?php } ?>
                                <?php else: ?>
                                    <tr>
                                    <td colspan="3" class="text-center">Pilih periode dan tahun dulu</td>
                                    <td></td>
                                    <td></td>
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
    $('input[name="tahun-filter"],input[name="tahun"]').datepicker({
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years"
    });
    const mode = '<?=  $mode ?>';


    $('input[name="tahun"],select[name="periode"]').on('change',function(e){
        console.log('hello');
        const tahun = $('input[name="tahun"]').val();
        const periode = $('select[name="periode"]').val();

        $.ajax({
            url: `<?= site_url('range_nilai/get_kriteria') ?>`,
            type: 'POST',
            data: {tahun,periode},
            dataType: 'JSON',
            success: res => {
                if(res.length  === 0){
                    $('#kelamin').html('');
                    return ;
                }
                const id_edit = '<?= $mode === 'edit' ? $data_edit->id_kriteria : ''; ?>';
                console.log(id_edit);

                let html = ``;
                res.forEach(item => {
                    html += `<option class="text-capitalize" ${mode === 'edit' && id_edit == item.id_kriteria ? 'selected' : ''} value="${item.id_kriteria}">${item.nm_kriteria}</option>`;
                });

                $('#kelamin').html(html);
            }
        })
    });

    if($('input[name="tahun"]').val() !== ''){
        $('input[name="tahun"]').trigger('change');
    }    
    $('#tabel-aktif').DataTable({"pageLength": 5,"lengthMenu": [[5,10],[5,10]]});
</script>
<!--Basic Table Ends-->