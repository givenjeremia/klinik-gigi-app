
<nav class="main-header navbar navbar-expand-md navbar-dark">
  <div class="container">
    <a href="../../index.php" class="navbar-brand">
  
      <span class="brand-text font-weight-light">Klinik Gigi</span>
    </a>

    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
      aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <?php if($_SESSION['auth']['role'] !== 'pasien' && $_SESSION['auth']['role'] !== 'dokter' && $_SESSION['auth']['role'] !== 'perawat') : ?>

        <li class="nav-item dropdown">
          <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">Master</a>
          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
         
            <li><a href="../alat/index.php" class="dropdown-item">Alat</a></li>
            <li><a href="../dokter/index.php" class="dropdown-item">Dokter</a></li>
            <li><a href="../pasien/index.php" class="dropdown-item">Pasien</a></li>
            <li><a href="../perawat/index.php" class="dropdown-item">Perawat</a></li>
            <li><a href="../karyawan/index.php" class="dropdown-item">Karyawan</a></li>
            <li><a href="../obat/index.php" class="dropdown-item">Obat</a></li>
            <li><a href="../spesialis/index.php" class="dropdown-item">Spesialis</a></li>
            <li><a href="../layanan/index.php" class="dropdown-item">Layanan</a></li>
            <li><a href="../keluhan/index.php" class="dropdown-item">Keluhan</a></li>
          </ul>
        </li>

        <!-- <li class="nav-item dropdown">
          <a id="dropdownSubMenu2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">Jadwal</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
            <li><a href="#" class="dropdown-item">Dokter</a></li>
          </ul>
        </li> -->

        <?php if($_SESSION['auth']['role'] == 'admin' || $_SESSION['auth']['role'] == 'karyawan') : ?>
        <li class="nav-item dropdown">
          <a id="dropdownSubMenu2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">Keuangan</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
            <li><a href="../keuangan/pengajuan_nota.php" class="dropdown-item">Pengajuan Nota</a></li>
            <li><a href="../keuangan/nota.php" class="dropdown-item">Nota</a></li>
            <li><a href="../keuangan/catatan_keuangan.php" class="dropdown-item">Catatan Keuangan</a></li>
          </ul>
        </li>
        <?php endif; ?> 
        
        <?php endif; ?>

        <?php if($_SESSION['auth']['role'] == 'pasien') : ?>
        <li class="nav-item">
          <a href="../layanan/data.php" class="nav-link">Layanan</a>
        </li>
        <li class="nav-item">
          <a href="../resep_obat/index.php" class="nav-link">Resep Obat</a>
        </li>
        <?php endif; ?>

        <?php if($_SESSION['auth']['role'] == 'dokter' || $_SESSION['auth']['role'] == 'perawat' ) : ?>
        <li class="nav-item dropdown">
          <a id="dropdownSubMenu2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">Rekam Medis</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
            <li><a href="../rekam_medis/index.php" class="dropdown-item">Riwayat</a></li>
            <?php if($_SESSION['auth']['role'] == 'dokter') : ?>
            <li><a href="../reservasi/history.php" class="dropdown-item">Data Reservasi</a></li>
            <li><a href="../rekam_medis/create.php" class="dropdown-item">Buat</a></li>
            <?php endif; ?>
            <li><a href="../resep_obat/index.php" class="dropdown-item">Resep Obat</a></li>
            <li><a href="../odontogram/all_data.php" class="dropdown-item">All Odontogram</a></li>
            <li><a href="../odontogram/data.php" class="dropdown-item">Odontogram</a></li>
          </ul>
        </li>
        <?php endif; ?>

        <?php if($_SESSION['auth']['role'] !== 'dokter' ): ?>
        <li class="nav-item dropdown">
          <a id="dropdownSubMenu2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">Reservasi</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
            <?php if(($_SESSION['auth']['role'] == 'admin' || $_SESSION['auth']['role'] == 'karyawan') && ($_SESSION['auth']['role'] !== 'dokter' || $_SESSION['auth']['role'] !== 'pasien' || $_SESSION['auth']['role'] !== 'perawat') ) : ?>
            <li><a href="../reservasi/pengingat.php" class="dropdown-item">Pengingat</a></li>
            <li><a href="../reservasi/pengajuan.php" class="dropdown-item">Pengajuan</a></li>
            <?php endif; ?>
            <?php if($_SESSION['auth']['role'] !== 'perawat'):?>
            <li><a href="../reservasi/history.php" class="dropdown-item">History</a></li>
            <?php endif; ?>

            <li><a href="../reservasi/jadwal_dokter.php" class="dropdown-item">Jadwal Dokter</a></li>
          </ul>
        </li>
        <?php endif;?>
       
        
      </ul>

    </div>
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user-circle"></i>
          <span class="d-none d-md-inline"><?= $_SESSION['auth']['username'] ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">My Profile</span>
          <div class="dropdown-divider"></div>
          <div class="dropdown-divider"></div>
          <a href="#" id="btn-logout" class="dropdown-item">
            Logout
          </a>
        </div>
      </li>
    </ul>
  </div>
</nav>