//VALIDACIÓN
(() => {
    'use strict';

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation');

    // Loop over them and prevent submission
    Array.from(forms).forEach((form) => {
    form.addEventListener(
        'submit',
        (event) => {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }

        form.classList.add('was-validated');
        },
        false,
    );
    });
})();

let botonesPosicion = document.querySelectorAll('[data-bs-target="#selectPosition"]');
let btnActualizarPosicion = document.getElementById('btn-actualizar-posicion');
const selectPosicionModal = document.getElementById('select-posicion')
let selectPiernasModal = document.getElementById('select-piernas')

botonesPosicion.forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation()
        let id = this.dataset.id;
        let patrocinador = this.dataset.patrocinador
        
        selectPiernasModal.addEventListener('change', function(e){

            $.ajax({
                method:"GET",
                dataType:"html",
                url: "getSocios",
                data: {
                    pierna: selectPiernasModal.selectedIndex,
                },
                beforeSend: function (f) {
                    //$('#cliente').html('Cargando ...');
                },
                success: function(data){
                    let datos = JSON.parse(data)
                    
                    selectPosicionModal.innerHTML = ''
                    let inputId = document.getElementById('id')
                    let inputPatrocinador = document.getElementById('patrocinador')
                    
                    inputId.value = id
                    inputPatrocinador.value = patrocinador
                    
                    if (datos.length > 0) {
                        selectPosicionModal.innerHTML += `<option value="0" selected>-- Seleccionar Posición --</option>`

                        for (const dato of datos) {
                            selectPosicionModal.innerHTML += `<option value="${dato.id}">${dato.nombre}</option>`
                        }
                    }else{
                        selectPosicionModal.innerHTML += `<option value="0" selected>-- Aun no hay socios en esta posición --</option>`
                        
                    }
                }
            });

        })
        
        $('#mensajeroModal').modal();
    });
});


// btnActualizarPosicion.addEventListener('click', function(e) {
//     //e.stopPropagation()

//     let id = document.getElementById('id').value
//     let patrocinador = document.getElementById('patrocinador').value
//     let tableDatos = document.getElementById('table-datos')

//     console.log('nodopadre: '.selectPosicionModal); exit;
//     $.ajax({
//         method:"GET",
//         dataType:"html",
//         url: "setPosition",
//         data: {
//             id: id,
//             patrocinador: patrocinador,
//             nodopadre: selectPosicionModal.selectedIndex,
//             posicion: selectPiernasModal.selectedIndex
//         },
//         beforeSend: function (f) {
//             //$('#cliente').html('Cargando ...');
//         },
//         success: function(res){
//             let datos = JSON.parse(res)
//             let tableDatos = document.getElementById('table-datos')
//             if (res) {
//                 alertaMensaje("La asignación de posición ha sido correcta", 1000, "success")
//             }else{
//                 alertaMensaje("Hubo un problema y no se pudo asignar la posición", 1000, "error")
//             }
            
//         }
//     });

// })

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
            emptyTable: "No hay datos disponibles en esta tabla",
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