<nav class="main-header navbar navbar-expand-md navbar-dark">
  <div class="container">
    <a href="/" class="navbar-brand">
  
      <span class="brand-text font-weight-light">Klinik Gigi</span>
    </a>

    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
      aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
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
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a id="dropdownSubMenu2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">Jadwal</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
            <li><a href="#" class="dropdown-item">Dokter</a></li>
          </ul>
        </li>


        <li class="nav-item dropdown">
          <a id="dropdownSubMenu2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">Keuangan</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
            <!-- <li><a href="{{url('admin/transaksi-perias')}}" class="dropdown-item">Pemesanan</a></li> -->
          </ul>
        </li>
       
       
        
      </ul>

    </div>
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user-circle"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">My Profile</span>
          <div class="dropdown-divider"></div>
          <div class="dropdown-divider"></div>
          <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
            Logout
          </a>
          <form id="logout-form" action="" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </li>
    </ul>
  </div>
</nav>