$(document).ready(function(){

    let random;
    let habilidad;
    let vida=$('#vida').text();
    vida=parseInt(vida);
    let ronda=$('#ronda').text();
    ronda=ronda.substr(10,1);
    ronda=parseInt(ronda);


    

    const eventos=["<h3>Que pasó? Ahora te encuentras en un aula presentado el tercer sprint del proyecto, junto a otros compañeros</h3><h3>Los profesores te miran de forma extraña, esperando que siga una presentación, de lo que parecia una presentación de 10.</h3><br><h2>¿Qué vas ha hacer?</h2>",
    "<h3>Al acabar la anterior interacción te entran ganas de empezar una carrera</h3><h3>Al arrancar a correr te empiezan a seguir unos desconocidos, cuál Forest Gump. (consejo corre corre)</h3><br><h2>¿Qué vas ha hacer?</h2>",
    "<h3>Después de disiparse la niebla, divisas en la lejanía un árbol el cual llama tu atención y te acercas a él.</h3><h3>En árbol te encuentras unos simbolos extraños (UwU,0w0,¬.¬). </h3><br><h2>¿Qué vas ha hacer?</h2>",
    "<h3>Tras seguir un conejo blanco llegas ha una habitación, te recibe un tal Morfeo </h3><h3>Cual yonki te ofrece una pastilla azul y otra roja, porque eres el chosenone.</h3><br><h2>¿Qué vas ha hacer?</h2>"   
]


    $('#fuerza').click(function (e) { 
        
        random=Math.floor(Math.random() * 20) + 1;
        let tiradaFuerza=Math.floor(Math.random() * 20) + 1;
        habilidad= parseInt($('#spanFuerza').text());
        if (habilidad==8 || habilidad==9){
            tiradaFuerza-=1;
        }
        else if (habilidad==12 || habilidad==13){
            tiradaFuerza+=1;
        }
        else if (habilidad==14 || habilidad==15){
            tiradaFuerza+=2;
        }
        
        if(tiradaFuerza>random){
            $('#juego').append('<div class="alert success"> <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> Has ganado el enfrentamiento con una buena paliza</div>');
            
        }
        else{
            $('#juego').append('<div class="alert error"> <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>No has podido golpiar al enemigo</div>');
            vida-=5;
            if (vida<=0){
                $('#vida').text("0/15");
                window.alert("Has perdido tu vida a llegado a 0 :c");
                window.location.href = "dashboard.php";
            }
            else{
            $('#vida').text((vida)+"/15");
            }
            
            
        }
        ronda++;
        if(ronda>5 && vida>0){
            window.alert("Has ganado! Has superado todos los eventos");
            window.location.href = "dashboard.php";
        }
        $('#ronda').text("Encuentro "+ronda+"/5");
        $('#evento *').remove();        
        $('#evento').append(eventos[ronda-2]);

        
    });
    $('#destreza').click(function (e) { 
        random=Math.floor(Math.random() * 20) + 1;
        let tiradaDestreza=Math.floor(Math.random() * 20) + 1;
        habilidad= parseInt($('#spanDestreza').text());
        if (habilidad==8 || habilidad==9){
            tiradaDestreza-=1;
        }
        else if (habilidad==12 || habilidad==13){
            tiradaDestreza+=1;
        }
        else if (habilidad==14 || habilidad==15){
            tiradaDestreza+=2;
        }
        
        if(tiradaDestreza>random){
            $('#juego').append('<div class="alert success"> <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> Has ganado el enfrentamiento con tu destreza</div>');
            
        }
        else{
            $('#juego').append('<div class="alert error"> <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>No has podido dominar la situación</div>');
            vida-=5;
            if (vida<=0){
                $('#vida').text("0/15");
                window.alert("Has perdido tu vida a llegado a 0 :c");
                window.location.href = "dashboard.php";
            }
            else{
            $('#vida').text((vida)+"/15");
            }
        }
        ronda++;
        if(ronda>5 && vida>0){
            window.alert("Has ganado! Has superado todos los eventos");
            window.location.href = "dashboard.php";
        }
        $('#ronda').text("Encuentro "+ronda+"/5");
        $('#evento *').remove();
        
        $('#evento').append(eventos[ronda-2]);
        
    });
    $('#constitucion').click(function (e) { 
        random=Math.floor(Math.random() * 20) + 1;
        let tiradaConstitucion=Math.floor(Math.random() * 20) + 1;
        habilidad= parseInt($('#spanConstitucion').text());
        if (habilidad==8 || habilidad==9){
            tiradaConstitucion-=1;
        }
        else if (habilidad==12 || habilidad==13){
            tiradaConstitucion+=1;
        }
        else if (habilidad==14 || habilidad==15){
            tiradaConstitucion+=2;
        }
        
        if(tiradaConstitucion>random){
            $('#juego').append('<div class="alert success"> <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> Has conseguido matener el ritmo, y lograr lo que querias</div>');
        }
        else{
            $('#juego').append('<div class="alert error"> <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>No mantenido el ritmo, te has cansado</div>');
            vida-=5;
            if (vida<=0){
                $('#vida').text("0/15");
                window.alert("Has perdido tu vida a llegado a 0 :c");
                window.location.href = "dashboard.php";
            }
            else{
            $('#vida').text((vida)+"/15");
            }
            
        }
        ronda++;
        if(ronda>5 && vida>0){
            window.alert("Has ganado! Has superado todos los eventos");
            window.location.href = "dashboard.php";
        }
        $('#ronda').text("Encuentro "+ronda+"/5");
        $('#evento *').remove();        
        $('#evento').append(eventos[ronda-2]);
        
    });
    $('#inteligencia').click(function (e) { 
        random=Math.floor(Math.random() * 20) + 1;
        let tiradaInteligencia=Math.floor(Math.random() * 20) + 1;
        habilidad= parseInt($('#spanInteligencia').text());
        if (habilidad==8 || habilidad==9){
            tiradaInteligencia-=1;
        }
        else if (habilidad==12 || habilidad==13){
            tiradaInteligencia+=1;
        }
        else if (habilidad==14 || habilidad==15){
            tiradaInteligencia+=2;
        }
        
        if(tiradaInteligencia>random){
            $('#juego').append('<div class="alert success"> <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> Lo has conseguido ere relisto</div>');
        }
        else{
            $('#juego').append('<div class="alert error"> <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>No has ganau ere un boludo</div>');
            vida-=5;
            if (vida<=0){
                $('#vida').text("0/15");
                window.alert("Has perdido tu vida a llegado a 0 :c");
                window.location.href = "dashboard.php";
            }
            else{
            $('#vida').text((vida)+"/15");
            }
        }
        ronda++;
        if(ronda>5 && vida>0){
            window.alert("Has ganado! Has superado todos los eventos");
            window.location.href = "dashboard.php";
        }
        $('#ronda').text("Encuentro "+ronda+"/5");
        $('#evento *').remove();
        $('#evento').append(eventos[ronda-2]);
        
    });
    $('#sabiduria').click(function (e) { 
        random=Math.floor(Math.random() * 20) + 1;
        let tiradaSabiduria=Math.floor(Math.random() * 20) + 1;
        habilidad= parseInt($('#spanSabiduria').text());
        if (habilidad==8 || habilidad==9){
            tiradaSabiduria-=1;
        }
        else if (habilidad==12 || habilidad==13){
            tiradaSabiduria+=1;
        }
        else if (habilidad==14 || habilidad==15){
            tiradaSabiduria+=2;
        }
        
        if(tiradaSabiduria>random){
            $('#juego').append('<div class="alert success"> <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> Has logrado lo que querias gracias a tu conicimiento</div>');
        }
        else{
            $('#juego').append('<div class="alert error"> <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>No has ganado el evento :c</div>');
            vida-=5;
            if (vida<=0){
                $('#vida').text("0/15");
                window.alert("Has perdido tu vida a llegado a 0 :c");
                window.location.href = "dashboard.php";
            }
            else{
            $('#vida').text((vida)+"/15");
            }
        }
        ronda++;
        if(ronda>5 && vida>0){
            window.alert("Has ganado! Has superado todos los eventos");
            window.location.href = "dashboard.php";
        }
        $('#ronda').text("Encuentro "+ronda+"/5");
        $('#evento *').remove();
        $('#evento').append(eventos[ronda-2]);
        
    });
    $('#carisma').click(function (e) { 
        random=Math.floor(Math.random() * 20) + 1;
        let tiradaCarisma=Math.floor(Math.random() * 20) + 1;
        habilidad= parseInt($('#spanCarisma').text());
        if (habilidad==8 || habilidad==9){
            tiradaCarisma-=1;
        }
        else if (habilidad==12 || habilidad==13){
            tiradaCarisma+=1;
        }
        else if (habilidad==14 || habilidad==15){
            tiradaCarisma+=2;
        }
        
        if(tiradaCarisma>random){
            $('#juego').append('<div class="alert success"> <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> Has convencido  al/los rival/es </div>');
        }
        else{
            $('#juego').append('<div class="alert error"> <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>No has podido convencer  al/los rival/es</div>');
            vida-=5;
            if (vida<=0){
                $('#vida').text("0/15");
                window.alert("Has perdido tu vida a llegado a 0 :c");
                window.location.href = "dashboard.php";
            }
            else{
            $('#vida').text((vida)+"/15");
            }
        }
        ronda++;
        if(ronda>5 && vida>0){
            window.alert("Has ganado! Has superado todos los eventos");
            window.location.href = "dashboard.php";
        }
        $('#ronda').text("Encuentro "+ronda+"/5");
        $('#evento *').remove();  
        $('#evento').append(eventos[ronda-2]);
        
    });

})