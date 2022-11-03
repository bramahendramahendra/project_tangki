<div class="modal-header">
    <h4 class="title" id="defaultModalLabel"><?=$dataView['titlePage']?></h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<?=form_open($dataView['urlUpdate'], 'class="formModal" id="formModal"');?>
    <?=form_input(array('type' =>'hidden','name'=>'id','id'=>'id','value'=>(isset($dataCreate['id'])&&$dataCreate['id']!=""?$dataCreate['id']:"") ));?>
    <?=form_input(array('type' =>'hidden','name'=>'id_gedung','id'=>'id_gedung','value'=>(isset($dataCreate['id_gedung'])&&$dataCreate['id_gedung']!=""?$dataCreate['id_gedung']:"") ));?>
    <?=form_input(array('type' =>'hidden','name'=>'id_facility_management','id'=>'id_facility_management','value'=>(isset($dataCreate['id_facility_management'])&&$dataCreate['id_facility_management']!=""?$dataCreate['id_facility_management']:"") ));?>
    <?=form_input(array('type' =>'hidden','name'=>'status','id'=>'status','value'=>(isset($dataCreate['status'])&&$dataCreate['status']!=""?$dataCreate['status']:"") ));?>
    <div class="modal-body">
        <?php $this->load->view('templates/alerts_v');?>
        <div class="row clearfix">
            <div class="col-lg-4 col-md-4 col-sm-4 form-control-label">
                <label for="catatan">Catatan</label>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="form-group">
                    <textarea name="catatan" id="catatan" class="form-control catatan" value="<?=isset($dataCreate['catatan'])&&$dataCreate['catatan']!=""?$dataCreate['catatan']:$this->input->get('catatan')?> Liter" placeholder="Masukkan Catatan disini." maxlength="200" required rows="10"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="save-btn" class="btn btn-default btn-round waves-effect" >Simpan</button>
        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Tutup</button>
        
    </div>
<?=form_close()?>

<script>
    $(document).ready(function(){
        $('#generalModal').on('hide.bs.modal', function (e) {
            location.reload();
        })

        $('#save-btn').off().click(function(e){
            var status = $("#status").val();
            if(status == 1) {
                var textString = "Apakah anda yakin akan menyetujui request ini ?"; 
            } else {
                var textString = "Apakah anda yakin akan menolak request ini ?"; 
            }
            if(confirm(textString)){
                $.ajax({
                    url     : $('#formModal').attr('action'),
                    data    : 'save=save&'+$('#formModal').serialize(),
                    beforeSend	:function(){
                        $('.page-loader-wrapper').show();
                    },
                    success: function(data){
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