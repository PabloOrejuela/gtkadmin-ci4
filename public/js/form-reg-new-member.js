const selectProvincia = document.getElementById("validationCustomProvincias")

selectProvincia.addEventListener('change', function(e) {
    //e.stopPropagation()
    let idprovincia = selectProvincia.selectedIndex

    $.ajax({
        method:"GET",
        dataType:"json",
        url: "select-ciudades",
        data: {
            idprovincia: idprovincia
        },
        beforeSend: function (f) {
            
        },
        success: function(resultado){
            alertaMensaje("Provincia seleccionada", 1000, 'success')
            //let res = JSON.parse(resultado)
            const selectCiudades = document.getElementById("validationCustomCiudades")

            selectCiudades.innerHTML = ""
            selectCiudades.disabled = false
            
            resultado.ciudades.forEach(element => {
                const opcion = document.createElement('option');
                opcion.value = element.id;
                opcion.text = element.ciudad;
                selectCiudades.appendChild(opcion);
            });
            
        }
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