<link rel="stylesheet" href="<?= site_url(); ?>public/css/link-miweb.css">
<div class="row">
    <!-- Start col -->
    <div class="col-lg-7 connectedSortable">
        <!-- Mi equipo -->
        <div class="card direct-chat direct-chat-primary mb-4">
            <div class="card-header">
                <h2>Hola <?= $nombre; ?></h2>
                <h3 id="title-center">Gana con GTK Ecuador!</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="link">
                    <h4>Aquí tienes el link a tu sitio web para registrar a un socio nuevo</h4>
                    <label id="lbl-mensaje">Copiar el link!</label>
                    <input
                        type="text"
                        class="form-control"
                        id="link-miweb"
                        value="<?= site_url()?>public/mi-web/index.php?patrocinador=<?= $patrocinador;?>&nombre=<?= $nombre;?>"
                        readonly
                    />
                    
                    <button class="btn btn-primary mt-3" id="btn-copiar-link">Copiar link</button>
                </div>
            </div>
        <!-- /.card-body -->
        </div>
        <!-- /.Mi equipo-->
    </div>
    <!-- /.Start col -->
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= site_url(); ?>public/js/link-miweb.js"></script>
