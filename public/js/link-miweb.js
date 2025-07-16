const btnCopiarLink = document.getElementById('btn-copiar-link')
const linkWeb = document.getElementById('link-miweb')
const labelMensaje = document.getElementById('lbl-mensaje')

btnCopiarLink.addEventListener('click', function() {
    let mensaje = document.getElementById('mensaje')

    if (window.isSecureContext) {
                
        navigator.clipboard.writeText(linkWeb.value)

        labelMensaje.style.color = "green"
        labelMensaje.innerHTML = "Link copiado!!!"
        alertaMensaje("El link se ha copiado!!!", 1500, 'info')

    } else {
        mensaje.innerHTML = linkWeb.value

        mensaje.select()
        mensaje.setSelectionRange(0, 9999999)
        document.execCommand('copy')
        labelMensaje.style.color = "green"
        labelMensaje.innerHTML = "Link copiado!!!"
        alertaMensaje("El link se ha copiado!!!", 1500, 'info')
    }
    
})


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