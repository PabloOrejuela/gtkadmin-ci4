<?= $this->extend('template/template_miweb'); ?>
<?= $this->section('content'); ?>
    <!-- Content Header (Page header) -->
    <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
    <!-- /.content-header -->
    <!-- Main content -->
    <?= $this->include($main_content) ?>
    <!-- /.content -->
<?= $this->endSection(); ?>
