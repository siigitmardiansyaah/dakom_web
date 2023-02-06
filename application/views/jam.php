   <!-- Begin Page Content -->
   <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Jam Absen</h1>
</div>


<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Jam</h6>
                <div class="float-right">
                        <a href="<?php echo base_url() ?>jam/tambah" class="btn btn-secondary btn-sm btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                                <span class="text">Tambah Data</span>   
                        </a>
                    </div>
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
                        <table class="table table-bordered" width="100%" cellspacing="0" id="tbljam">
                            <thead class="text-center">
                                <tr>
                                        <th> No </th>
                                        <th> Nama Jam </th>
                                        <th> Batas Awal </th>
                                        <th> Batas Akhir </th>
                                        <th> Aksi </th>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
								if(empty($jam))
								{
                                        echo '<tr>
                                        <td colspan="5" class="text-center"> Data Jam Kosong </td>
                                        </tr>';
								}
                                foreach ($jam as $ha) :
                                ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td ><?php echo $ha->nama_jam ?></td>
                                        <td ><?php echo $ha->batas_awal ?></td>
                                        <td ><?php echo $ha->batas_akhir ?></td>
                                        <td ><a href="<?php echo base_url()?>jam/edit/<?php echo $ha->id_jam ?>" class="btn btn-primary"> Edit</a>  <a href="<?php echo base_url()?>jam/hapus/<?php echo $ha->id_jam ?>" class="btn btn-warning"> Hapus</a> </td>
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