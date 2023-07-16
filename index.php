<?php 
if($_SESSION['auth']){
    // Admin To Admin Page
    
    // Karyawan To Karyawan Page

    // Dokter To Dokter Page

    // Pasien To Pasien Page

}
else{
    header("Location: page/auth/login.php");
}

?>