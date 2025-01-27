document.addEventListener('DOMContentLoaded', function() {
    eventListeners();
    darkMode();
});

function  eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);

    //* Mostrar campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');
    if(navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar');
    }
    //* Otra forma de hacerlo
    //* navegacion.classList.toggle('mostrar'); // Si tiene la clase la quita, si no la tiene la pone
}

function darkMode(){

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    // console.log(prefiereDarkMode.matches);

    prefiereDarkMode.matches ? document.body.classList.add('dark-mode') : document.body.classList.remove('dark-mode');

    // prefiereDarkMode.addEventListener('change', function(){
    //     document.body.classList.toggle('dark-mode', prefiereDarkMode.matches); //* Si tiene la clase la quita, si no la tiene la pone. Con el segundo parámetro se le dice que si prefiereDarkMode.matches es true, le ponga la clase
    // });

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function(){
        document.body.classList.toggle('dark-mode'); //* Si tiene la clase la quita, si no la tiene la pone
    });
}

function mostrarMetodosContacto(e){
    const contactoDiv = document.querySelector('#contacto');
    if(e.target.value === 'telefono'){
        contactoDiv.innerHTML = `
            <label for="telefono">Numero Teléfono:</label>
            <input type="tel" id="telefono" placeholder="Tu Teléfono" name="contacto[telefono]">

            <p>Elija la fecha y la hora para la llamada</p>
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="contacto[fecha]">

            <label for="hora">Hora</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;
    } else {
        contactoDiv.innerHTML = `
            <label for="email">E-mail:</label>
            <input type="email" id="email" placeholder="Tu Correo Electrónico" name="contacto[email]" >
        `;
    }


}



