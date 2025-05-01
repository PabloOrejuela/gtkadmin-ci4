<?= $this->extend('template/template'); ?>
<?= $this->section('content'); ?>
    <!-- Content Header (Page header) -->
    <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0"><?= $title; ?></h3></div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
    <!-- /.content-header -->
    <!-- Main content -->
    <?= $this->include($main_content) ?>
    <!-- /.content -->
<?= $this->endSection(); ?>
