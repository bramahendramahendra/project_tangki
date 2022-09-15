
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
                                        <label for="facility_management">Facility Management</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8">
                                        <div class="form-group">
                                            <?=form_input(array('type' =>'hidden','name'=>'old_facility_management','id'=>'old_facility_management','value'=>(isset($dataUpdate['id_facility_management'])&&$dataUpdate['id_facility_management']!=""?$dataUpdate['id_facility_management']:"") ));?>
                                            <select name="facility_management" id="facility_management" class="form-control show-tick ms select2 facility_management" data-placeholder="Masukkan Facility Management disini" <?=isset($dataUpdate['id_facility_management'])&&$dataUpdate['id_facility_management']!=""?'':'required'?>>
                                                <option value=""><?=isset($dataUpdate['facility_management'])&&$dataUpdate['facility_management']!=""?$dataUpdate['facility_management']:""?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                        <label for="gedung">Gedung</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8">
                                        <div class="form-group">
                                            <input type="text" name="gedung" id="gedung" class="form-control gedung" value="<?=isset($dataUpdate['gedung'])&&$dataUpdate['gedung']!=""?$dataUpdate['gedung']:""?>" placeholder="Masukkan Gedung disini." maxlength="50" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                        <label for="lokasi">Lokasi</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8">
                                        <div class="form-group">
                                            <textarea type="text" name="lokasi" id="lokasi" class="form-control no-resize lokasi" value="<?=isset($dataUpdate['lokasi'])&&$dataUpdate['lokasi']!=""?$dataUpdate['lokasi']:""?>" placeholder="Masukkan Lokasi disini." maxlength="200" rows="4" required ></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                        <label for="jenis_tangki">Jenis Tangki</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8">
                                        <div class="form-group">
                                            <?=form_input(array('type' =>'hidden','name'=>'old_jenis_tangki','id'=>'old_jenis_tangki','value'=>(isset($dataUpdate['jenis_tangki'])&&$dataUpdate['jenis_tangki']!=""?$dataUpdate['jenis_tangki']:"") ));?>
                                            <?=form_input(array('type' =>'hidden','name'=>'old_panjang','id'=>'old_panjang','value'=>(isset($dataUpdate['panjang'])&&$dataUpdate['panjang']!=""?$dataUpdate['panjang']:"") ));?>
                                            <?=form_input(array('type' =>'hidden','name'=>'old_lebar','id'=>'old_lebar','value'=>(isset($dataUpdate['lebar'])&&$dataUpdate['lebar']!=""?$dataUpdate['lebar']:"") ));?>
                                            <select name="jenis_tangki" id="jenis_tangki" class="form-control show-tick ms select2 jenis_tangki" data-placeholder="Masukkan Jenis Tangki disini" <?=isset($dataUpdate['jenis_tangki'])&&$dataUpdate['jenis_tangki']!=""?'':'required'?>>
                                                <option value=""><?=isset($dataUpdate['jenis_tangki'])&&$dataUpdate['jenis_tangki']!=""?$dataUpdate['jenis_tangki']:""?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                        <label for="code_sensor">Kode Sensor</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8">
                                        <div class="form-group">
                                            <input type="text" name="code_sensor" id="code_sensor" class="form-control code_sensor" value="<?=isset($dataUpdate['code_sensor'])&&$dataUpdate['code_sensor']!=""?$dataUpdate['code_sensor']:""?>" placeholder="Masukkan Kode Sensor disini." maxlength="10" required>
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
        $('#facility_management').ready(function(){ 
            // var id=$(this).val();
            $.ajax({
                url : "<?=$dataView['urlAutocompleteFacilityManagement'];?>",
                async : true,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    html += '<option value=""></option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].id+'>'+data[i].facility_management+'</option>';
                    }
                    $('#facility_management').html(html);
                }
            });
        }); 
        $('#jenis_tangki').ready(function(){ 
            // var id=$(this).val();
            $.ajax({
                url : "<?=$dataView['urlAutocompleteJenisTangki'];?>",
                async : true,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    html += '<option value=""></option>';
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].id+'>'+data[i].jenis_tangki+'</option>';
                    }
                    $('#jenis_tangki').html(html);
                }
            });
        }); 
    });

    // Select2 selectbox
    $(function () {
        $('.select2').select2();
        $(".search-select").select2({
            allowClear: true
        });
        $("#max-select").select2({
            placeholder: "Select",
            maximumSelectionSize: 2,
        });
        $("#loading-select").select2({
            placeholder: "Select",
            minimumInputLength: 1,
            query: function (query) {
                var data = {results: []}, i, j, s;
                for (i = 1; i < 5; i++) {
                    s = "";
                    for (j = 0; j < i; j++) {s = s + query.term;}
                    data.results.push({id: query.term + i, text: s});
                }
                query.callback(data);
            }
        });
        var data=[{id:0,tag:'enhancement'},{id:1,tag:'bug'},{id:2,tag:'duplicate'},{id:3,tag:'invalid'},{id:4,tag:'wontfix'}];
        function format(item) { return item.tag; }
        $("#array-select").select2({
            placeholder: "Select",
            data:{ results: data, text: 'tag' },
            formatSelection: format,
            formatResult: format
        });
    });
</script>

<?php templateFooter($dataView); ?>