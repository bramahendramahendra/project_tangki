<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
        <?=$this->session->flashdata('success');?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="zmdi zmdi-close"></i></span>
        </button>
    </div>
<?php elseif($this->session->flashdata('info')): ?>
    <div class="alert alert-info">
        <?=$this->session->flashdata('info');?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="zmdi zmdi-close"></i></span>
        </button>
    </div>
<?php elseif($this->session->flashdata('warning')): ?>
    <div class="alert alert-warning">
        <?=$this->session->flashdata('warning');?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="zmdi zmdi-close"></i></span>
        </button>
    </div>
<?php elseif($this->session->flashdata('danger')): ?>
    <div class="alert alert-danger">
        <?=$this->session->flashdata('danger');?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="zmdi zmdi-close"></i></span>
        </button>
    </div>
<?php endif; ?>