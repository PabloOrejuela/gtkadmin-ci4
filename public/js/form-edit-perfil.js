const txtMensaje = document.getElementById("mensaje")


window.onload = function() {
  if (txtMensaje.value == 'success') {
    alertaMensaje('La información se ha actualizado exitosamente', 2000, 'success')
  }else if(txtMensaje.value == 'error') {
    alertaMensaje('Ha ocurrido un error y no se ha podido actualizar la información', 2000, 'error')
  }
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