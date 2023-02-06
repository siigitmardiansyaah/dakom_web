   <!-- Begin Page Content -->
   <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">History QR</h1>
</div>


<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">History QR</h6>
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
                                        <th> Data QR </th>
                                        <th> Gambar QR </th>
                                        <th> Waktu Buat QR </th>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
								if(empty($data))
								{
                                        echo '<tr>
                                        <td colspan="4" class="text-center"> Data History Kosong </td>
                                        </tr>';
								}
                                foreach ($data as $ha) :
                                ?>
                                    <tr class="text-center">
                                        <td><?php echo $no++ ?></td>
                                        <td ><?php echo $ha->qr ?></td>
                                        <td ><img src="<?php echo base_url()?>assets/qrimg/<?php echo $ha->qr?>.png" alt="qr-demo" style="max-height: 100%; max-width: 100%"/></td>
                                        <td ><?php echo date('d-m-Y',strtotime($ha->waktu_buat)) ?></td>
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