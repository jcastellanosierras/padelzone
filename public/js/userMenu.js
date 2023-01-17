// Obtenemos el desplegable si existe
const desplegable = document.getElementById('user-desplegable');

// Si existe realiza su función, que es desplegar el menú
if (desplegable != null) {
  // Obtiene el menú
  const menu = document.getElementById('user-menu');
  let display = 0; // 0 => none 1 => block

  // Escuchamos el evento click del desplegable
  desplegable.addEventListener('click', (e) => {
  
    // Muestra el menú o lo oculta en función del estado actual
    if (display == 0) {
      menu.style.display = 'block';
      display = 1;
    } else {
      menu.style.display = 'none';
      display = 0;
    }
  
    // Evita la propagación del evento para que no se envíe a otros elementos que también
    // se encuentran escuchando este mismo evento
    e.stopImmediatePropagation();
  
    document.addEventListener('click', (e) => {
  
      // Array de la ruta del elemto clicado
      const path = e.composedPath();
  
      // Si el menú no se encuentra en esta ruta, se ha clicado fuera
      // Luego el menú se oculta
      if (!path.includes(menu)) {
        menu.style.display = 'none';
        display = 0;
      }
  
      e.stopImmediatePropagation();
    });
  });
}
