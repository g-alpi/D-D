$(document).ready(function() {
    
    //asignamos evento a cada contenedor de imagen
    if (elementoExiste('.img-wrapper')) {
        for (let i = 1; i <= $('.img-wrapper').length; i++) {
            $('#personaje'+i).click(function () {
               if (!elementoExiste('#divCambiarAvatar')) {
                    cambiarAvatar(i);
               }
            })  
        }
    }

    function cambiarAvatar(id){
        $('#personaje'+id).after('<div id="divCambiarAvatar"> <p>Quires cambiar de foto?</p></div>');
        $('#divCambiarAvatar').append('<form id="formularioCambiarAvatar" method="post" enctype="multipart/form-data" ></form>');
        formulario= $('#formularioCambiarAvatar');
        formulario.append('<input type="hidden" name="personajeID" id="personajeID" value="'+id+'" /> ');
        formulario.append('<div class="botones-ficha"> <label id="no" class="borrar">NO</label> </div>');
        $('#no').before('<input type="file" name="fileToUpload" id="fileToUpload" /> <label for="fileToUpload">SI</label>');

        $('#fileToUpload').change(function (e) { 
            formulario.submit();
         });
        $('#no').click(function (e) {
            $('#divCambiarAvatar').remove();
        })   
    }
    function elementoExiste(idElemento){
        if($(idElemento).length) {
            return true;
        }
        return false;
    }

});