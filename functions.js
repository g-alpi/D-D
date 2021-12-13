$(document).ready(function() {
    /* Añade un evento al botón de siguiente*/
    $("#botonNombre").on('click',formularioSeleccionRaza);
    /* Esta funcion crea el formulario de la seleccion de raza hasta que tiene que elegir una raza */

    function formularioSeleccionRaza(){
        $("#nombreFicha").prop('disabled',true);
        let sectionRaza = $("<section id='sectionRaza'></section>");
        
        /* Header */

        let headerSeccion = $("<h2></h2>").text("Selecciona tu raza");
        sectionRaza.append(headerSeccion);

        /* Select Raza */

        let selectorRaza = $("<select id='raza' name='raza'></select>");
        let opcionesRaza;
        
        opcionesRaza = $("<option hidden disabled selected>Selecciona tu Raza</option>");
        selectorRaza.append(opcionesRaza);
        
        $.each(razas, function(index, value){
            if(razas[index]["raza_padre"] == "") {
                opcionesRaza = $("<option value='" + index + "'>" + index + "</option>");
                selectorRaza.append(opcionesRaza);
            }
        });

        sectionRaza.append(selectorRaza);
        sectionRaza.append($("<div id='navegacionRaza'><button id='vuelveAtrasRaza'>Vuelve atrás</button></div>"))
        $("#nombrePersonaje").after(sectionRaza);

        $("#raza").on("change", function(){tieneSubraza(this.value);});
        $("#vuelveAtrasRaza").on("click", function(){$("#sectionRaza").remove();
        $("#nombreFicha").prop('disabled',false);});
    };
    
    /* Esta funcion comprueba si tiene o no una subraza y llama la funcion acorde */

    function tieneSubraza(nombreRaza) {
        if (razas[nombreRaza]["tiene_hijos"]) {
            formularioSeleccionSubraza(nombreRaza);
        } else {
            descripcionRaza(nombreRaza);
        }
    };

    /* Esta funcion crea la descripcion de la raza padre y añade un selector de raza hija */

    function formularioSeleccionSubraza(nombreRaza) {

        /* Elimina los otros containers */
        $("#siguientePasoRaza").remove();
        $("#grid-container-subraza-selector").remove();
        $("#grid-container-raza").remove();

        let grid = $("<div id='grid-container-subraza-selector'></div>");

        /* Descripción */

        let gridItem = $("<div id='grid-item-1'></div>");
        let tituloSeccion = $("<h3></h3>").text("Descripción");
        gridItem.append(tituloSeccion);
        let descripcion = $("<p></p>").text(razas[nombreRaza]["descripcion"]);
        gridItem.append(descripcion);
        grid.append(gridItem);

        /* Header subraza */

        let headerSeccion = $("<h2></h2>").text("Selecciona tu Subraza");
        grid.append(headerSeccion);

        /* Select Subraza */

        let selectorRaza = $("<select id='subraza' name='subraza'></select>");
        let opcionesRaza;
                
        opcionesRaza = $("<option hidden disabled selected>Selecciona tu Subraza</option>");
        selectorRaza.append(opcionesRaza);
                
        $.each(razas, function(index, value){
            if(razas[index]["raza_padre"] == nombreRaza) {
                opcionesRaza = $("<option value='" + index + "'>" + index + "</option>");
                selectorRaza.append(opcionesRaza);
            }
        });
        
        grid.append(selectorRaza);

        $("#navegacionRaza").before(grid);

        $("#subraza").on("change", function(){descripcionRaza(this.value, nombreRaza);});

    }

    /* Esta funcion crea la descripcion de las razas que no tienen razas hijas ni razas padres */

    function descripcionRaza(nombreRaza, nombreRazaPadre) {
        
        /* Elimina los otros containers */
        if (!nombreRazaPadre) {
            $("#grid-container-subraza-selector").remove();
        }
        $("#grid-container-raza").remove();

        /* Grid */

        let grid = $("<div id='grid-container-raza'></div>");

        /* Descripción */

        let gridItem = $("<div id='grid-item-1'></div>");
        let tituloSeccion = $("<h3></h3>").text("Descripción");
        gridItem.append(tituloSeccion);
        let descripcion = $("<p></p>").text(razas[nombreRaza]["descripcion"]);
        gridItem.append(descripcion);
        grid.append(gridItem);

        /* Puntos de estadistica */

        gridItem = $("<div id='grid-item-2'></div>");
        tituloSeccion = $("<h3></h3>").text("Puntos de estadística");
        gridItem.append(tituloSeccion);

        if (!nombreRazaPadre){
            descripcion = $("<p></p>").text("+" + razas[nombreRaza]["incremento_estadistica"] + " a la " + razas[nombreRaza]["estadistica_incrementada"] + ".");
        } else {
            descripcion = $("<p></p>").text("+" + razas[nombreRaza]["incremento_estadistica"] + " a la " + razas[nombreRaza]["estadistica_incrementada"] + " y +" + razas[nombreRazaPadre]["incremento_estadistica"] + " a la " + razas[nombreRazaPadre]["estadistica_incrementada"] + ".");
        }

        gridItem.append(descripcion);
        grid.append(gridItem);

        /* Velocidad de movimiento */

        gridItem = $("<div id='grid-item-3'></div>");
        tituloSeccion = $("<h3></h3>").text("Velocidad de movimiento");
        gridItem.append(tituloSeccion);
        descripcion = $("<p></p>").text(razas[nombreRaza]["velocidad"] + " Pies.");
        gridItem.append(descripcion);
        grid.append(gridItem);

        /* Vision */

        gridItem = $("<div id='grid-item-4'></div>");
        tituloSeccion = $("<h3></h3>").text("Visión");
        gridItem.append(tituloSeccion);
        descripcion = $("<p></p>").text(razas[nombreRaza]["vision"]);
        gridItem.append(descripcion);
        grid.append(gridItem);

        /* Habilidades Raciales */

        gridItem = $("<div id='grid-item-5'></div>");
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

        grid.append(gridItem);

        /* Idiomas Raciales */

        gridItem = $("<div id='grid-item-6'></div>");
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
        grid.append(gridItem);

        $("#navegacionRaza").before(grid);
        $("#navegacionRaza").prepend("<button id='siguientePasoRaza'>Siguiente Paso</button>");

        /* Fin del grid */
    };

});