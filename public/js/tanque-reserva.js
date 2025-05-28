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

botonesPosicion.forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation()
        let id = this.dataset.id;
        let selectPiernasModal = document.getElementById('select-piernas')
        

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
                    let selectPosicionModal = document.getElementById('select-posicion')
                    selectPosicionModal.innerHTML = ''
                    if (datos) {
                        selectPosicionModal.innerHTML += `<option value="0" selected>-- Seleccionar Posición --</option>`
                        for (const dato of datos) {
                            if (dato.nombre == mensajero) {
                                selectPosicionModal.innerHTML += `<option value="${dato.id}" selected>${dato.nombre}</option>`
                            }else{
                                selectPosicionModal.innerHTML += `<option value="${dato.id}">${dato.nombre}</option>`
                            }
                        }
                    }
                }
            });

        })
        
        //console.log(id);
        // document.querySelector('#codigo_pedido').value = id;
        //console.log('abrir modal');
        $('#mensajeroModal').modal();
    });
});