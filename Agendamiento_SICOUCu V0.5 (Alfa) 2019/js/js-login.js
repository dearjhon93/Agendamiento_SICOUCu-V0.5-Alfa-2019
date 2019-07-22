	
	// Institucion: Universidad de Cuenca
    // Facultad: Ingenieria
    // Carrera: Sistemas
    // Docente: Dr. Morocho Zurita Carlos Villie
    // Autores: Flores Jhon, Romero Vannesa
    // Modulo: Base de Datps II - (SISTEMAS MALLA 2013)
    // Sistema: SICOUCu V0.5 (Alfa) 2019 - Agendamiento de Citas

    //     Este módulo fue desarrollado como parte de la 
	//     materia Base de Datos II, periodo mar-jul 2019
	
console.clear();

const loginBtn = document.getElementById('login');
const signupBtn = document.getElementById('signup');

loginBtn.addEventListener('click', (e) => {
	let parent = e.target.parentNode.parentNode;
	Array.from(e.target.parentNode.parentNode.classList).find((element) => {
		if(element !== "slide-up") {
			parent.classList.add('slide-up')
		}else{
			signupBtn.parentNode.classList.add('slide-up')
			parent.classList.remove('slide-up')
		}
	});
});

signupBtn.addEventListener('click', (e) => {
	let parent = e.target.parentNode;
	Array.from(e.target.parentNode.classList).find((element) => {
		if(element !== "slide-up") {
			parent.classList.add('slide-up')
		}else{
			loginBtn.parentNode.parentNode.classList.add('slide-up')
			parent.classList.remove('slide-up')
		}
	});
});