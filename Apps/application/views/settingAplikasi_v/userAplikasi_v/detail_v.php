<?php templateHeader($dataView); ?>

<section class="content">
    <div class="body_scroll">
        <?php $this->load->view('templates/breadcrumb_v', $dataView);?>
        <!-- <?php echo"<pre>"; var_dump($dataDetail); echo"</pre>";?>s -->
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-xl-4 col-lg-12 col-md-12">
                    <div class="card mcard_3">
                        <div class="body">
                            <a href="profile.html"><img src="<?= base_url('resource/assets/images/profile_av.jpg');?>" class="rounded-circle" alt="profile-image"></a>
                            <h5 class="mt-3 mb-1"><?=$dataDetail->nik?></h5>
                            <h4 class="m-t-10"><?=$dataDetail->nama?></h4>                            
                            <small class="text-muted"><?=$dataDetail->role_desc?></small>
                        </div>
                    </div>
                                      
                </div>
                <div class="col-xl-8 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="body">
                            <small class="text-muted">NIK: </small>
                            <p><?=$dataDetail->nik?></p>
                            <hr>
                            <small class="text-muted">Nama: </small>
                            <p><?=$dataDetail->nama?></p>
                            <hr>
                            <small class="text-muted">Level User: </small>
                            <p><?=$dataDetail->role_desc?></p>
                            <hr>
                            <small class="text-muted">Facility Management: </small>
                            <p><?=$dataDetail->facility_management?></p>
                            <hr>
                            <small class="text-muted">Gedung: </small>
                            <p><?=$dataDetail->gedung?></p>
                            <hr>
                            <small class="text-muted">Lokasi: </small>
                            <p><?=$dataDetail->lokasi?></p>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</section>

<?php templateFooter($dataView); ?>