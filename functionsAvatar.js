$(document).ready(function() {
    
    //asignamos evento a cada contenedor de imagen
    if (elementoExiste('.img-wrapper')) {
        for (let i = 1; i <= $('.img-wrapper').length; i++) {
            $("#"+$('.img-wrapper').attr("id")).click(function () {
               if (!elementoExiste('#divCambiarAvatar')) {
                    cambiarAvatarTusFichas($('.img-wrapper').attr("id"));
               }
            })  
        }
    }
    
    $("#logo").click(function () {
        if (!elementoExiste('#divCambiarAvatar')) {
            cambiarAvatarFicha($("#cabeceraFicha").attr("class"));
       }
    })

    function cambiarAvatarTusFichas(id){
        $("#"+id).after('<div id="divCambiarAvatar"> <p>Quires cambiar de foto?</p></div>');
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
    function cambiarAvatarFicha(id){
        $('#logo').after('<div id="divCambiarAvatar"> <p>Quires cambiar de foto?</p></div>');
        $('#divCambiarAvatar').append('<form id="formularioCambiarAvatar" method="post" enctype="multipart/form-data" ></form>');
        formulario= $('#formularioCambiarAvatar');
        formulario.append('<input type="hidden" name="id_ficha" id="id_ficha" value="'+id+'" /> ');
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