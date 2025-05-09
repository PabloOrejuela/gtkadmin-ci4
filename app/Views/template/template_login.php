<?php echo view('includes/header');?>
<!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <?php echo view('includes/navbar_login');?>
    <?php echo view('includes/side-menu-login');?>
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