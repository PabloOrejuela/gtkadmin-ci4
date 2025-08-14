<!DOCTYPE HTML>
<html>
	<head>
		<title>Mi Web - <?= NOMBRE_EMPRESA; ?></title>
		<link rel="icon" href="<?= site_url(); ?>favicon.ico">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="<?= site_url(); ?>public/mi-web/assets/css/main.css" />
		<link rel="stylesheet" href="<?= site_url(); ?>public/css/link-miweb.css" />
	</head>

    <body class="homepage is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
					<!-- Hero -->
					<section id="hero" class="container">
						<header>
							<div class="row align-items-center">
								<div class="col-auto">
									<img src="<?= base_url(); ?>public/images/logo-gom.png" alt="logo" class="img-size-100 mr-3 img-circle" id="logo-gom">
								</div>
								<div class="col">
									<h2 id="h2-text-left" class="mb-0">¡Oportunidad Única en Network Marketing! con Trading Automático</h2>
								</div>
							</div>
						</header>
					</section>

				</div>
        <!-- Features 1 -->
				<div class="wrapper">
					<div class="container">
						<div class="row">
							<section class="col-12 col-12-narrower feature">
								<div class="image-wrapper first">
									<a href="#" class="image featured first"><img src="images/pic01.jpg" alt="" /></a>
								</div>
								<header>
									<img src="<?= base_url(); ?>public/images/logo-gom.png" alt="logo" class="img-size-50 mr-3 img-circle" id="logo-gom">
								</header>
                                <h2 class="mb-3">Su registro ha sido exitoso, visite nuestro back office y comience a ganar!</h2>
                                <h4>Use su usario y contraseña para ingresar.</h4>
                                <a 
                                    id="btnBackOffice" 
                                    href="<?= site_url(); ?>" 
                                    target="_blank"
                                    style="padding:15px;"
                                    class="btn btn-outline-secondary">Ingrese al Backoffice de Ganadores One Million
                                </a>
							</section>
						</div>
					</div>
				</div>
            </div>
            <div id="copyright" class="container">
                <ul class="menu">
                    <li>&copy; Derechos reservados.</li><li>Diseñado por: <a href="https://www.facebook.com/appdvp/" target="_blank">Appdvp</a></li>
                </ul>
            </div>
        </div>
        <!-- Scripts -->
		<script src="<?= site_url(); ?>public/mi-web/assets/js/jquery.min.js"></script>
		
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    	<script src="<?= site_url(); ?>public/js/mi-web-form-new-member.js"></script>
    </body>
</div>