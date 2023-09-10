<?php
$id_nota = $_GET['id_nota']
?>
<!DOCTYPE html>
<html>

<head>
    <title>Nota</title>
    <style>
        table {
            max-width: 100%;
            max-height: 100%;
        }

        body {
            padding: 5px;
            position: relative;
            width: 100%;
            height: 100%;
        }

        table th,
        table td {
            padding: .625em;
            text-align: center;
        }

        table .kop:before {
            content: ': ';
        }

        .left {
            text-align: left;
        }

        table #caption {
            font-size: 1.5em;
            margin: .5em 0 .75em;
        }

        table.border {
            width: 100%;
            border-collapse: collapse
        }

        table.border tbody th,
        table.border tbody td {
            border: thin solid #000;
            padding: 2px
        }

        .ttd td,
        .ttd th {
            padding-bottom: 4em;
        }
    </style>
</head>

<body>

    <div id='printable' class='container'>
        <table border='0' cellpadding='0' cellspacing='0' width='485' class='border' style='overflow-x:auto;'>
            <thead>
                <tr>
                    <td colspan='6' width='485' id='caption'>KLINIK GIGI</td>
                </tr>
                <tr>
                    <td colspan='2'>Nama Pasien</td>
                    <td class='left kop'>Suparman</td>
                    <td></td>
                    <td>Tanggal</td>
                    <td class='left kop'>Wonosobo, 22 Maret 2019</td>
                </tr>
                <tr>
                    <td colspan='2'>NO Nota</td>
                    <td class='left kop'><?= $id_nota ?></td>
                    <td></td>
                    <td>Pembuat Nota</td>
                    <td class='left kop'>Sewa Harian</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>No</th>
                    <th>OBAT</th>
                    <th>JUMLAH</th>
                    <th>TOTAL</th>
                    <th colspan='2'>KETERANGAN</th>
                </tr>
                <tr>
                    <td align='right'>1</td>
                    <td>Rp 400.000</td>
                    <td align='right'>1</td>
                    <td>Rp 400.000</td>
                    <td colspan='2'> Semayu</td>
                </tr>
                <tr>
                    <th>No</th>
                    <th>ALAT</th>
                    <th>JUMLAH</th>
                    <th>TOTAL</th>
                    <th colspan='2'>KETERANGAN</th>
                </tr>
                <tr>
                    <td align='right'>1</td>
                    <td>Rp 400.000</td>
                    <td align='right'>1</td>
                    <td>Rp 400.000</td>
                    <td colspan='2'> Semayu</td>
                </tr>
                <tr>
                    <th colspan='3'> TOTAL</th>
                    <td>Rp 400.000</td>
                    <td colspan='2'></td>
                </tr>
            </tbody>

        </table>
    </div>

    <script>
        window.print();
        window.onfocus = function() {
            window.close();
        }
    </script>

</body>

</html>