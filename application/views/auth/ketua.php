<body data-col="1-column" class=" 1-column  blank-page blank-page">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper"><!--Login Page Starts-->
<section id="login">
    <div class="container-fluid">
        <div class="row full-height-vh">
            <div class="col-12 d-flex align-items-center justify-content-center gradient-aqua-marine">
                <div class="card px-4 py-2 box-shadow-2 width-400">
                    <div class="card-header text-center">
                        <h3 class="text-uppercase text-bold-400 grey darken-1">SPK Peringkat Karyawan</h3>
                        <h4 class="text-uppercase text-bold-400 grey darken-1">Login</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-block">                        
                        <?php echo form_open('auth/aksi_login_ketua'); ?>
                                <div class="form-group <?= form_error('username') ? 'error' : '' ?>">
                                    <div class="col-md-12">
                                    <?php if($this->session->flashdata('key')): ?>
    <div class="alert alert-<?= $this->session->flashdata('key') ?> alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata($this->session->flashdata('key'));?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>   
        
<?php endif; ?>
                                     <div class="controls">
                                        <input type="text" class="form-control form-control-lg" autocomplete="off" name="username" id="inputUsername" placeholder="Username" value="<?= set_value('username'); ?>" >
                                        <div class="help-block">
                                          <?= form_error('username', '<ul role="alert"><li>','</li></ul>') ;?>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group  <?= form_error('password') ? 'error' : '' ?>">
                                    <div class="col-md-12">
                                        <input type="password" class="form-control form-control-lg" name="password" id="inputPass" placeholder="Password" >
                                        <div class="help-block">
                                          <?= form_error('password', '<ul role="alert"><li>','</li></ul>') ;?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="text-center col-md-12">
                                        <button type="submit" class="btn btn-danger px-4 py-2 text-uppercase white font-small-4 box-shadow-2 border-0">Masuk</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer grey darken-1">
        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Login Page Ends-->
    </div>