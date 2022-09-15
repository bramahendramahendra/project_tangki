<div class="modal-header">
    <h4 class="title" id="defaultModalLabel"><?=$dataView['titlePage']?></h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<?=form_open((isset($dataView['pages'])&&$dataView['pages']=="update"?$dataView['urlUpdate']:$dataView['urlCreate']), 'class="formModal" id="formModal"');?>
    <?=form_input(array('type' =>'hidden','name'=>'id','id'=>'id','value'=>(isset($dataUpdate['id'])&&$dataUpdate['id']!=""?$dataUpdate['id']:"") ));?>
    <?=form_input(array('type' =>'hidden','name'=>'id_gedung','id'=>'id_gedung','value'=>(isset($dataUpdate['id_gedung'])&&$dataUpdate['id_gedung']!=""?$dataUpdate['id_gedung']:"") ));?>
    <div class="modal-body">
        <?php $this->load->view('templates/alerts_v');?>
        <div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="kapasitas_bahan_bakar">Kapasitas Bahan Bakar</label>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                    <input type="text" name="kapasitas_bahan_bakar" id="kapasitas_bahan_bakar" class="form-control kapasitas_bahan_bakar" value="<?=isset($dataUpdate['kapasitas_bahan_bakar'])&&$dataUpdate['kapasitas_bahan_bakar']!=""?$dataUpdate['kapasitas_bahan_bakar']:$this->input->get('kapasitas_bahan_bakar')?>" placeholder="Masukkan Kapasitas Bahan Bakar disini." maxlength="11" required>
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
            if(confirm('Apakah anda yakin akan mengupdate data ini ?')){
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