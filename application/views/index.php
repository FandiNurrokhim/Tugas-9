<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <style>
        body {
            background-color: #00DBDE;
            font-size: 14px;
        }

        .provinsi {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table td {
            padding: 10px;
            text-align: left;
        }

        img {
            max-width: 100px;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="provinsi">
        <h1>Provinsi Jawa Timur</h1>
        <h1>Kota Magetan</h1>
    </div>
    <table>
        <tr>
            <td>
                <p>Nama</p>
                <p>Tempat/Tgl Lahir</p>
                <p>Alamat</p>
            </td>
            <td>
                <p>: <?= $nama ?></p>
                <p>: <?= $tempat_lahir?>, <?= $tanggal_lahir ?></p>
                <p>: <?= $alamat ?></p>
            </td>
            <td width="70"><img src="<?= $logo; ?>"></td>
        </tr>
    </table>
</body>

</html>