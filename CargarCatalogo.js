const imagenes = [
  {
    src: 'img/Producto_AHiT.png',
    alt: 'A Hat in Time es un plataformas en 3D homenaje a los viejos clásicos. Su protagonista es una niña con sombrero, acompañala a explorar mundos inmensos y recoge fragmentos de tiempo para avanzar en la aventura.',
    nombre: 'A Hat in Time',
    precio: 5200
  },
  {
    src: 'img/Producto_Celeste.png',
    alt: 'Ayuda a Madeline a superar sus demonios internos en su travesía a la cima de la Montaña Celeste, en este intenso juego de plataformas diseñado a mano por los creadores del clásico TowerFall.',
    nombre: 'Celeste',
    precio: 2600
  },
  {
    src: 'img/Producto_HollowKnight.png',
    alt: '¡Desciende al mundo de Hollow Knight! La galardonada aventura de acción de insectos y héroes. Explora cavernas serpenteantes, antiguas ciudades y páramos mortales. Lucha contra criaturas mancilladas y haz nuevas amistades con extraños insectos. Descubre una antigua historia y resuelve los misterios de este reino.',
    nombre: 'Hollow Knight',
    precio: 5600
  },
  {
    src: 'img/Producto_KH_All_in_One.png',
    alt: 'El Paquete KINGDOM HEARTS todo en uno incluye: KINGDOM HEARTS HD 1.5 + 2.5 ReMIX, KINGDOM HEARTS HD 2.8 Final Chapter Prologue, KINGDOM HEARTS III',
    nombre: 'Kingdom Hearts All in One',
    precio: 60000
  },
];

function renderizarGaleria(imagenes) {
  var html = "<div>";
  
  imagenes.forEach(function(imagen){
    html += `
    <tr class="espacio"></tr>
    <tr class="galeria-item" width="50%" bgcolor=#F7F7FE>
      <td><img class=imgProducto src="${imagen.src}" alt="${imagen.alt}" /></td>
      <td class=nombreProducto>${imagen.nombre}</td>
      <td>
        <button class=botonProducto name="Comprar">₡${imagen.precio}</button>
      </td>
      <td width="20px"></td>
    </tr>
    <tr class="espacio"></tr>
  `;
  });
  console.log("HOLAAAAAAAAA"+html);
  $('#galeria').html(html);
}

$(function() {
  renderizarGaleria(imagenes);
});
