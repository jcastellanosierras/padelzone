// Obtiene la imagen principal y todas las imágenes de la galería
const mainImg = document.getElementById("main-product-img");
const imgGallery = document.getElementById("img-gallery");
const imgs = imgGallery.getElementsByTagName("img");

// Le añade el evento click a todas las imágenes de la galería
for (let i = 0; i < imgs.length; i++) {
  imgs[i].addEventListener("click", () => {
    // Comprobamos si los atributos son los mismos
    if (mainImg.getAttribute('src') == imgs[i].getAttribute('src')) {
      return;
    }

    // Se le baja la opacidad para hacer un efecto de transición
    mainImg.style.opacity = 0;

    // Cambiamos los atributos de la imagen principal
    mainImg.setAttribute("src", imgs[i].getAttribute("src"));
    mainImg.setAttribute("alt", imgs[i].getAttribute("alt"));

    // Crea un invertalo para ir subiendo la opacidad para crear el efecto
    // de transición
    let j = 1;
    let interval = setInterval(() => {
      mainImg.style.opacity = j * 0.1;

      if (j == 10) {
        clearInterval(interval);
        console.log("clearInterval");
      }

      j++;
    }, 30);
  });
}

  