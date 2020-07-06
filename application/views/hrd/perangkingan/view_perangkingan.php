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

    <div class="col-md-12">
    <div class="card">
          <div class="card-header">
              <div class="card-title-wrap bar-warning">
                  <h4 class="card-title">Pilih Tahun Dan Periode</h4>
              </div>
          </div>
          <div class="card-body">
              <div class="card-block">    
              <form action="<?= site_url('perangkingan') ?>" method="post">
      <div class="form-group">
        <label for="">Tahun</label>
        <input autocomplete="off" type="text" class="form-control" name="tahun" value="<?= $this->session->userdata('tahun-nilai') && $this->session->userdata('tahun-nilai') ? $this->session->userdata('tahun-nilai') : ''?>">
      </div>
      <div class="form-group">
        <label for="eventInput1">Periode</label>
          <select name="periode" id="kelamin" class="custom-select d-block w-100">
            <option <?= $this->session->userdata('tahun-nilai') && $this->session->userdata('tahun-nilai') ? $this->session->userdata('periode-nilai') === '1' ? 'selected' : '' : ''?> value="1">1</option>
            <option <?= $this->session->userdata('tahun-nilai') && $this->session->userdata('tahun-nilai') ? $this->session->userdata('periode-nilai') === '2' ? 'selected' : '' : ''?> value="2">2</option>
          </select>
      </div>        
      <div class="form-actions">
          <button type="submit" class="btn btn-warning">
            <i class="icon-note"></i> <?= $this->session->userdata('tahun-rangking') && $this->session->userdata('tahun-rangking') ? 'Ubah' : 'Pilih'?>
          </button>
      </div>   
      </form>
    </div>
    </div>
    </div>
    </div>

    <div class="col-md-12">
    <div class="card">
          <div class="card-header">
              <div class="card-title-wrap bar-warning">
              <?php if(count($rangking) !== 0 && $rangking[0]['nilai_akhir'] != 0): ?>
              
                <h4 class="card-title">Data Periode <?= $this->session->userdata('periode-nilai').' Tahun '.$this->session->userdata('tahun-nilai') ?></h4>
              <?php else: ?>
                <h4 class="card-title">Data Belum siap</h4>
              <?php endif; ?>
                  
              </div>
          </div>
          <div class="card-body">
            <?php if(count($rangking) !== 0 && $rangking[0]['nilai_akhir'] != 0): ?>
              <div class="card-block">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Rangking</th>
                      <th>Nama Karyawan</th>
                      <?php foreach($rangking[0]['nilai'] as $nm_kriteria): ?>
                        <th class="text-capitalize"><?= $nm_kriteria['nama_kriteria'] ?></th>
                      <?php endforeach; ?>
                      <th>Nilai Akhir</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach($rangking as $rang): ?>
                      <tr>
                        <td><?= $no; ?></td>
                        <td class="text-capitalize"><?= $rang['alternatif'] ?></td>
                        <?php foreach($rang['nilai'] as $nilai): ?>
                          <td><?= $nilai['nilai'] ?></td>
                        <?php endforeach; ?>
                        <td><?= $rang['nilai_akhir'] ?></td>
                      </tr>
                    <?php $no++; endforeach; ?>
                  </tbody>
                </table>
              </div>
            
            <?php endif; ?>
            <?php ?>
        </div>
        </div>
    </div>
        </div>
</section>

<script>
    $('input[name="tahun-filter"],input[name="tahun"]').datepicker({
        orientation: "bottom",
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years"
    });
</script>