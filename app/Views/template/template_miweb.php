<?php echo view('includes/header_miweb');?>
<!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content-->
        <div class="app-content">
        <div class="content-wrapper">
          <?= $this->renderSection('content'); ?>
        </div>
        </div>
        <!--end::App Content-->
      </main>
<!--end::App Main-->
<?php echo view('includes/footer_miweb');?>