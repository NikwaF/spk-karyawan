




      <div class="main-panel">
        <div class="main-content">
          <div class="content-wrapper">
            <div class="container-fluid"><!--Statistics cards Starts-->
            <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-6 col-12">
              <h5 class="font-medium-5 card-title">Selamat Datang Manajer</h5>
            </div>
            </div>            
          <div class="row">
            <?php if(count($tot_karyawan) > 0 ): ?>
            <?php foreach($tot_karyawan as $divisi): ?>
            <div class="col-xl-4 col-lg-6 col-md-6 col-12">
              <div class="card bg-white">
                <div class="card-body">
                  <div class="card-block pt-2 pb-0 mb-2">
                    <div class="media">
                      <div class="media-body white text-left">
                        <h4 class="font-medium-5 card-title mb-0"><?= $divisi->total ?></h4>
                        <span class="grey darken-1">Divisi <?= $divisi->nama ?></span>
                      </div>
                      <div class="media-right text-right">
                        <i class="icon-user font-large-1 primary"></i>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
            <?php else: ?>
              <div class="col-xl-4 col-lg-6 col-md-6 col-12">
              <div class="card bg-white">
                <div class="card-body">
                  <div class="card-block pt-2 pb-0 mb-2">
                    <div class="media">
                      <div class="media-body white text-left">
                        <h4 class="font-medium-5 card-title mb-0">Belum Ada Divisi</h4>
                        <span class="grey darken-1">-</span>
                      </div>
                      <div class="media-right text-right">
                        <i class="icon-user font-large-1 primary"></i>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
              </div>

              <?php endif; ?>

              </div>
          </div>
            
          </div>
<!--Statistics cards Ends-->
