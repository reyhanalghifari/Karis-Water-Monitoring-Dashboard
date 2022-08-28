<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
  
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Data Master - Edit Cabang Distribusi</h1>
            </div>
        </div>

        <!-- ... Your content goes here ... -->   

		<div class="row">
			<div class="col-lg-12">
			    <div class="panel panel-default">
			        <div class="panel-heading">
			            Form Edit Cabang Distribusi
			        </div>
			        <div class="panel-body">
			            <div class="row">
			                <div class="col-lg-12">
			                    <form role="form" method="POST" action="<?php echo base_url('cabang/edit'); ?>">
			                        <div class="form-group">
			                            <label>Nama Cabang</label>
			                            <input name="nama_cabang" class="form-control" placeholder="Isi dengan nama cabang" value="<?= $cabang->nama_cabang ?>"/>
			                            <input type="hidden" name="cabang_id" class="form-control" placeholder="Isi dengan nama barang" value="<?= $cabang->cabang_id ?>"/>
			                        </div>
			                        <div class="form-group">
			                            <label>Kepala Cabang</label>
			                            <input name="kepala_cabang" class="form-control" placeholder="Isi dengan nama kepala cabang" value="<?= $cabang->kepala_cabang ?>"/>
			                        </div>
			                        <div class="form-group">
			                            <label>Alamat Cabang</label>
			                            <input name="alamat_cabang" class="form-control" placeholder="Isi dengan alamat cabang" value="<?= $cabang->alamat_cabang ?>"/>
			                        </div>
			                        <div class="form-group">
			                            <label>Email</label>
			                            <input name="email" class="form-control" placeholder="Isi dengan email cabang" value="<?= $cabang->email ?>"/>
			                        </div> 
			                        <div class="form-group">
			                            <label>No Telepon</label>
			                            <input name="no_telp" class="form-control" placeholder="Isi dengan no telepon cabang" value="<?= $cabang->no_telp ?>"/> 
			                        </div>     
			                       <input type="submit" class="btn btn-primary" value="Submit" />
			                        <input type="reset" class="btn btn-danger" value="Cancel" />
			                    </form>
			                </div>
			                <!-- /.col-lg-6 (nested) -->
			                
			            </div>
			            <!-- /.row (nested) -->
			        </div>
			        <!-- /.panel-body -->
			    </div>
			    <!-- /.panel -->
			</div>
			<!-- /.col-lg-12 -->
		</div>

    </div>
</div>

<?= $this->endSection() ?>
