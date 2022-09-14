<div class="modal-header">
    <h4 class="title" id="defaultModalLabel"><?=$dataView['titlePage']?></h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<?=form_open((isset($dataView['pages'])&&$dataView['pages']=="update"?$dataView['urlUpdate']:$dataView['urlCreate']), 'class="formModal" id="formModal"');?>
    <?=form_input(array('type' =>'hidden','name'=>'id','id'=>'id','value'=>(isset($dataUpdate['id'])&&$dataUpdate['id']!=""?$dataUpdate['id']:"") ));?>
    <div class="modal-body">
        <?php $this->load->view('templates/alerts_v');?>
        <div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="facility_management">Facility Management</label>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                    <input type="text" name="facility_management" id="facility_management" class="form-control facility_management" value="<?=isset($dataUpdate['facility_management'])&&$dataUpdate['facility_management']!=""?$dataUpdate['facility_management']:$this->input->get('facility_management')?>" placeholder="Masukkan Facility Management disini." maxlength="50" required>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="save-btn" class="btn btn-default btn-round waves-effect" rel="<?=(isset($dataView['pages'])&&$dataView['pages']=="update"?$dataView['pages']:"create")?>">Simpan</button>
        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Tutup</button>
        
    </div>
<?=form_close()?>

<script>
    $(document).ready(function(){
        $('#generalModal').on('hide.bs.modal', function (e) {
            location.reload();
        })

        $('#save-btn').off().click(function(e){
            var rel = $(this).attr('rel');
            if(rel=="update") {
                $string = 'Apakah anda yakin akan mengupdate data ini ?';
            } else {
                $string = 'Apakah anda yakin akan menyimpan data ini ?';
            }
            if(confirm($string)){
                $.ajax({
                    url     : $('#formModal').attr('action'),
                    data    : 'save=save&'+$('#formModal').serialize(),
                    beforeSend	:function(){
                        $('.page-loader-wrapper').show();
                    },
                    success: function(data){
                        // $('#main-content').html(data);

                        //active
                        $('#generalModal .modal-dialog .modal-content').html(data);
                        $('.page-loader-wrapper').hide();
                    }
                });
            }
            e.preventDefault();
        });
    });
</script>