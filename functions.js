$(document).ready(function() {

    inicializar();

    // Esta funcion asigna todos los eventos necesarios
    
    function inicializar() {
        $("#nombreFicha").on("input", comprobarNombre);
        $("#nombreFicha").on("keydown", changeEnter);
    }

    // Esta funcion comprueba si tiene letras el input nombre, si tiene crea el boton para seguir, sino lo elimina

    function comprobarNombre() {
        if (this.value.length > 0 && !botonExiste("#botonNombre")){
            crearBoton("botonNombre", "#nombreForm", "Siguiente Paso", formularioSeleccionRaza);
        } else if (this.value.length == 0) {
            $("#botonNombre").remove();
        };
    }

    // Esta funcion nos crea el boton de siguiente y le hace el append donde queramos con el texto que le digamos y con la funcionalidad que queramos

    function crearBoton(idBoton, insert, texto, funcion, prepend) {
        let botonSiguiente = $("<button type='button' id='" + idBoton + "'>" + texto + "</button>").on("click", funcion);
        if (prepend){
            $(insert).prepend(botonSiguiente);
        } else {
            $(insert).append(botonSiguiente);
        }
    }

    // Esta funcion nos comprueba si un boton existe

    function botonExiste(idBoton){
        if($(idBoton).length) {
            return true;
        }
        return false;
    }

    // Evita el uso normal del enter para el input de texto

    function changeEnter(event){
        if(event.key == "Enter") {
            event.preventDefault();
            $("#botonNombre").click();
        }
    }

    // Esta funcion crea el formulario de la seleccion de raza hasta que tiene que elegir una raza 

    function formularioSeleccionRaza(){
        $("#botonNombre").remove();
        $("#nombreFicha").prop('disabled',true);

        let sectionRaza = $("<section id='sectionRaza'></section>");
        let headerSeccion = $("<h2></h2>").text("Selecciona tu raza");
        sectionRaza.append(headerSeccion);
        sectionRaza.append(crearSelectRaza("raza", ""));
        sectionRaza.append($("<div id='navegacionRaza'></div>"))
        $("#nombrePersonaje").after(sectionRaza);
        crearBoton("vuelveAtrasRaza", "#navegacionRaza", "Vuelve atrás",volverAtrasRaza);
        $("#raza").on("change", function(){tieneSubraza($("#raza option:selected").text());});
    };
    
    // Nos permite volver a seleccion de nombre

    function volverAtrasRaza() {
        $("#sectionRaza").remove();
        $("#nombreFicha").prop('disabled',false);
        crearBoton("botonNombre", "#nombreForm", "Siguiente Paso", formularioSeleccionRaza);
    }

    // Esta funcion crea el formulario de select de la raza

    function crearSelectRaza(tipo, raza_padre) {
        let selectorRaza = $("<select id='" + tipo + "' name='" + tipo + "'></select>");        
        let opcionesRaza = $("<option hidden disabled selected>Selecciona tu " + tipo + "</option>");
        selectorRaza.append(opcionesRaza);
        
        $.each(razas, function(index, value){
            if(razas[index]["raza_padre"] == raza_padre) {
                opcionesRaza = $("<option value='" + razas[index]["idRaza"] + "'>" + index + "</option>");
                selectorRaza.append(opcionesRaza);
            }
        });

        return selectorRaza;
    }

    // Esta funcion comprueba si tiene o no una subraza y llama la funcion acorde 

    function tieneSubraza(nombreRaza) {
        if (razas[nombreRaza]["tiene_hijos"]) {
            formularioSeleccionSubraza(nombreRaza);
        } else {
            detallesRaza(nombreRaza);
        }
    };

    // Esta funcion crea la descripcion de la raza padre y añade un selector de raza hija

    function formularioSeleccionSubraza(nombreRaza) {
        $("#siguientePasoRaza").remove();
        $("#grid-container-subraza-selector").remove();
        $("#grid-container-raza").remove();

        let grid = $("<div id='grid-container-subraza-selector'></div>");
        grid.append(descripcionRaza(nombreRaza));
        let headerSeccion = $("<h2></h2>").text("Selecciona tu Subraza");
        grid.append(headerSeccion);
        grid.append(crearSelectRaza("subraza", nombreRaza));

        $("#navegacionRaza").before(grid);

        $("#subraza").on("change", function(){detallesRaza($("#subraza option:selected").text(), nombreRaza);});

    }

    // Esta funcion crea el apartado descripcion de una raza

    function descripcionRaza(nombreRaza) {
        let gridItem = $("<div class='grid-item-1'></div>");
        let tituloSeccion = $("<h3></h3>").text("Descripción");
        gridItem.append(tituloSeccion);
        let descripcion = $("<p></p>").text(razas[nombreRaza]["descripcion"]);
        gridItem.append(descripcion);
        return gridItem;
    }

    /* Esta funcion crea la descripcion de las razas que no tienen razas hijas ni razas padres */

    function detallesRaza(nombreRaza, nombreRazaPadre) {
        
        if (!nombreRazaPadre) {
            $("#grid-container-subraza-selector").remove();
        }
        $("#grid-container-raza").remove();

        let grid = $("<div id='grid-container-raza'></div>");

        grid.append(descripcionRaza(nombreRaza));

        if (nombreRazaPadre){
            grid.append(puntosEstadisticaRaza(nombreRaza, nombreRazaPadre));
        } else {
            grid.append(puntosEstadisticaRaza(nombreRaza));
        }

        grid.append(velocidadMovimientoRaza(nombreRaza));

        grid.append(visionRaza(nombreRaza));

        if(nombreRazaPadre) {
            grid.append(habilidadesRacialesRaza(nombreRaza, nombreRazaPadre));
        } else {
            grid.append(habilidadesRacialesRaza(nombreRaza));
        }
       
        if (nombreRazaPadre) {
            grid.append(idiomasRaciales(nombreRaza, nombreRazaPadre));
        } else {
            grid.append(idiomasRaciales(nombreRaza));
        }

        $("#navegacionRaza").before(grid);

        if (!botonExiste("#siguientePasoRaza")){
            crearBoton("siguientePasoRaza", "#navegacionRaza", "Siguiente Paso", siguienteRaza);
        }
    };

    // Crea la funcionalidad del siguiente de raza

    function siguienteRaza() {
        $('#raza').prop( "disabled", true );
        $('#subraza').prop( "disabled", true );
        $('#vuelveAtrasRaza').remove();
        $('#siguientePasoRaza').remove();
        formularioSeleccionClase();
    }

    // Devuelve para añadir al DOM la informacion de estadisticas

    function puntosEstadisticaRaza(nombreRaza, nombreRazaPadre) {
        let gridItem = $("<div class='grid-item-2'></div>");
        tituloSeccion = $("<h3></h3>").text("Puntos de estadística");
        gridItem.append(tituloSeccion);
        if (!nombreRazaPadre){
            descripcion = $("<p></p>").text("+" + razas[nombreRaza]["incremento_estadistica"] + " a la " + razas[nombreRaza]["estadistica_incrementada"] + ".");
        } else {
            descripcion = $("<p></p>").text("+" + razas[nombreRaza]["incremento_estadistica"] + " a la " + razas[nombreRaza]["estadistica_incrementada"] + " y +" + razas[nombreRazaPadre]["incremento_estadistica"] + " a la " + razas[nombreRazaPadre]["estadistica_incrementada"] + ".");
        }
        gridItem.append(descripcion);
        return gridItem;
    }

    // Devuelve para añadir al DOM la informacion de la velocidad

    function velocidadMovimientoRaza(nombreRaza) {
        gridItem = $("<div class='grid-item-3'></div>");
        tituloSeccion = $("<h3></h3>").text("Velocidad de movimiento");
        gridItem.append(tituloSeccion);
        descripcion = $("<p></p>").text(razas[nombreRaza]["velocidad"] + " Pies.");
        gridItem.append(descripcion);
        return gridItem;
    }

    // Devuelve para añadir al DOM la informacion de la vision

    function visionRaza(nombreRaza){
        gridItem = $("<div class='grid-item-4'></div>");
        tituloSeccion = $("<h3></h3>").text("Visión");
        gridItem.append(tituloSeccion);
        descripcion = $("<p></p>").text(razas[nombreRaza]["vision"]);
        gridItem.append(descripcion);
        return gridItem;
    }

    // Devuelve para añadir al DOM la informacion de las habilidades raciales

    function habilidadesRacialesRaza(nombreRaza, nombreRazaPadre) {
        gridItem = $("<div class='grid-item-5'></div>");
        tituloSeccion = $("<h3></h3>").text("Habilidades Raciales");
        gridItem.append(tituloSeccion);

        let divSeccion = $("<div></div>");
        let divSeccionInterior;

        if(nombreRazaPadre) {
            $.each(razas[nombreRazaPadre]["habilidades_raciales"], function(index, habilidad){
                divSeccionInterior = $("<div></div>");
                descripcion = $("<h4></h4>").text(habilidad[0]);
                divSeccionInterior.append(descripcion);
                descripcion = $("<p></p>").text(habilidad[1]);
                divSeccionInterior.append(descripcion);
                divSeccion.append(divSeccionInterior);
            });
        }

        $.each(razas[nombreRaza]["habilidades_raciales"], function(index, habilidad){
            divSeccionInterior = $("<div></div>");
            descripcion = $("<h4></h4>").text(habilidad[0]);
            divSeccionInterior.append(descripcion);
            descripcion = $("<p></p>").text(habilidad[1]);
            divSeccionInterior.append(descripcion);
            divSeccion.append(divSeccionInterior);
        });

        gridItem.append(divSeccion);

        return gridItem;
    }

    // Devuelve para añadir al DOM la informacion de los idiomas raciales

    function idiomasRaciales(nombreRaza, nombreRazaPadre) {
        gridItem = $("<div class='grid-item-6'></div>");
        tituloSeccion = $("<h3></h3>").text("Idiomas Raciales");
        gridItem.append(tituloSeccion);

        let idiomas = "";
        
        if (!nombreRazaPadre) {
            $.each(razas[nombreRaza]["idiomas"], function(index, idioma){
                idiomas += idioma;
                if (idioma == razas[nombreRaza]["idiomas"][razas[nombreRaza]["idiomas"].length -1]){
                    idiomas += "."
                } else {
                    idiomas += ", ";
                }

            });
        } else {
            $.each(razas[nombreRazaPadre]["idiomas"], function(index, idioma){
                idiomas += idioma; 
                if (idioma == razas[nombreRazaPadre]["idiomas"][razas[nombreRazaPadre]["idiomas"].length -1]){
                    idiomas += "."
                } else {
                    idiomas += ", ";
                } 
            });
        }

        descripcion = $("<p></p>").text(idiomas);

        gridItem.append(descripcion);

        return gridItem;
    }

    // Crea el formulario de seleccion de clases

    function formularioSeleccionClase() {
        $("#botonNombre").remove();
        $("#raza").prop('disabled',true);
        $("#subraza").prop('disabled',true);
        let sectionClase = $("<section id='sectionClase'></section>");
        let headerSeccion = $("<h2></h2>").text("Selecciona tu clase");
        sectionClase.append(headerSeccion);
        sectionClase.append(crearSelectClase());
        sectionClase.append($("<div id='navegacionClase'></div>"))
        $("#sectionRaza").after(sectionClase);
        crearBoton("vuelveAtrasClase", "#navegacionClase", "Vuelve atrás",volverAtrasClase);
        $("#clase").on("change", function(){detallesClase($("#clase option:selected").text());});
    }

    // Crea el boton de volver atras de la clase

    function volverAtrasClase() {
        $("#sectionClase").remove();
        $("#raza").prop('disabled',false);
        $("#subraza").prop('disabled',false);
        crearBoton("vuelveAtrasRaza", "#navegacionRaza", "Vuelve atrás",volverAtrasRaza);
        crearBoton("siguientePasoRaza", "#navegacionRaza", "Siguiente Paso", siguienteRaza);
    }

    // Crear Select Clase

    function crearSelectClase() {
        let selectorClase = $("<select id='clase' name='clase'></select>");        
        let opcionesClase = $("<option hidden disabled selected>Selecciona tu clase</option>");
        selectorClase.append(opcionesClase);
        
        $.each(clases, function(index, value){
            opcionesClase = $("<option value='" + clases[index]["id"] + "'>" + index + "</option>");
            selectorClase.append(opcionesClase);
        });
        
        return selectorClase;
    }

    // Tiene la logica de los documentos de los elementos del DOM

    function detallesClase(nombreClase) {
        $("#container-clase").remove();

        let flex = $("<div id='container-clase'></div>");

        flex.append(dgClase(nombreClase));
        flex.append(estadisticasPrincipalesClase(nombreClase));
        flex.append(salvacionesClase(nombreClase));

        $("#navegacionClase").before(flex);

        if (!botonExiste("#siguientePasoClase")){
            crearBoton("siguientePasoClase", "#navegacionClase", "Siguiente Paso", siguienteClase);
        }
    }

    // Devuelve el elemento del DOM para mostrar los dg de la clase

    function dgClase(nombreClase) {
        let flexItem = $("<div></div>");
        tituloSeccion = $("<h3></h3>").text("Dado de golpe");
        flexItem.append(tituloSeccion);
        descripcion = $("<p></p>").text(clases[nombreClase]["dg"]);
        flexItem.append(descripcion);
        return flexItem;
    }

    // Devuelve el elemento del DOM para mostrar las caracteristicas principales

    function estadisticasPrincipalesClase(nombreClase) {
        let flexItem = $("<div></div>");
        tituloSeccion = $("<h3></h3>").text("Estadística Principal");
        flexItem.append(tituloSeccion);
        let texto = clases[nombreClase]["caracteristicaPrimaria1"];
        if (nombreClase == "guerrero") {
            texto += " o " + clases[nombreClase]["caracteristicaPrimaria2"]; 
        } else if (clases[nombreClase]["caracteristicaPrimaria2"] != "") {
            texto += " y " + clases[nombreClase]["caracteristicaPrimaria2"]; 
        }
        descripcion = $("<p></p>").text(texto);
        flexItem.append(descripcion);
        return flexItem;
    }

    // Devuelve el elemento del DOM para crear las salvaciones

    function salvacionesClase(nombreClase) {
        let flexItem = $("<div></div>");
        tituloSeccion = $("<h3></h3>").text("Salvaciones");
        flexItem.append(tituloSeccion);
        let texto = clases[nombreClase]["competenciaSalvacion1"];
        if (clases[nombreClase]["competenciaSalvacion2"] != "") {
            texto += " y " + clases[nombreClase]["competenciaSalvacion2"]; 
        }
        descripcion = $("<p></p>").text(texto);
        flexItem.append(descripcion);
        return flexItem;
    }

    function siguienteClase() {
        $('#clase').prop( "disabled", true );
        $('#vuelveAtrasClase').remove();
        $('#siguientePasoClase').remove();
        formularioHabilidades();
    }

    function formularioHabilidades() {
        let andamio=$("<section id='container-habilidades'></section>");
        $("#crearPersonajeForm").append(andamio);
        let titulo= $("<h2></h2>").text("Reparte los puntos de Estadística");
        andamio.append(titulo);
    
        let puntos=27;
    
        andamio.append("<div id='puntos'>"+puntos+"/27</div>");
        andamio.append("<div id='container-select'></div>");
    
        let divFuerza=$("<div id='div_fuerza'><p>Fuerza</p>  <select id='fuerza' name='fuerza'></select>   </div>");
        $("#container-select").append(divFuerza);
        generarOptions('#fuerza');
        
    
        divDestreza=$("<div id='div_destreza'><p>Destreza</p>   <select id='destreza' name='destreza'></select>  </div>");
        $("#container-select").append(divDestreza);
        generarOptions('#destreza');
    
        divConstitucion=$("<div id='div_constitucion'><p> Constitucion</p>  <select id='constitucion' name='constitucion'></select>    </div>");
        $("#container-select").append(divConstitucion)
        generarOptions('#constitucion');
        
    
        divInteligencia=$("<div id='div_inteligencia'><p> Inteligencia </p>  <select id='inteligencia' name='inteligencia'></select>  </div>");
        $("#container-select").append(divInteligencia);
        generarOptions('#inteligencia');
        
    
        divSabiduria=$("<div id='div_sabiduria'><p> Sabiduria</p>   <select id='sabiduria' name='sabiduria'></select>   </div>");
        $("#container-select").append(divSabiduria);
        generarOptions('#sabiduria');
        
    
        divCarisma=$("<div id='div_carisma'><p> Carisma </p>  <select id='carisma' name='carisma'></select>   </div>");
        $("#container-select").append(divCarisma);
        generarOptions('#carisma');
        
        
        andamio.append($("<div id='navegacionHabilidades'><button id='vuelveAtrasHabilidad'>Vuelve atrás</button></div>"));

        

        $('#vuelveAtrasHabilidad').click(function () {
            $(andamio).remove();
            $('#clase').prop( "disabled", false );

            crearBoton("vuelveAtrasClase", "#navegacionClase", "Vuelve atrás",volverAtrasClase);      
            crearBoton("siguientePasoClase", "#navegacionClase", "Siguiente Paso", siguienteClase);
        })
        


        let habilidades= {"fuerza":8,"destreza":8,"constitucion":8,"inteligencia":8,"sabiduria":8,"carisma":8};
        
        $('#fuerza').click(function () { 
                puntos+=selectValor('#fuerza',puntos,habilidades);
                selectValor("#destreza", puntos, habilidades, "repeat");
                selectValor("#constitucion", puntos, habilidades, "repeat");
                selectValor("#inteligencia", puntos, habilidades, "repeat");
                selectValor("#sabiduria", puntos, habilidades, "repeat");
                selectValor("#carisma", puntos, habilidades, "repeat");
                
                if(puntos==0 && !botonExiste("#siguientePasoHabilidad")){crearBoton('siguientePasoHabilidad','#navegacionHabilidades','Siguiente Paso',siguientePasoHabilidad)}
                
        })
    
        $('#destreza').click(function () {    
                puntos+=selectValor('#destreza',puntos,habilidades);  
                selectValor("#fuerza", puntos, habilidades, "repeat");
                selectValor("#constitucion", puntos, habilidades, "repeat");
                selectValor("#inteligencia", puntos, habilidades, "repeat");
                selectValor("#sabiduria", puntos, habilidades, "repeat");
                selectValor("#carisma", puntos, habilidades, "repeat"); 

                if(puntos==0 && !botonExiste("#siguientePasoHabilidad")){crearBoton('siguientePasoHabilidad','#navegacionHabilidades','Siguiente Paso',siguientePasoHabilidad)}     
        })
    
        $('#constitucion').click(function () {       
                puntos+=selectValor('#constitucion',puntos,habilidades);
                selectValor("#destreza", puntos, habilidades, "repeat");
                selectValor("#fuerza", puntos, habilidades, "repeat");
                selectValor("#inteligencia", puntos, habilidades, "repeat");
                selectValor("#sabiduria", puntos, habilidades, "repeat");
                selectValor("#carisma", puntos, habilidades, "repeat");

                if(puntos==0 && !botonExiste("#siguientePasoHabilidad")){crearBoton('siguientePasoHabilidad','#navegacionHabilidades','Siguiente Paso',siguientePasoHabilidad)}
        })
    
        $('#inteligencia').click(function () {     
                puntos+=selectValor('#inteligencia',puntos,habilidades);
                selectValor("#destreza", puntos, habilidades, "repeat");
                selectValor("#constitucion", puntos, habilidades, "repeat");
                selectValor("#fuerza", puntos, habilidades, "repeat");
                selectValor("#sabiduria", puntos, habilidades, "repeat");
                selectValor("#carisma", puntos, habilidades, "repeat");

                if(puntos==0 && !botonExiste("#siguientePasoHabilidad")){crearBoton('siguientePasoHabilidad','#navegacionHabilidades','Siguiente Paso',siguientePasoHabilidad)}
        })
    
        $('#sabiduria').click(function () {        
                puntos+=selectValor('#sabiduria',puntos,habilidades);
                selectValor("#destreza", puntos, habilidades, "repeat");
                selectValor("#constitucion", puntos, habilidades, "repeat");
                selectValor("#inteligencia", puntos, habilidades, "repeat");
                selectValor("#fuerza", puntos, habilidades, "repeat");
                selectValor("#carisma", puntos, habilidades, "repeat");
                if(puntos==0 && !botonExiste("#siguientePasoHabilidad")){crearBoton('siguientePasoHabilidad','#navegacionHabilidades','Siguiente Paso',siguientePasoHabilidad)}
                else if(botonExiste("#siguientePasoHabilidad")){
                    $("#siguientePasoHabilidad").remove()
                }    
        })
    
        $('#carisma').click(function () { 
                puntos+=selectValor('#carisma',puntos,habilidades);
                selectValor("#destreza", puntos, habilidades, "repeat");
                selectValor("#constitucion", puntos, habilidades, "repeat");
                selectValor("#inteligencia", puntos, habilidades, "repeat");
                selectValor("#sabiduria", puntos, habilidades, "repeat");
                selectValor("#fuerza", puntos, habilidades, "repeat");
                if(puntos==0 && !botonExiste("#siguientePasoHabilidad")){crearBoton('siguientePasoHabilidad','#navegacionHabilidades','Siguiente Paso',siguientePasoHabilidad)}
        })    
    
    }
    function vuelveAtrasHabilidad(){
        $("#container-habilidades").remove();
        $('#raza').prop( "disabled", false );
        $('#subraza').prop( "disabled", false );
        crearBoton("vuelveAtrasClase", "#navegacionClase", "Vuelve atrás",volverAtrasClase);
        crearBoton("siguientePasoClase", "#navegacionClase", "Siguiente Paso", siguienteClase);
    }
    

    function siguientePasoHabilidad(){
        $('#fuerza').prop('disabled',true);
        $('#destreza').prop('disabled',true);
        $('#constitucion').prop('disabled',true);
        $('#inteligencia').prop('disabled',true);
        $('#sabiduria').prop('disabled',true);
        $('#carisma').prop('disabled',true);
        $("#container-habilidades").after('<section id="sectionTrasfondo"></section>');
        $('#vuelveAtrasHabilidad').remove();
        $('#siguientePasoHabilidad').remove();
        formularioTrasfondo();
    }
        
    function selectValor(habilidad,puntos,diccionario,repeat){
        
        lvlHabilidad=$(habilidad).val();
        $(habilidad+' option').remove();
        
        let texto=habilidad.substring(1, habilidad.lenght);
    
        
        let costePuntos8= {8: 0, 9: -1, 10: -2, 11: -3, 12: -4, 13: -5, 14: -7, 15: -9};
        let costePuntos9= {8: 1, 9: 0, 10: -1, 11: -2, 12: -3, 13: -4, 14: -6, 15: -8};
        let costePuntos10= {8: 2, 9: 1, 10: 0, 11: -1, 12: -2, 13: -3, 14: -5, 15: -7};
        let costePuntos11= {8: 3, 9: 2, 10: 1, 11: 0, 12: -1, 13: -2, 14: -4, 15: -6};
        let costePuntos12= {8: 4, 9: 3, 10: 2, 11: 1, 12: 0, 13: -1, 14: -3, 15: -5};
        let costePuntos13= {8: 5, 9: 4, 10: 3, 11: 2, 12: 1, 13: 0, 14: -2, 15: -4};
        let costePuntos14= {8: 7, 9: 6, 10: 5, 11: 4, 12: 3, 13: 2, 14: 0, 15: -2};
        let costePuntos15= {8: 9, 9: 8, 10: 7, 11: 6, 12: 5, 13: 4, 14: 2, 15: 0};
  
        for (let i=8; i <=15; i++) {
             
            if (diccionario[texto]==8) {
                if(puntos+parseInt(costePuntos8[i])>=0){ $(habilidad).append('<option value='+i+'>'+i+'</option>');}
                else{ break;}
            }
            else if (diccionario[texto]==9) {
                if(puntos+parseInt(costePuntos9[i])>=0){ $(habilidad).append('<option value='+i+'>'+i+'</option>'); }
                else{break;}
            }
            else if (diccionario[texto]==10) {
                if(puntos+parseInt(costePuntos10[i])>=0){ $(habilidad).append('<option value='+i+'>'+i+'</option>'); }
                else{break;}
            }
            else if (diccionario[texto]==11) {
                if(puntos+parseInt(costePuntos11[i])>=0){ $(habilidad).append('<option value='+i+'>'+i+'</option>'); }
                else{break;}
            }
            else if (diccionario[texto]==12) {
                if(puntos+parseInt(costePuntos12[i])>=0){ $(habilidad).append('<option value='+i+'>'+i+'</option>'); }
                else{break;}
            }
            else if (diccionario[texto]==13) {
                if(puntos+parseInt(costePuntos13[i])>=0){ $(habilidad).append('<option value='+i+'>'+i+'</option>'); }
                else{break;}
            }
            else if (diccionario[texto]==14) {
                if(puntos+parseInt(costePuntos14[i])>=0){ $(habilidad).append('<option value='+i+'>'+i+'</option>'); }
                else{break;}
            }
            else if (diccionario[texto]==15) {
                if(puntos+parseInt(costePuntos15[i])>=0){ $(habilidad).append('<option value='+i+'>'+i+'</option>'); }
                else{break;}
            }
            
       }
    
        $(habilidad+' option[value="'+lvlHabilidad+'"]').attr('selected',"");
       


        if (diccionario[texto]==8) {
            diccionario[texto]=lvlHabilidad;
            $("#puntos").text(puntos+costePuntos8[lvlHabilidad]+"/27");
            return costePuntos8[lvlHabilidad];
        }
        else if (diccionario[texto]==9) {
            diccionario[texto]=lvlHabilidad;
            $("#puntos").text(puntos+costePuntos9[lvlHabilidad]+"/27"); 
            return costePuntos9[lvlHabilidad];
        }
        else if (diccionario[texto]==10) {
            diccionario[texto]=lvlHabilidad;
            $("#puntos").text(puntos+costePuntos10[lvlHabilidad]+"/27"); 
            return costePuntos10[lvlHabilidad];
        }
        else if (diccionario[texto]==11) {
            diccionario[texto]=lvlHabilidad;
            $("#puntos").text(puntos+costePuntos11[lvlHabilidad]+"/27"); 
            return costePuntos11[lvlHabilidad];
        }
        else if (diccionario[texto]==12) {
            diccionario[texto]=lvlHabilidad;
            $("#puntos").text(puntos+costePuntos12[lvlHabilidad]+"/27"); 
            return costePuntos12[lvlHabilidad];
        }
        else if (diccionario[texto]==13) {
            diccionario[texto]=lvlHabilidad;
            $("#puntos").text(puntos+costePuntos13[lvlHabilidad]+"/27"); 
            return costePuntos13[lvlHabilidad];
        }
        else if (diccionario[texto]==14) {
            diccionario[texto]=lvlHabilidad;
            $("#puntos").text(puntos+costePuntos14[lvlHabilidad]+"/27"); 
            return costePuntos14[lvlHabilidad];
        }
        else if (diccionario[texto]==15) {
            diccionario[texto]=lvlHabilidad;
            $("#puntos").text(puntos+costePuntos15[lvlHabilidad]+"/27"); 
            return costePuntos15[lvlHabilidad];
        }
        


        
    }
    
    
    function generarOptions(constructor) {
        for (let i=8; i <=15; i++) {
                 $(constructor).append('<option value='+i+'>'+i+'</option>');
                
            }   
    }


    function formularioTrasfondo() {
        
        let headerSeccion = $("<h2></h2>").text("Selecciona tu trasfondo");
        sectionTrasfondo=$("#sectionTrasfondo");
        sectionTrasfondo.append(headerSeccion);

        let selectorTrasfondo =$("<select id='selectTrasfondo' name='trasfondo'></select>") ;
        let opcionesTrasfondo;
        
        opcionesTrasfondo = $("<option hidden disabled selected>Selecciona tu Trasfondo</option>");
        selectorTrasfondo.append(opcionesTrasfondo);

        
        
        $.each(trasfondos, function(index, value){
            opcionesTrasfondo = $("<option value='" + trasfondos[index]["idTrasfondo"] + "'>" + index + "</option>");
            selectorTrasfondo.append(opcionesTrasfondo);
            
        });

        sectionTrasfondo.append(selectorTrasfondo);
        sectionTrasfondo.append($("<div id='navegacionTrasfondo'></div>"));
        crearBoton("vuelveAtrasTrasfondo", "#navegacionTrasfondo", "Vuelve atrás",volverAtrasTrasfondo);
        
        
        
        selectorTrasfondo.change(function () { descripcionTrasfondo($("#selectTrasfondo option:selected").text()); })
        
        
        
    }
    function volverAtrasTrasfondo(){
        $('#sectionTrasfondo').remove();
        $('#fuerza').prop('disabled',false);
        $('#destreza').prop('disabled',false);
        $('#constitucion').prop('disabled',false);
        $('#inteligencia').prop('disabled',false);
        $('#sabiduria').prop('disabled',false);
        $('#carisma').prop('disabled',false);
        crearBoton("vuelveAtrasHabilidad","#navegacionHabilidades","Vuelve atrás",vuelveAtrasHabilidad);
        crearBoton('siguientePasoHabilidad','#navegacionHabilidades','Siguiente Paso',siguientePasoHabilidad);


    }

    function descripcionTrasfondo(nombreTrasfondo) {
        $("#grid-descripcion-trasfondo").remove();
        $("#grid-habilidades").remove();
        
        /* Grid */
        let grid = $("<div id='grid-container-trasfondo'></div>");

        /* Descripción */

        let gridItem = $("<div id='grid-descripcion-trasfondo'></div>");
        let tituloSeccion = $("<h3></h3>").text("Descripción");
        gridItem.append(tituloSeccion);
        let descripcion = $("<p></p>").text(trasfondos[nombreTrasfondo]["descripcion"]);
        gridItem.append(descripcion);
        grid.append(gridItem);

        /* Habilidades potenciadas */

        gridItem = $("<div id='grid-habilidades'></div>");
        tituloSeccion = $("<h3></h3>").text("Habilidades potenciadas");
        gridItem.append(tituloSeccion);
        descripcion = $("<p></p>").text(trasfondos[nombreTrasfondo]["habilidad_adicional_1"]);
        gridItem.append(descripcion);
        descripcion = $("<p></p>").text(trasfondos[nombreTrasfondo]["habilidad_adicional_2"]);
        gridItem.append(descripcion);
        grid.append(gridItem);

        gridItem.append(descripcion);
        grid.append(gridItem);
        

        $("#navegacionTrasfondo").before(grid);
        if(!botonExiste('#siguientePasoTrasfondo')){
            crearBoton("siguientePasoTrasfondo", "#navegacionTrasfondo", "Siguiente Paso",siguientePasoTrasfondo);
        }
    }

    function siguientePasoTrasfondo(){
        $('#selectTrasfondo').prop('disabled',true);
        $("#sectionTrasfondo").after('<section id="sectionIdioma"></section>');
        $('#vuelveAtrasTrasfondo').remove();
        $('#siguientePasoTrasfondo').remove();
        formularioIdiomas();
    }

    function formularioIdiomas(){
        let headerSeccion = $("<h2></h2>").text("Selecciona los dos idiomas de tu trasfondo");
        sectionIdiomas=$("#sectionIdioma");
        sectionIdiomas.append(headerSeccion);

        let stringIdiomasRaza=$('.grid-item-6 p:first-of-type').text();
        stringIdiomasRaza=stringIdiomasRaza.substring(0,stringIdiomasRaza.length-1);
        let idiomasRaza=stringIdiomasRaza.split(', ');

        for (let i = 0; i < idiomasRaza.length; i++) {
            var index = idiomas.indexOf(idiomasRaza[i]);
            if (index !== -1) {
                idiomas.splice(index, 1);
            }
                    
        }
        
        let divIdiomas = $("<div id='divIdiomas'></div>");

        $.each(idiomas, function (i, value) { 
             divIdiomas.append('<div><input type="checkbox" id="idioma'+(i+1)+'" name="idioma'+(i+1)+'" value="'+value+'" class="checkbox">  <label for="idioma'+(i+1)+'">'+value+'</label></div>')
        });

        sectionIdiomas.append(divIdiomas);

        // codigo para limite
        limite=2
        $('input.checkbox').on('change', function(evt) {

            if($("input.checkbox:checked").length > limite) {
                this.checked = false;

            } else if ($("input.checkbox:checked").length == limite){
                if (!botonExiste("#siguienteIdioma")){
                    crearBoton("siguienteIdioma", "#navegacionIdioma", "Siguiente Paso",siguientePasoIdiomas);
                };  
            } else if($("input.checkbox:checked").length < limite) {
                $("#siguienteIdioma").remove();
            }
         });
        sectionIdiomas.append($("<div id='navegacionIdioma'></div>"));
        crearBoton("vuelveAtrasIdioma", "#navegacionIdioma", "Vuelve atrás",vuelveAtrasIdioma);

    }

    function vuelveAtrasIdioma(){
        $("#sectionIdioma").remove();
        $('#selectTrasfondo').prop('disabled',false);
        crearBoton("vuelveAtrasTrasfondo", "#navegacionTrasfondo", "Vuelve atrás",volverAtrasTrasfondo);
        crearBoton("siguientePasoTrasfondo", "#navegacionTrasfondo", "Siguiente Paso",siguientePasoTrasfondo);
    }


    // Esta funcion te hace el paso siguiente a los idiomas

    function siguientePasoIdiomas() {
        $("#siguienteIdioma").remove();
        $("#vuelveAtrasIdioma").remove();
        descripcionObjetos();
    }

    // Esta funcion te genera las opciones de equipamiento que tiene cada clase al elegirla

    function descripcionObjetos(){
        let clase = $("#clase option:selected").text();
        $("#sectionIdioma input").prop('disabled',true);
        let sectionObjetos = $("<section id='sectionObjetos'></section>");
        let headerSeccion = $("<h2></h2>").text("Dispones del siguiente equipamiento");
        sectionObjetos.append(headerSeccion);
        let equipamiento = $("<div id='equipamiento'></div>");
        equipamiento.append("<div><p>Arma: " + clases[clase]["armaInicial"] + "</p></div>");
        equipamiento.append("<div><p>Armadura: " + clases[clase]["armaduraInicial"] + "</p></div>");
        equipamiento.append("<div><p>Oro inicial: " + clases[clase]["oroInicial"] + " PO</p></div>");
        sectionObjetos.append(equipamiento);
        sectionObjetos.append("<div id='navegacionObjetos'></div>");
        $("#crearPersonajeForm").append(sectionObjetos);
        crearBoton("vuelveAtrasObjetos", "#navegacionObjetos", "Vuelve atrás", vuelveAtrasObjetos);
        let submit = $("<input type='submit' value='Guardar Ficha'>");
        submit.click(submitForm);
        $("#navegacionObjetos").append(submit);
    }

    // Esta funcion te permite volver a la seccion anterior de los objetos

    function vuelveAtrasObjetos() {
        $("#sectionIdioma input").prop('disabled',false);
        $("#sectionObjetos").remove();
        crearBoton("vuelveAtrasIdioma", "#navegacionIdioma", "Vuelve atrás",vuelveAtrasIdioma);
        crearBoton("siguienteIdioma", "#navegacionIdioma", "Siguiente Paso",siguientePasoIdiomas);
    }
    
    // Esta funcion modifica el comportamiento del submit
    
    function submitForm(event){
        event.preventDefault();
        $("#nombreFicha").prop('disabled',false);
        $("#raza").prop('disabled',false);
        $("#subraza").prop('disabled',false);
        $('#clase').prop( "disabled", false );
        $('#fuerza').prop('disabled',false);
        $('#destreza').prop('disabled',false);
        $('#constitucion').prop('disabled',false);
        $('#inteligencia').prop('disabled',false);
        $('#sabiduria').prop('disabled',false);
        $('#carisma').prop('disabled',false);
        $('#selectTrasfondo').prop('disabled',false);
        $("#sectionIdioma input").prop('disabled',false);
        $("#crearPersonajeForm").submit();
    }
});