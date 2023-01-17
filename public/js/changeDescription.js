// Obtenemos los títulos
const h2Description = document.getElementById("h2-description");
const h2Details = document.getElementById("h2-details");

// Obtenemos la descripción y los detalles
const description = document.getElementById("description");
const details = document.getElementById("details");

// Guardamos las clases en constantes
const classToAssign = "underline-h2-descriptions";
const hide = "hide";

// Si se pulsa y no contiene la clase indicada se le pone y se la quita a h2Details
// Si la tiene no se hace nada porque ya está subrayado
h2Description.addEventListener("click", () => {
  if (!h2Description.classList.contains(classToAssign)) {
    h2Description.classList.add(classToAssign);
    h2Details.classList.remove(classToAssign);

    description.classList.remove(hide);
    details.classList.add(hide);
  }
});

// Igual que el anterior
h2Details.addEventListener("click", () => {
  if (!h2Details.classList.contains(classToAssign)) {
    h2Details.classList.add(classToAssign);
    h2Description.classList.remove(classToAssign);

    details.classList.remove(hide);
    description.classList.add(hide);
  }
});