
  <body data-col="2-columns" class=" 2-columns ">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">


      <div data-active-color="white" data-background-color="black" data-image="app-assets/img/sidebar-bg/01.jpg" class="app-sidebar">
        <div class="sidebar-header">
          <div class="logo clearfix"><a href="index.html" class="logo-text float-left">
              <div class="logo-img"></div><span class="text align-middle">Admin</span></a><a id="sidebarToggle" href="javascript:;" class="nav-toggle d-none d-sm-none d-md-none d-lg-block"><i data-toggle="expanded" class="ft-disc toggle-icon"></i></a><a id="sidebarClose" href="javascript:;" class="nav-close d-block d-md-block d-lg-none d-xl-none"><i class="ft-circle"></i></a></div>
        </div>
        <div class="sidebar-content">
          <div class="nav-container">
            <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
            <li class=" nav-item <?= $this->uri->segment(1) === 'dashboard' ? 'active' : '' ?>"><a href="<?= site_url('dashboard/admin') ?> "><i class="icon-home"></i><span data-i18n="" class="menu-title">Dashboard</span></a>
            <li class=" nav-item <?= $this->uri->segment(1) === 'divisi' ? 'active' : '' ?>"><a href="<?= site_url('divisi') ?>"><i class="icon-drawer"></i><span data-i18n="" class="menu-title">Divisi</span></a>
            <li class=" nav-item <?= $this->uri->segment(1) === 'karyawan' ? 'active' : '' ?>"><a href="<?= site_url('karyawan') ?>"><i class="icon-user"></i><span data-i18n="" class="menu-title">Karyawan</span></a>
            <li class=" nav-item <?= $this->uri->segment(1) === 'kriteria' ? 'active' : '' ?>"><a href="<?= site_url('kriteria') ?>"><i class="icon-share-alt"></i><span data-i18n="" class="menu-title">Kriteria</span></a></li>
            <li class=" nav-item <?= $this->uri->segment(1) === 'range_nilai' ? 'active' : '' ?>"><a href="<?= site_url('range_nilai') ?>"><i class="icon-calculator"></i><span data-i18n="" class="menu-title">Range Nilai</span></a></li>
              <li class=" nav-item <?= $this->uri->segment(1) === 'laporan' ? 'active' : '' ?>"><a href="<?= site_url('laporan') ?>"><i class="icon-book-open"></i><span data-i18n="" class="menu-title">Laporan</span></a>
              </li>

            </ul>
          </div>
        </div>
        <div class="sidebar-background"></div>
      </div>

      <nav class="navbar navbar-expand-lg navbar-light bg-faded">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><span class="d-lg-none navbar-right navbar-collapse-toggle"><a class="open-navbar-container"><i class="ft-more-vertical"></i></a></span>
          </div>
          <div class="navbar-container">
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
              <ul class="navbar-nav">
     
                <li class="dropdown nav-item mr-0"><a id="dropdownBasic3" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-user-link dropdown-toggle"><span class="avatar avatar-online"><img id="navbar-avatar" src="<?= base_url('vendor/') ?>app-assets/img/portrait/small/avatar-s-3.png" alt="avatar"/></span>
                    <p class="d-none">User Settings</p></a>
                  <div aria-labelledby="dropdownBasic3" class="dropdown-menu dropdown-menu-right">
                    <div class="arrow_box_right">

                      <div class="dropdown-item"></div><a href="<?= site_url('auth/logout') ?>" class="dropdown-item"><i class="ft-power mr-2"></i><span>Keluar</span></a>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>