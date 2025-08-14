const selectProvincia = document.getElementById("idprovincia")

selectProvincia.addEventListener('change', function(e) {
    //e.stopPropagation()
    let idprovincia = selectProvincia.selectedIndex
    $.ajax({
        method:"GET",
        dataType:"json",
        url: "../../select-ciudades",
        data: {
            idprovincia: idprovincia
        },
        beforeSend: function (f) {
            
        },
        success: function(resultado){
            alertaMensaje("Provincia seleccionada", 1000, 'success')
            //let res = JSON.parse(resultado)
            const selectCiudades = document.getElementById("idciudad")

            selectCiudades.innerHTML = ""
            selectCiudades.disabled = false
            
            resultado.ciudades.forEach(element => {
                const opcion = document.createElement('option');
                opcion.value = element.id;
                opcion.text = element.ciudad;
                selectCiudades.appendChild(opcion);
            });
            
        },
        
    });
    
});

function autollenarFormulario() {
    const setValue = (id, value) => {
        const el = document.getElementById(id);
        if (el) el.value = value;
    };

    let cedula = Math.floor(1700000000 + Math.random() * 9000000000).toString();

    setValue('nombre', nombreRandom());
    setValue('user', userRandom());
    setValue('password', passRandom());
    setValue('cedula', cedula);
    setValue('telefono', Math.floor(1700000000 + Math.random() * 9000000000).toString());
    setValue('telefono_2', Math.floor(1700000000 + Math.random() * 9000000000).toString());
    setValue('email', userRandom()+'@correo.com');
    setValue('direccion', 'Av. Principal 123');
    setValue('inscripcion', '150.00');

    const check = document.getElementById('invalidCheck');
    if (check) check.checked = true;

    // Provincia
    const provinciaSelect = document.getElementById('provincias');
    if (provinciaSelect && provinciaSelect.options.length > 1) {
        provinciaSelect.selectedIndex = 1;
        provinciaSelect.dispatchEvent(new Event('change'));
    }

    // Ciudad (espera a que se cargue por AJAX)
    setTimeout(() => {
        const ciudadSelect = document.getElementById('idciudad');
        if (ciudadSelect && ciudadSelect.options.length > 0) {
            ciudadSelect.selectedIndex = 0;
        }
    }, 500);
}

function nombreRandom() {
    const nombres = ["Juan", "Ana", "Luis", "María", "Pedro", "Sofía", "Carlos", "Lucía"];
    const apellidos = ["Pérez", "Gómez", "Rodríguez", "López", "Martínez", "Fernández", "Torres", "Ramírez"];
    const nombre = nombres[Math.floor(Math.random() * nombres.length)];
    const apellido = apellidos[Math.floor(Math.random() * apellidos.length)];
    return nombre + " " + apellido;
}

function userRandom() {
    const nombres = ["gato", "perro", "perico", "rata"];
    const nombre = nombres[Math.floor(Math.random() * nombres.length)];
    return nombre;
}

function passRandom() {
    const pass = ["123", "456", "789", "147", "258"]
    const password = pass[Math.floor(Math.random() * pass.length)]
    return password
}

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