<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<style>
    .select2-selection__rendered {
        line-height: 38px !important;
        text-transform: uppercase;
    }

    .select2-container .select2-selection--single {
        height: 38px !important;
    }

    .select2-selection__arrow {
        height: 38px !important;
    }

    #prevBtn {
        background-color: #dc3545;
    }
</style>

<div class="main-panel">
        <div class="main-content">
          <div class="content-wrapper">
            <div class="container-fluid"><div class="row">

</div>
<section>
<?php if($this->session->flashdata('key')): ?>
    <div class="alert alert-<?= $this->session->flashdata('key') ?> alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata($this->session->flashdata('key'));?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>   
<?php endif; ?>
<div class="row">
  <div class="col-md-3">
  <div class="card">
          <div class="card-header">
              <div class="card-title-wrap bar-warning">
                  <h4 class="card-title">Pilih Tahun Dan Periode</h4>
              </div>
          
          </div>
          <div class="card-body">
              <div class="card-block">
                <form action="<?= site_url('penilaian') ?>" method="POST">
                <div class="form-body">
              <div class="form-group">
                  <label for="eventInput1">Tahun</label>
                  <input type="text" id="eventInput1" class="form-control" name="tahun" value="<?= $this->session->userdata('tahun-nilai') && $this->session->userdata('tahun-nilai') ? $this->session->userdata('tahun-nilai') : ''?>">                                         
              </div>
              <div class="form-group">
                    <label for="eventInput1">Periode</label>
                      <select name="periode" id="kelamin" class="custom-select d-block w-100">
                        <option <?= $this->session->userdata('tahun-nilai') && $this->session->userdata('tahun-nilai') ? $this->session->userdata('periode-nilai') === '1' ? 'selected' : '' : ''?> value="1">1</option>
                        <option <?= $this->session->userdata('tahun-nilai') && $this->session->userdata('tahun-nilai') ? $this->session->userdata('periode-nilai') === '2' ? 'selected' : '' : ''?> value="2">2</option>
                      </select>
                    </div>               
              <div class="form-actions center">
          <button type="submit" class="btn btn-warning">
            <i class="icon-note"></i> <?= $this->session->userdata('tahun-nilai') && $this->session->userdata('tahun-nilai') ? 'Ubah' : 'Pilih'?>
          </button>
        </div>                    

            </div>
                </form>
              </div>
          </div>
      </div>
  </div>

    
  <?php if($this->session->userdata('tahun-nilai') && $this->session->userdata('periode-nilai') && count($kriteria) !== 0): ?>
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">
					<div class="card-title-wrap bar-success">
						<h4 class="card-title" id="basic-layout-form-center">Penilaian Karyawan <?= 'Periode '. $this->session->userdata('periode-nilai'). ', Tahun '. $this->session->userdata('tahun-nilai') ?></h4>
					</div>
					<p class="mb-0"></p>
				</div>
				<div class="card-body">
					<div class="px-3">

						<form class="form" action="<?= site_url('penilaian/insert') ?>" method="POST">
							<div class="row justify-content-md-center">
								<div class="col-md-6">
									<div class="form-body">
										<div class="form-group">
											<label for="eventInput1">Nama Karyawan</label>
                      <select name="nm_karyawan" id="nm_karyawan" class="custom-select d-block w-100">
                        <?php foreach($karyawan['karyawan'] as $ky): ?>
                          <option value="<?= $ky->id_karyawan ?>"><?= $ky->nama .' - '.$ky->nm_divisi ?></option>
                        <?php endforeach; ?>
                      </select>
										</div>

                    <?php for($i=0; count($kriteria) > $i ; $i++){ ?>
                      <div class="form-group">
  											<label  for="eventInput1"><?= $kriteria[$i]['nama_kriteria']?></label>
                        <select name="kriteria<?= $kriteria[$i]['id_kriteria']?>" class="custom-select d-block w-100">
                        <?php for($j=0; count($kriteria[$i]['parameter']) > $j ; $j++){ ?>
                            <option class="text-capitalize" value="<?= $kriteria[$i]['parameter'][$j]->nilai ?>"><?= $kriteria[$i]['parameter'][$j]->nm_parameter ?></option>
                        <?php } ?>
                        </select>
                      </div>
                    <?php } ?>

									</div>
								</div>
							</div>

							<div class="form-actions center">
                <?php if(count($karyawan['karyawan']) === 0): ?>
                  <h5>Semua karyawan di periode <?= $this->session->userdata('periode-nilai') ?> tahun <?= $this->session->userdata('tahun-nilai') ?> telah dinilai semua</h5>
                <?php else:  ?>
                  <button type="submit" class="btn btn-success">
									<i class="icon-note"></i> Simpan Penilaian
								</button>
                <?php endif; ?>
							</div>
						</form>

					</div>
				</div>
			</div>
  <?php else:  ?>
    <div class="col-md-9">
			<div class="card">
				<div class="card-header">
					<div class="card-title-wrap bar-warning">
						<h4 class="card-title" id="basic-layout-form-center"><?= count($kriteria) !== 0 ? 'Harus Pilih Tahun Dan Periode Dulu' : 'Kriteria Masih Belum Diinputkan Admin' ?></h4>
					</div>
					<p class="mb-0"></p>
				</div>
				<div class="card-body">
					
				</div>
			</div>

    <?php endif; ?>

		</div>
	</div>
  </section>
  <script>
    $('input[name="tahun-filter"],input[name="tahun"]').datepicker({
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years"
    });
    $('#nm_karyawan').select2();
</script>