

      <div class="main-panel">
        <div class="main-content">
          <div class="content-wrapper">
            <div class="container-fluid"><!--Statistics cards Starts-->
            <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-6 col-12">
              <h5 class="font-medium-5 card-title">Divisi <?=  $divisi->nm_divisi?></h5>
            </div>
            </div>
          <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-6 col-12">
              <div class="card bg-white">
                <div class="card-body">
                  <div class="card-block pt-2 pb-0 mb-2">
                    <div class="media">
                      <div class="media-body white text-left">
                        <h4 class="font-medium-5 card-title mb-0"><?= $tot_karyawan->total ?></h4>
                        <span class="grey darken-1">Total Karyawan</span>
                      </div>
                      <div class="media-right text-right">
                        <i class="icon-user font-large-1 primary"></i>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
              </div>


              </div>

              <div class="col-12">
                <div class="card bg-white">
                  <div class="card-body">
                    <h5 style="color:#666EE8" class="text-center text-uppercase card-title mt-3">selamat datang ketua divisi <?= $divisi->nm_divisi ?></h5>


                    <hr>
                    <h3 class="text-center text-uppercase card-title">sistem pendukung keputusan penentuan rangking Karyawan</h3>
                    <h3 class="text-center text-uppercase card-title mb-3">Metode simple multi attribute rating technique</h3>

                  </div>
                </div>
              </div>
          </div>
            
          </div>
<!--Statistics cards Ends-->
