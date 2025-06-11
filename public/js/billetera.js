const btnAhorrar = document.getElementById('btn-ahorrar');
const cantidad = document.getElementById('porcentaje');
const inputId = document.getElementById('id');
const inputPorcentaje = document.getElementById('inputPorcentaje');
const inputValorTransferir = document.getElementById('inputValorTransferir');
const btnTransferir = document.getElementById('btn-transferir');

window.addEventListener('DOMContentLoaded', function() {
    let total_bir_pendientes = document.getElementById('total_bir_pendientes');
    inputValorTransferir.value = (total_bir_pendientes.value * inputPorcentaje.value)/100 
})

btnAhorrar.addEventListener('click', function() {
    let porcentaje = 0
    let elementoActivo = document.querySelector('input[name="porcentajeAhorro"]:checked');
    if(elementoActivo) {

        if (elementoActivo.value == 0) {
            porcentaje = 0
        } else if (elementoActivo.value == 100) {
            porcentaje = 100
        }else{
            porcentaje = parseInt(cantidad.value)
        }

        //Petición AJAX
        fetch('updateCantidadAhorro?id='+inputId.value+'&porcentaje_billetera='+porcentaje, {
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
            cantidad.value = 0
            inputPorcentaje.value = data.porcentaje
            inputValorTransferir.value = (total_bir_pendientes.value * inputPorcentaje.value)/100 
            alertaMensaje('El porcentaje de sus BIR que será pasado a la billetera digital se ha actualizado', 2000, 'success');
        })
        .catch(error => {
            alertaMensaje('Si se guarda bien pero da Error al actualizar el ahorro, CORREGIR', 1000, 'error');
            console.error(error);
        });

    } else {
        alertaMensaje('No se ha detectado una opción válida', 1000, 'error');
    }

});

btnTransferir.addEventListener('click', function() {

    let valorTransferir = (total_bir_pendientes.value * inputPorcentaje.value)/100 


    fetch('transferirBirAhorro?id='+inputId.value+'&cantidad='+valorTransferir, {
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
        alertaMensaje('El dinero a pasado a la billetera digital', 2000, 'success');
        setInterval(() => {
            window.location.reload();
        }, 2000)
    })
    .catch(error => {
        alertaMensaje('No se pudo hacer la transferencia, CORREGIR', 1000, 'error');
        console.error(error);
    });


});

cantidad.addEventListener('input', function() {
    let radioPorcentaje = document.getElementById('radioAhorrar3');
    
    radioPorcentaje.checked = true

    if (cantidad.value < 0) {
        cantidad.value = 0;
    }else if (cantidad.value > 100) {
        cantidad.value = 100;
    }
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
