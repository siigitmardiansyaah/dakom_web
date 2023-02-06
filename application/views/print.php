<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</head>
<body>
    <h1 class="text-center">Rekap Absensi Karyawan</h1>
    <h3 style="font-weight: bold;">Tanggal Cetak : <?php echo date('d-m-Y') ?></h3>

    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0" id="tblkaryawan">
                            <thead class="text-center">
                                <tr>
                                        <th> No </th>
                                        <th> NIP </th>
                                        <th> Nama Karyawan </th>
                                        <th> Divisi </th>
                                        <th> Jam </th>
                                        <th>Keterangan Absen</th>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
								if(empty($rekap))
								{
                                        echo '<tr>
                                        <td colspan="6" class="text-center"> Data Absen Kosong </td>
                                        </tr>';
								}
                                foreach ($rekap as $ha) :
                                ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td ><?php echo $ha->nip ?></td>
                                        <td ><?php echo $ha->nama ?></td>
                                        <td ><?php echo $ha->nama_divisi ?></td>
                                        <td ><?php echo date('d-m-Y H:i',strtotime($ha->waktu_absen)) ?></td>
                                        <td ><?php echo $ha->nama_jam ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
            </div>
            <script>
    window.print();            
    </script>

</body>
</html>