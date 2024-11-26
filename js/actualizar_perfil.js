$(document).ready(function() {
    $('#profileForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: 'actualizar_perfil.php',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    window.location.href = 'miperfil.php';
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('Hubo un problema al actualizar el perfil');
            }
        });
    });
});