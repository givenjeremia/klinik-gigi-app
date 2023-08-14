<?php include '../layouts/session_login.php' ?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <?php include '../layouts/head.php' ?>
</head>

<body class='hold-transition layout-top-nav'>
    <div class='wrapper'>
        <?php include '../layouts/navbar.php' ?>
        <div class='content-wrapper'>
            <div class='container-fluid pr-5 pl-5 pt-3'>
                <div class='content'>
                    <div class='card mt-2'>
                        <div class='card-header'>
                            <h3 class='card-title'>Jadwal Dokter</h3>
                        </div>
                        <div class='card-body'>
                            <div class='table-responsive'>
                                <table id='jadwal-dokter' class='table table-bordered table-striped'>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Jam</th>
                                            <th>Hari</th>
                                            <th>Kuota Pasien</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id='hasil_jadwal'>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Jam</th>
                                            <th>Hari</th>
                                            <th>Kuota Pasien</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php  include 'create.php' ?>
    <?php include '../layouts/script.php' ?>
    <script src='../../js/dokter_jadwal.js'></script>
    <script>
        jadwalDataAllReservasi()
        getDataPasien()
    </script>

</body>

</html>