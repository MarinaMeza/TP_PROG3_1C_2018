document.addEventListener("DOMContentLoaded", function(event){
    // let textos = {
    // Ingresos : "",
    // Operaciones : "",
    // Administracion : "",
    // Ventas : "",
    // Demorados : "",
    // Cancelados : "",
    // Ocupación : "",
    // Facturación : "",
    // Comentarios : ""
    // }

    // let btn = document.getElementById("btn");
    // let links = document.querySelectorAll(".menu a");
    // // let menu = document.getElementsByClassName("menu");
    
    // btn.addEventListener('click', function() {
    //     let nav = document.getElementById('nav');
    //     nav.classList.toggle('abierto');
    // })
        $("#btn").click(function() {
            let nav = document.getElementById('nav');
            nav.classList.toggle('abierto');
        });
//#region    
//carga contenido de acuerdo a lo seleccionado en el menu
    // for (let i = 0; i < links.length; i++) {
    //     links[i].addEventListener('click', function(e) {
    //         // alert(i);
    //         e.preventDefault();
    //         let lista = document.querySelector('.lista');
    //         let link = e.target;

    //         let contenido = link.innerText.split(' ');
    //         let indice = contenido[1];

    //         let texto = textos[indice];
            
    //         let ind = (i+1)*2;
            
    //         lista.classList.toggle('desplegado');

    //         // $('.lista').empty();
    //         // $('.lista:nth-child('+ind+')').append(texto);
    //         // links[i].addEventListener('click', function(e){
    //         //     // $('.lista').empty();
    //         //     lista.classList.toggle('desplegado');
    //         // })
    //         p.innerText = texto;
            
            
    //         // boton.classList.toggle('desplegado');
    //         // nav.classList.toggle('abierto');
    //     })
    // }


    // // for (let i = 0; i < links.length; i++) {
    // //     links[i].addEventListener('click', function(e) {
    // //         e.preventDefault();
    // //         let link = e.target;
    // //         let indice = link.innerText;
            
    // //         window.location.assign("http://localhost:8080/TP/index.php/usuarios/horarios");

    // //         // let texto = textos[indice];
    // //         // let p = document.querySelector('p');
    // //         // p.innerText = texto;
    // //         nav.classList.toggle('abierto');		
    // //     })
    // // }



    // function insertar() {
    //     btn.addEventListener('onclick', function(){
    //         alert("hola")
    //     })
    // }

    // let ocu = document.getElementById("ocupacion")
    // alert (ocu);
    // ocu.addEventListener('click', function(e){
    //     e.preventDefault();
    //     alert('hola');
    // })
// $("#ocupacion").click(function(e){
//         e.preventDefault();

//         let contenido = document.querySelector('p').innerHTML;
//         $.ajax({
//             url: "/usuarios/horarios",
//             type: "GET",
//             // dataType: "html or json"
//         }).always(function(data){
//             console.log('hola');
//             console.log(data);
//             data = JSON.parse(data);
//             console.log(data);
//         }).fail(function(data){
//             console.log('error');
//         })
//     })

// })
// $(document).ready(function(){

//#endregion
    $("#ingresos").click(function(){
        nav.classList.toggle('abierto');
        console.log("hola");
        $.ajax(
            {
                url: "http://localhost:8080/TP/index.php/usuarios/ingresos",
                type: "GET",
                dataType: "json"
            })
            .done(function(datos){
                console.log("DONE");
                // console.log(datos);
                // console.log(typeof datos);
                // console.log("DONE");
                // let tabla = "<table class='table'><thead><tr><th scope='col'>id</th><th scope='col'>id</th><th scope='col'>idFechaLogin</th><th scope='col'>nombre</th></tr></thead>";
                let tabla = "<table class='table table-hover'><thead class='thead-light'><th scope='col'>Nombre</th><th scope='col'>Fecha y hora de login</th></thead><tbody>";
                datos.forEach(element => {
                    // console.log(element.fechayhora);//armar tabla
                    // let tabla 
                    // fecha = new Date(0);
                    // fecha.setUTCSeconds(element.fechayhora);
                    // $("#cosas").append(fecha.getDate()+"/"+(fecha.getMonth()+1)+"<br>");
                    // let fechaNueva = formatearFecha(element.fechayhora);
                    // $("#cosas").append(fechaNueva+"<br>");
                    tabla += "<tr><td>"+element.Nombre+"</td><td>"+formatearFecha(element.fechayhora)+"</td></tr>";
                });
                tabla += "</tbody>";
                $("#cosas").append(tabla);
            //cerrar tabla
            //appendear al html
            })
            .fail(function(datos){
            console.log("ERROR");
            // console.log(datos.responseText);
        })
    });

    function formatearFecha(epoch) {
        let fecha = new Date(0);
        fecha.setUTCSeconds(epoch);

        let fechaConFormato = fecha.getDate()+"/"+(fecha.getMonth()+1)+"/"+fecha.getFullYear();
        fechaConFormato += " - "+fecha.getHours()+":"+fecha.getMinutes();
        
        return fechaConFormato;
    }
})

// window.onload = function(){

// }