//"use strict"
let btnRegistraPagoModal = document.querySelectorAll('[data-bs-target="#registraPagoModal"]');
let txtAbono = document.getElementById('total') 

var dato = 0

btnRegistraPagoModal.forEach(btn => {
    btn.addEventListener('click', function() {
        
        let idsocio = this.dataset.idsocio;
        let fecha = this.dataset.fecha;
        var saldo = this.dataset.saldo;
        let observacion = this.dataset.observacion;
        let recompra = this.dataset.recompra;

        document.getElementById('idsocio').value = idsocio;
        document.getElementById('fecha').value = fecha;
        document.getElementById('total').value = saldo;
        document.getElementById('observacion').value = observacion;
        document.getElementById('recompra').value = recompra;
        
        $('#registraPagoModal').modal();
    });
});

txtAbono.addEventListener('change', function(){
            
    let abono = parseFloat(txtAbono.value) || 0;  // convierte a número
    let saldo = parseFloat(dato) || 0;            // asegúrate que dato también sea número

    if (abono > saldo) {
        txtAbono.value = saldo;
    } else {
        txtAbono.value = abono;
    }
})

function registraPago(recompra, fecha, idsocio, observacion, total){

    //Petición AJAX
    fetch('registrarPagoRecompra?recompra='+recompra+'&fecha='+fecha+'&idsocio='+idsocio+'&observacion='+observacion+'&total='+total, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
        }
        return response.json()
        
    })
    .then(data => {
        //Hago uso de los valores devueltos por la petición
        alertaMensaje('El pago se ha registrado', 2000, 'success');
        setTimeout(function(){
            location.replace('admin-socios-list');
        }, 3000);
    })
    .catch(error => {
        alertaMensaje('Ha habido un error y no se ha podido registrar', 2000, 'error');
        console.error(error);
    });
}


$(document).ready(function () {
    $.fn.DataTable.ext.classes.sFilterInput = "form-control form-control-sm search-input";
    $('#datatablesSimple').DataTable({
        "responsive": true, 
        "order": [[1, 'asc']],
        lengthMenu: [
            [25, 50, -1],
            [25, 50, 'Todos']
        ],
        language: {
            processing: 'Procesando...',
            lengthMenu: 'Mostrando _MENU_ registros por página',
            zeroRecords: 'No hay registros',
            info: 'Mostrando _START_ a _END_ de _MAX_',
            infoEmpty: 'No hay registros disponibles',
            infoFiltered: '(filtrando de _MAX_ total registros)',
            search: 'Buscar',
            paginate: {
            first:      "Primero",
            previous:   "Anterior",
            next:       "Siguiente",
            last:       "Último"
                },
                aria: {
                    sortAscending:  ": activar para ordenar ascendentemente",
                    sortDescending: ": activar para ordenar descendentemente"
                }
        },
        //"lengthChange": false, 
        "autoWidth": false,
        "dom": "<'row'<'col-sm-12 col-md-8'l><'col-md-12 col-md-2'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>"
    });
});

const alertaMensaje = (msg, time, icon) => {
    const toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: time,
        //timerProgressBar: true,
        //height: '200rem',
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        },
        customClass: {
            // container: '...',
            popup: 'popup-class',
        }
    });
    toast.fire({
        position: "top-end",
        icon: icon,
        title: msg,
    });
}