        <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <a href="<?= base_url('tanaman/index'); ?>">
                        <div class="col-12 text-center text-sm-start h4 mb-n1 text-success">
                            D A T A <b class="ms-3">T A N A M A N</b> 
                        </div>
                        </a>
                    </div>
                </div>
            </div> 
         <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                                    <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" 
                                        data-bs-target="#tambahModal"><i class="fa fa-plus pe-2"></i>Tambah Data</button>
                            <table id="datatable" class="table table-bordered table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-dark">#</th>
                                        <th scope="col" class="text-dark">Gambar</th>
                                        <th scope="col" class="text-dark">Nama Tanaman</th>
                                        <th scope="col" class="text-dark">Max PH</th>
                                        <th scope="col" class="text-dark">Min Lembab</th>
                                        <th scope="col" class="text-dark">Status</th>
                                        <th scope="col" class="text-dark">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 1;
                                        foreach ($tanaman as $tnm) : ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><img class="mx-auto d-block" src="<?php echo base_url();?>assets/img/<?php echo $tnm->gambar;?>" width="50" height="50"></td>
                                        <td><?php echo $tnm->nama_tanaman ?></td>
                                        <td><?php echo $tnm->max_ph ?></td>
                                        <td><?php echo $tnm->min_lembab ?></td>
                                        <td class="status-<?php $tnm->id?>"></td>
                                        <td>
                                            <?php echo anchor('tanaman/hapus/'.$tnm->id, 
                                                '<button class="badge btn-danger btn-sm m-1">Hapus</button>', 
                                                array('class'=>'delete', 'onclick'=>"return confirmDialog();"));
                                            ?>
                                            <button type="button" class="badge btn-warning m-1" data-bs-toggle="modal" 
                                                data-bs-target="#editModal<?php echo $tnm->id ?>">Edit</button><br>
                                            <button type="button" class="badge btn-primary m-1" data-bs-toggle="modal" 
                                                    data-bs-target="#detailModal<?php echo $tnm->id ?>">Details</button>
                                            <button class="sendData badge btn-success m-1" data-id="<?php $tnm->id ?>">Kirim</button>
                                                
                                                <!--<div class="col-4 form-check form-switch m-1">
                                                    <input class="form-check-input bg-success" type="checkbox" role="switch" checked="">
                                                </div>-->
                                            
                                            <!--<input type="checkbox" checked data-toggle="toggle" data-on="Pakai" data-off="Tidak" 
                                                    data-onstyle="success" data-offstyle="secondary" data-size="sm" data-id-tanaman="<?php $tnm->id?>">-->
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah-->
            <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Data Tanaman</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <?php echo form_open_multipart('tanaman/tambahAksi');?>
                        <div class="mb-3">
                                <label for="nama_tanaman" class="form-label">Nama Tanaman</label>
                                <input type="text" class="form-control" id="nama_tanaman"
                                    name="nama_tanaman" required>
                         </div>
                        <div class="row mb-3">
                            <label for="min_ph" class="col-sm-2 col-form-label">Min PH</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control ms-3" id="min_ph" name="min_ph" required>
                                </div>
                            <label for="max_ph" class="col-sm-2 col-form-label ms-lg-5">Max PH</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control ms-3" id="max_ph" name="max_ph"required>
                                </div>
                        </div>
                        <div class="row mb-3">
                            <label for="min_lembab" class="col-sm-2 col-form-label">Min Lembab</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control ms-3" id="min_lembab" name="min_lembab" required>
                                </div>
                            <label for="max_lembab" class="col-sm-2 col-form-label ms-lg-5">Max Lembab</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control ms-3" id="max_lembab" name="max_lembab" required>
                                </div>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Upload Gambar</label>
                            <input type="file" class="form-control" id="gambar"
                                    name="gambar" required>
                        </div>
                        <button type="reset" class="btn btn-danger float-end mt-3 me-2" data-bs-dismiss="modal">Reset</button>
                        <button type="submit" class="btn btn-success float-end mt-3 me-2">Save</button>
                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            </div>
    <!-- Akhir modal Tambah -->

    <!-- Edit modal -->
            <?php $no = 0;
            foreach($tanaman as $tnm) : $no++; ?>
            <div class="modal fade" id="editModal<?php echo $tnm->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Edit Data Tanaman</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <?php echo form_open_multipart('tanaman/update');?>
                        <div class="mb-3">
                                <label for="nama_tanaman" class="form-label">Nama Tanaman</label>
                                <input type="hidden" class="form-control" id="id"
                                    name="id" value="<?php echo $tnm->id?>">
                                <input type="text" class="form-control" id="nama_tanaman"
                                    name="nama_tanaman" value="<?php echo $tnm->nama_tanaman?>" required>
                         </div>
                        <div class="row mb-3">
                            <label for="min_ph" class="col-sm-2 col-form-label">Min PH</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control ms-3" id="min_ph" name="min_ph" value="<?php echo $tnm->min_ph?>" required>
                                </div>
                            <label for="max_ph" class="col-sm-2 col-form-label ms-lg-5">Max PH</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control ms-3" id="max_ph" name="max_ph" value="<?php echo $tnm->max_ph?>" required>
                                </div>
                        </div>
                        <div class="row mb-3">
                            <label for="min_lembab" class="col-sm-2 col-form-label">Min Lembab</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control ms-3" id="min_lembab" name="min_lembab" value="<?php echo $tnm->min_lembab?>" required>
                                </div>
                            <label for="max_lembab" class="col-sm-2 col-form-label ms-lg-5">Max Lembab</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control ms-3" id="max_lembab" name="max_lembab" value="<?php echo $tnm->max_lembab?>" required>
                                </div>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label><br>
                            <img class="mb-2" src="<?php echo base_url();?>assets/img/<?php echo $tnm->gambar;?>" width="90" height="90">
                            <input type="file" class="form-control" id="gambar"
                                    name="gambar">
                        </div>
                                <button type="reset" class="btn btn-danger float-end mt-3 me-2" data-bs-dismiss="modal">Reset</button>
                                <button type="submit" class="btn btn-success float-end mt-3 me-2">Save</button>
                            <?php echo form_close(); ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php endforeach ?>
    <!-- Akhir edit modal -->

    <!-- Detail modal -->
            <?php $no = 0;
            foreach($tanaman as $tnm) : $no++; ?>
            <div class="modal fade" id="detailModal<?php echo $tnm->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Detail Data Tanaman</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <?php echo form_open_multipart('tanaman/detail');?>
                    <div class="text-center">
                        <img src="<?php echo base_url();?>assets/img/<?php echo $tnm->gambar;?>" class="rounded" alt="..." width="300" height="200">
                    </div>
                    <table class="table table-bordered table-striped table-responsive mt-3">
                        <tr>
                            <th>Nama Tanaman</th>
                            <td><?php echo $tnm->nama_tanaman?></td>
                        </tr>
                        <tr>
                            <th>Min PH</th>
                            <td><?php echo $tnm->min_ph?></td>
                        </tr>
                        <tr>
                            <th>Max PH</th>
                            <td><?php echo $tnm->max_ph?></td>
                        </tr>
                        <tr>
                            <th>Min Lembab</th>
                            <td><?php echo $tnm->min_lembab?></td>
                        </tr>
                        <tr>
                            <th>Max Lembab</th>
                            <td><?php echo $tnm->max_lembab?></td>
                        </tr>
                    </table>
                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach ?>
    <!-- Akhir Detail modal -->