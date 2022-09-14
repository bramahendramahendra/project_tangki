
<?php templateHeader($dataView); ?>

<section class="content">
    <div class="body_scroll">
        <?php $this->load->view('templates/breadcrumb_v', $dataView);?>
        <div class="container-fluid">
            <!-- Horizontal Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong><?=$dataView['subTitlePage'][0]?></strong> <?=$dataView['subTitlePage'][1]?> </h2>
                            <ul class="header-dropdown">
                                <li class="remove">
                                    <a href="<?=$dataView['urlBack'];?>" role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                </li>
                            </ul>
                        </div>
                        <?php $this->load->view('templates/alerts_v');?>
                        <div class="body">
                            <?=form_open((isset($dataView['pages'])&&$dataView['pages']=="update"?$dataView['urlUpdate']:$dataView['urlCreate']), 'class="formData" id="formData"');?>    
                                <?=form_input(array('type' =>'hidden','name'=>'id','id'=>'id','value'=>(isset($dataUpdate['id'])&&$dataUpdate['id']!=""?$dataUpdate['id']:"") ));?>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                        <label for="nik">NIK</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8">
                                        <div class="form-group">
                                            <input type="text" name="nik" id="nik" class="form-control nik" value="<?=isset($dataUpdate['nik'])&&$dataUpdate['nik']!=""?$dataUpdate['nik']:""?>" placeholder="Masukkan NIK disini." maxlength="50" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                        <label for="nama">Nama</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8">
                                        <div class="form-group">
                                            <input type="text" name="nama" id="nama" class="form-control nama" value="<?=isset($dataUpdate['nama'])&&$dataUpdate['nama']!=""?$dataUpdate['nama']:""?>" placeholder="Masukkan Nama disini." maxlength="200" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                        <label for="user_role">User Role</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8">
                                        <div class="form-group">
                                            <?=form_input(array('type' =>'hidden','name'=>'old_user_role','id'=>'old_user_role','value'=>(isset($dataUpdate['id_user_role'])&&$dataUpdate['id_user_role']!=""?$dataUpdate['id_user_role']:"") ));?>
                                            <select name="user_role" id="user_role" class="form-control show-tick ms select2 user_role" data-placeholder="Masukkan User Role disini" <?=isset($dataUpdate['id_user_role'])&&$dataUpdate['id_user_role']!=""?'':'required'?>>
                                                <option value=""><?=isset($dataUpdate['user_role'])&&$dataUpdate['user_role']!=""?$dataUpdate['user_role']:""?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix" id="form-fm_gedung" style="display: none;">
                                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                        <label for="fm_gedung">FM - Gedung</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8">
                                        <div class="form-group">
                                            <?=form_input(array('type' =>'hidden','name'=>'old_fm_gedung','id'=>'old_fm_gedung','value'=>(isset($dataUpdate['id_fm_gedung'])&&$dataUpdate['id_fm_gedung']!=""?$dataUpdate['id_fm_gedung']:"") ));?>
                                            <select name="fm_gedung" id="fm_gedung" class="form-control show-tick ms select2 fm_gedung" data-placeholder="Masukkan Facility Management disini" <?=(isset($dataView['pages'])&&$dataView['pages']=="update"?(isset($dataUpdate['id_fm_gedung'])&&$dataUpdate['id_fm_gedung']!=""?'':'required'):'')?>>
                                                <option value=""><?=isset($dataUpdate['fm_gedung'])&&$dataUpdate['fm_gedung']!=""?$dataUpdate['fm_gedung']:""?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                               <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                        <label for="nama">Foto</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8">
                                        <div class="form-group">
                                            <input type="file" class="dropify foto" id="foto" name="foto">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row clearfix">
                                    <div class="col-sm-8 offset-sm-2">
                                        <a href="<?=$dataView['urlBack'];?>" role="button" class="btn btn-raised btn-warning btn-round waves-effect">Kembali</a>
                                        <button type="submit" id="save-btn" name="save" value="save" class="btn btn-raised btn-success btn-round waves-effect" onclick="return confirm('Apakah anda yakin akan '+'<?=(isset($dataView['pages'])&&$dataView['pages']=='update'?'mengupdate':'menyimpan')?>'+' data ini ?')" >Simpan</button>
                                    </div>
                                </div>
                            <?=form_close()?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
        $('#user_role').ready(function(){ 
            // var id=$(this).val();
            $.ajax({
                url : "<?=$dataView['urlAutocompleteUserRoles'];?>",
                async : true,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    html += '<option value=""></option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].level_id+'>'+data[i].role_desc+'</option>';
                    }
                    $('#user_role').html(html);
                }
            });
        }); 
        $('#user_role').change(function(){ 
            var user_role = $(this).val();
            if(user_role == 3) {   
                $('#form-fm_gedung').show();
                $("#fm_gedung").prop('required',true);
            } else {
                $('#form-fm_gedung').hide();
                $("#fm_gedung").removeAttr('required');
            }
        }); 
        $('#fm_gedung').ready(function(){ 
            // var id=$(this).val();
            $.ajax({
                url : "<?=$dataView['urlAutocompleteFMGedung'];?>",
                async : true,
                dataType : 'json',
                success: function(data){
                    console.log(data);
                    var html = '';
                    var i;
                    html += '<option value=""></option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].id_gedung+'>'+data[i].facility_management+' - '+data[i].gedung+'</option>';
                    }
                    $('#fm_gedung').html(html);
                }
            });
        }); 

        $(function() {
            "use strict";
            $('.dropify').dropify();

            var drEvent = $('#dropify-event').dropify();
            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });

            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'Désolé, le fichier trop volumineux'
                }
            });
        });
    });
</script>

<?php templateFooter($dataView); ?>