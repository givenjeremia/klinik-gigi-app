<script src="../../assets/plugins/jquery/jquery.min.js"></script>
<script src="../../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/plugins/chart.js/Chart.min.js"></script>
<script src="../../assets/plugins/sparklines/sparkline.js"></script>
<script src="../../assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="../../assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="../../assets/plugins/moment/moment.min.js"></script>
<script src="../../assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="../../assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="../../assets/plugins/summernote/summernote-bs4.min.js"></script>
<script src="../../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="../../assets/dist/js/adminlte.js"></script>
<script src="../../assets/dist/js/adminlte.min.js"></script>
<script src="../../assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script src="../../assets/dist/js/pages/dashboard.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="../../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../assets/plugins/jszip/jszip.min.js"></script>
<script src="../../assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="../../assets/plugins/moment/moment.min.js"></script>
<script src="../../assets/plugins/fullcalendar/main.js"></script>
<script src="../../assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="../../assets/plugins/select2/js/select2.full.min.js"></script>
<!-- BS-Stepper -->
<script src="../../assets/plugins/bs-stepper/js/bs-stepper.min.js"></script>

<script>
    $('.select2').select2()

    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
</script>

<!-- Enkrip Dekrip -->
<script src="../../js/enkrip_dekrip.js"></script>

<script>
    $('#btn-logout').on('click', function (e) {
        e.preventDefault();
        var url = "../../backend/auth/logout.php";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (data, status, xhr) {
                if (data.status == "success") {
                    Swal.fire({
                        title: "Success",
                        text: "Berhasil Logout",
                        icon: "success",
                        showConfirmButton: true,
                    }).then(result => {
                        window.location.reload();
                    })

                } else {
                    Swal.fire({
                        title: "Error",
                        text: "Gagal Logout",
                        icon: "error",
                        showConfirmButton: true,
                    });
                }
            },
        });
    })
</script>