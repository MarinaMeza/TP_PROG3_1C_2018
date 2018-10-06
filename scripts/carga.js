let form = document.createElement('form');
let seccion = document.querySelector('.seccion');
let boton = document.createElement('button');
let body = document.querySelector('body');
boton.innerText = 'Log in'; 	
boton.classList.add("login");
//no usar form
body.appendChild(boton);
//on load
window.addEventListener('load', function(e){
	seccion.appendChild(form);
	boton.addEventListener('click', function(e){
		e.preventDefault();
		let xhr = new XMLHttpRequest();
		xhr.open('GET', 'usuarios.js');
		xhr.addEventListener('load', function(){
		if (xhr.status == 200) {
			let usuario = (JSON.parse(xhr.responseText));
			boton.remove();
			//al presionar login agrega el form y borra el boton login
			form.innerHTML='<label for="email" >E-Mail</label><input type="email" id="email"><label for="clave" >Contraseña</label><input type="password" id="clave"><button>Enviar</button><p id="respuesta"></p>';
			validarOnBlur();
			//esto aca iria bien
			form.addEventListener('submit',function(e){
				console.dir(usuario);
				e.preventDefault();
				validar(usuario);
			})
		} else {
			alert('chau');
		}
	})

		xhr.send();	
	})
});

// let login = document.querySelector('.seccion');
// //console.dir(seccion);
// //al presionar login agregar el form y borra el boton login
// login.addEventListener('submit', function(e){
// 	e.preventDefault();
// 	let xhr = new XMLHttpRequest();
// 	xhr.open('GET', '');
// 		xhr.addEventListener('load', function(){
// 		if (xhr.status == 200) {
// 			//seccion.remove('innerText');
// 			seccion.appendChild('<form action="GET"><label for="" >E-Mail</label><input type="email" id="email"><label for="" >Contraseña</label><input type="password" id="clave"><button>Enviar</button><p id="respuesta"></p></form>');
			
// 		} else {
// 			alert('chau');
// 		}
// 	})
// 	xhr.send();
// })

function validarOnBlur(){
	let emailCaja = document.querySelector('#email');
	//valida on blur el mail
	emailCaja.addEventListener('blur', function(e){
		e.preventDefault();
		let emailInput = document.querySelector('#email').value;
		let xhr = new XMLHttpRequest();
		xhr.open('GET', 'usuarios.js');
		xhr.addEventListener('load', function(){
			if (xhr.status == 200) {
				let usuario = (JSON.parse(xhr.responseText));
				//console.log('json '+(xhr.responseText));
				validarUsuario(usuario,emailInput);
			}
		})

		xhr.send();
	})
}

//al enviar el mail y clave

// form.addEventListener('submit', function(e){
// 	e.preventDefault();
// 	let xhr = new XMLHttpRequest();
// 	xhr.open('GET', 'usuarios.js');
// 	xhr.addEventListener('load', function(){
// 		if (xhr.status == 200) {
// 			let usuario = (JSON.parse(xhr.responseText));
// 			//console.log('submit');
// 			validar(usuario);
// 		}
// 	})

// 	xhr.send();
// })

function validarUsuario(usuario,email) {
	//console.log(usuario[0].clave);
	//let email = emailInput;
	//let clave = document.querySelector('#clave').value;
	let respuesta = document.querySelector('#respuesta');
	let fondoMail = document.querySelector('#email');
	//console.log(respuesta);
	
	for (let i = 0; i < usuario.length; i++) {
		if (usuario[i].email == email) {
			respuesta.innerText = 'VAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';
			fondoMail.classList.remove('error');
			fondoMail.classList.add('correcto');
			break;
		} else {
			respuesta.innerText = 'Error. Mal el mail';
			fondoMail.classList.add('error');
			break;
		}
	} 
}

function validar(usuario) {
	//console.log(usuario[0].clave);
	let email = document.querySelector('#email').value;
	let clave = document.querySelector('#clave').value;
	//let respuesta = document.querySelector('#respuesta');
	//console.log(respuesta);
	
	for (let i = 0; i < usuario.length; i++) {
		if (usuario[i].clave == clave && usuario[i].email == email) {
			respuesta.innerText = 'Bienvenido';
			cargarProd();
		}else{
			respuesta.innerText = 'Error, usuario incorrecto';
		}
	} 
}
/*on blur para validar datos*/

function cargarProd() {
	let productos = [];
	//let form = document.querySelector('form');
	var xhr = new XMLHttpRequest();
	xhr.open('GET','prod.js');
	xhr.addEventListener('load', function(){
		if (xhr.status == 200) {
			//console.log(JSON.parse(xhr.responseText));
			productos = JSON.parse(xhr.responseText);
			//console.dir(productos);
			let largo = productos.length;
			//console.dir('largo '+largo);
			let seccion = document.querySelector('.seccion');
			let t = '<div>';
			let tt = '</div>';
			form.remove();
			for (let i = 0; i < productos.length; i++) {
				seccion.innerHTML += '<div><img src="img/' + (i+1) + '.jpg" alt=""><p for="">Nombre: ' + productos[i].nombre + '<br>Precio: $' + productos[i].precio + '<br>Color: ' + productos[i].color + '</p></div>';
			}
		} 

	})
	xhr.send();
}