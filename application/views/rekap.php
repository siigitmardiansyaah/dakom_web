   <!-- Begin Page Content -->
   <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Rekap Absensi</h1>
</div>

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Print Absensi</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form action="<?php echo base_url()?>rekap/filter" method="POST" target="_BLANK">
                <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Awal</label>
                        <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="awal">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="akhir">
                    </div>
                    <div class="mb-3">
                        <button type="submit" value="Simpan" class="btn btn-primary" style="margin-left:10px" >Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
</div>

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Rekap Absensi Hari Ini</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
            <?php
                    if ($this->session->flashdata('error')) {
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('error') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    }
                    ?>
                     <?php
                    if ($this->session->flashdata('success')) {
                    ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    }
                    ?>

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
        </div>
    </div>

    
</div>

</div>
<!-- /.container-fluid -->