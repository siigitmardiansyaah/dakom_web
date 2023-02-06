   <!-- Begin Page Content -->
   <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Divisi</h1>
</div>


<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Divisi</h6>
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
                    <form action="<?php echo base_url()?>divisi/store" method='POST'>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kode Divisi</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="kd_div" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Divisi</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" value="Simpan" class="btn btn-primary" style="margin-left:10px">Simpan</button>
                        <a href="<?php echo base_url()?>divisi" class="btn btn-info"> Kembali</a>
                    </div>
                    </form>
        </div>
    </div>

    
</div>

</div>
<!-- /.container-fluid -->