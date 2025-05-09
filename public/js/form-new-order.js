const txtCantidad = document.getElementById("cantidad")
const txtTotal = document.getElementById("total")
const selectPaquetes = document.getElementById("idpaquete")


txtCantidad.addEventListener('input', function(e) {
    //e.stopPropagation()
    let idpaquete = selectPaquetes.selectedIndex
    let cantidad = txtCantidad.value
    let total = txtTotal.value
    console.log(idpaquete);
    $.ajax({
        method:"GET",
        dataType:"json",
        url: "get-paquete",
        data: {
            idpaquete: idpaquete
        },
        beforeSend: function (f) {
            
        },
        success: function(result){
            
            let pvp = result.infoPaquete.pvp
            total = cantidad*pvp
            console.log(total);
            alertaMensaje("Se ha cambiado la cantidad", 1000, 'success')
            txtTotal.value = total
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