-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-01-2023 a las 23:40:03
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `padelzone`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `id_categoria` int(2) NOT NULL,
  `categoria` varchar(16) NOT NULL,
  `id_subcategoria` int(2) NOT NULL,
  `subcategoria` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `id_categoria`, `categoria`, `id_subcategoria`, `subcategoria`) VALUES
(1, 1, 'Palas', 1, 'Diamante'),
(2, 1, 'Palas', 2, 'Redondo'),
(3, 1, 'Palas', 3, 'Lágrima'),
(4, 2, 'Paleteros', 1, 'Paleteros'),
(5, 2, 'Paleteros', 2, 'Mochilas'),
(6, 3, 'Zapatillas', 1, 'Hombre'),
(7, 3, 'Zapatillas', 2, 'Mujer'),
(8, 4, 'Ropa', 1, 'Hombre'),
(9, 4, 'Ropa', 2, 'Mujer'),
(10, 5, 'Accesorios', 1, 'Bolas'),
(11, 5, 'Accesorios', 2, 'Grips'),
(12, 5, 'Accesorios', 3, 'Protectores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(256) NOT NULL,
  `precio` varchar(6) NOT NULL,
  `cantidad` int(2) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `codigo_postal` varchar(5) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `cartID` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `id_usuario`, `id_producto`, `nombre_producto`, `precio`, `cantidad`, `direccion`, `codigo_postal`, `ciudad`, `telefono`, `cartID`) VALUES
(5, 14, 2, 'Bullpadel Hack 03 2022', '324,95', 1, 'Calle Garzón, 6', '29200', 'Antequera', '691557914', 'cc79a0c0bd753e5629ac91a682ff77b1'),
(7, 14, 2, 'Bullpadel Hack 03 2022', '324,95', 5, 'Calle Garzón, 6', '29200', 'Antequera', '691557914', '204f250c62ec66b7d3597d95ee4f84a5'),
(8, 14, 1, 'Nox At10 Genius 18K Agustin Tapia 2022', '199,99', 2, 'Calle Garzón, 6', '29200', 'Antequera', '691557914', 'd7ed69f9945f1552bd2f46a5c2fc9873'),
(9, 14, 1, 'Nox At10 Genius 18K Agustin Tapia 2022', '199,99', 1, 'Calle Garzón, 6', '29200', 'Antequera', '691557914', 'ab7d08adf2afae7920efe3d93c54816f'),
(10, 14, 2, 'Bullpadel Hack 03 2022', '324,95', 1, 'Calle Garzón, 6', '29200', 'Antequera', '691557914', '4b2ddf41a25da796ba74dc8ff27cb16f'),
(11, 14, 1, 'Nox At10 Genius 18K Agustin Tapia 2022', '199,99', 3, 'Calle Garzón, 6', '29200', 'Antequera', '691557914', '2e79872b4a1872bd0f1cecea4c8c0374');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_nombre` varchar(256) NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `imagen1` varchar(256) NOT NULL,
  `imagen2` varchar(256) NOT NULL,
  `imagen3` varchar(256) NOT NULL,
  `imagen4` varchar(256) NOT NULL,
  `precio` varchar(6) NOT NULL,
  `descripcion` text NOT NULL,
  `forma` varchar(32) NOT NULL,
  `nucleo` varchar(32) NOT NULL,
  `tubular` varchar(32) NOT NULL,
  `cara` varchar(32) NOT NULL,
  `tipo` varchar(32) NOT NULL,
  `genero` varchar(6) NOT NULL,
  `oferta` tinyint(1) NOT NULL,
  `novedad` tinyint(1) NOT NULL,
  `recomendado` tinyint(1) NOT NULL,
  `categoria` int(2) NOT NULL,
  `subcategoria` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_nombre`, `nombre`, `imagen1`, `imagen2`, `imagen3`, `imagen4`, `precio`, `descripcion`, `forma`, `nucleo`, `tubular`, `cara`, `tipo`, `genero`, `oferta`, `novedad`, `recomendado`, `categoria`, `subcategoria`) VALUES
(1, 'nox-at10-genius-18k-agustin-tapia-2022', 'Nox At10 Genius 18K Agustin Tapia 2022', 'nox-at10-genius-18k-agustin-tapia-2022-1.png', 'nox-at10-genius-18k-agustin-tapia-2022-2.png', 'nox-at10-genius-18k-agustin-tapia-2022-3.png', 'nox-at10-genius-18k-agustin-tapia-2022-4.png', '199,99', '<h3>Presentación de la pala</h3>\r\n<p>\r\nTe presentamos la pala Nox AT10 Genius 18K 2022 de Agustín Tapia. Después del éxito cosechado con la anterior Genius Arena la firma y el jugador se han puesto manos a la obra para diseñar su nueva pala para la temporada 2022. Esta pala AT10 Luxury Genius 18K se ha desarrollado bajo las peticiones del jugador.\r\n</p>\r\n<br>\r\n<p>\r\nLa nueva AT10 Genius 18K de 2022 presenta el mismo molde que su antecesora, por lo que nos encontramos frente a una pala de pádel con forma de gota, goma HR3 de alta densidad en el núcleo de la pala y Carbono 18K en las caras para añadir un plus de dureza en el tacto de la pala.</p>\r\n<h3>Tipo de jugador</h3>\r\n<p>\r\nEs una pala ideal para los jugadores de nivel intermedio hasta profesional. Su amplio punto dulce, balance medio y su control la convierten en una excelente opción para los jugadores que buscan precisión pero también potencia gracias a sus caras diseñadas con Carbono 18K.\r\n</p>\r\n<br>\r\n<p>\r\nComo su antecesora nos facilitará las transiciones del juego y su excelente manejo y buena salida de bola nos permitirá jugar cómodos desde el fondo de la pista. También nos hará jugar más tranquilos cerca de la red, puesto que su manejabilidad nos ayudará a realizar con cierta facilidad voleas, bandejas y remates.\r\n</p>\r\n<h3>Características y tecnologías</h3>\r\n<p>\r\nLas principales tecnologías que encontramos en la nueva pala AT10 Genius 18K de Agustín Tapia son el Carbono 18K empleado en sus caras que le brinda más rigidez y resistencia sin influir en el peso, el sistema de absorción de las vibraciones, llamado AVS System, y el novedoso sistema SmartStrap para personalizar la pala y mejorar la higiene y seguridad facilitano el cambio del cordón.\r\n</p>\r\n<br>\r\n<p>\r\nAlgunas de las tecnologías con las que ya contaba este modelo son el Carbon Frame, el Dynamic Composit Structure, la goma HR3 con efecto memoria y las superficie rugosa en sus caras.\r\n</p>', 'Lágrima', 'Hr3 Core', 'Fibra de carbono', 'Carbono 18k', '', '', 1, 1, 1, 1, 3),
(2, 'bullpadel-hack-03-2022', 'Bullpadel Hack 03 2022', 'bullpadel-hack-03-2022-1.png', 'bullpadel-hack-03-2022-2.png', 'bullpadel-hack-03-2022-3.png', 'bullpadel-hack-03-2022-4.png', '324,95', '<h3>Presentación de la pala</h3>\r\n<p>Ya disponible la pala Bullpadel Hack 03 2022 en tu tienda Padel Nuestro. La pala de Paquito Navarro es una de las mejores palas del momento. Desde su lanzamiento cada año se ha convertido en una de las palas súper ventas de la firma de pádel española. Este año con toda seguridad se convertirá en una de las mejores palas de la temporada y, por supuesto, de la colección Bullpadel 2022.\r\n</p>\r\n<br>\r\n<p>\r\nLa Bullpadel Hack 03 2022 de Paquito Navarro pertenece a la gama Pro de Bullpadel, su forma diamante, balance alto y punto dulce, proporcionado para su formato, la convierte en una pala polivalente. Es una de las palas con mayor potencia del catálogo Bullpadel 2022 y está fabricada con tecnologías de última generación y los materiales más innovadores, como es el caso del nuevo Tricarbon.\r\n</p>\r\n<h3>Tipo de jugador</h3>\r\n<p>\r\nLa pala Bullpadel Hack 2022 está pensada para ofrecer la máxima potencia a los jugadores de nivel avanzado / profesional y carácter ofensivo o defensivo, que suelen subir a la zona de ataque para terminar el punto. Una pala polivalente y completa con la que todo jugador se puede adaptar en las diferentes partes de la cancha y sacar un buen rendimiento a su juego.\r\n</p>\r\n<br>\r\n<p>\r\nPara jugar desde el fondo de la pista es una pala que gracias a su punto dulce nos facilita salir jugando. Sin embargo, su tacto de dureza media-alta requiere una buena técnica, precisión y acompañar la bola al inicio del golpeo, porque al tener ese nivel de dureza la salida de bola disminuye. \r\n</p>\r\n<br>\r\n<p>\r\nEn la red es una de las palas que más opciones puede ofrecer al padelero. El control que ofrece la pala Hack 03 permite controlar al rival y buscar sus zonas más débiles con golpes escorados para luego subir a la red y rematar eligiendo la mejor opción. Cerca de la red es la zona perfecta para desarrollar todo su potencial, una pala pensada para sacar la máxima potencia en ataque, que nos permite, gracias a su buen manejo, colocar las bolas lejos del rival, rematar voleas y bloquear sin exigir demasiada concentración al jugador gracias a su dureza media - alta que hace que las bolas escapen más lento. \r\n</p>\r\n<br>\r\n<p>\r\nSi eres de los que les gusta rematar cada punto estás de enhorabuena, porque la pala Hack 03 responde a la perfección. Su balance alto y formato diamante te aportará la energía necesaria para conseguir una potencia espectacular.\r\n</p>\r\n<h3>Características y tecnologías Bullpadel Hack 03 2022</h3>\r\n<p>\r\nLa Bullpadel Hack 2022 es una pala con forma diamante y balance alto. Este modelo tiene un peso de 365-375 g. Como novedad principal destacamos el sistema Air React Channel y el nuevo núcleo TriCarbon, aunque presenta multitud de tecnologías.\r\n</p>\r\n<br>\r\n<p>\r\nEn el marco aparece la tecnología Air React Channel para construir un marco más aerodinámico que aporte mayor rigidez, firmeza y ligereza. Para obtener un marco más rígido que ofrezca los mejores resultados entre potencia y control aparece el Carbon Tube, un marco de 100% carbono. El marco es Metalshield, que se adecua perfectamente al sistema CustomWeight. La exitosa tecnología de placas que permite cambiar el peso de la pala para conseguir un balance más bajo o alto.\r\n</p>\r\n<br>\r\n<p>\r\nLa novedad en cuanto a materiales está en su núcleo combinado Tricarbon, una nueva fibra de carbono que mediante cintas de carbono de menor peso se entrelazan en tres direcciones para proporcionar más energía en el golpeo y retorno. El núcleo interno está compuesto con la goma MutliEVA, que tan buenos resultados está dando a la marca Bullpadel. \r\n</p>\r\n<br>\r\n<p>\r\nOtras tecnologías a subrayar en este modelo son la tecnología Vibradrive, el corazón Hack y canales Nerve en los laterales. Y, por supuesto, el innovador sistema Adapta que solo podrás encontrar en las palas Hack de la gama Pro de Bullpadel. La tecnología Adaptia ha sido desarrollada por la marca mediante la unión del carbono inteligente Tricarbon y la goma MultiEVA. El objetivo de este nuevo sistema es conseguir la respuesta perfecta, a menor aceleración más salida y comodidad, mientras que a mayor aceleración la pala consigue más reacción y control.\r\n</p>', 'Diamante', 'Goma Eva', 'Carbono', 'Carbono', '', '', 1, 1, 1, 1, 1),
(3, 'pala-de-padel-adidas-adipower-light-32-2023', 'Pala de Padel Adidas Adipower Light 3.2 2023', 'pala-de-padel-adidas-adipower-light-32-2023-1.jpg', 'pala-de-padel-adidas-adipower-light-32-2023-2.jpg', 'pala-de-padel-adidas-adipower-light-32-2023-3.jpg', 'pala-de-padel-adidas-adipower-light-32-2023-4.jpg', '296,95', '<h3>GANA TODOS TUS PARTIDOS CON LA NUEVA ADIPOWER LIGHT 3.2</h3><p>Una pala hecha para ganar, así es la<strong>&nbsp;Adipower Light 3.2 de Adidas</strong>. Con esta pala podrás conseguir un rendimiento increíble gracias a su&nbsp;<strong>superficie de fibra de carbono de 24K</strong>, que dota a la pala de firmeza y rigidez, mayor resistencia a los golpes y, por tanto, de una mayor durabilidad y vida útil. Es una pala sólida que ayudará a la agresividad en cada golpe.&nbsp;</p><h3>FÁCIL MANEJO Y RIGIDEZ ESTRUCTURAL</h3><p>La&nbsp;<strong>Adipower Light 3.2&nbsp;</strong>se trata de una pala en&nbsp;<strong>formato redondo con un balance bajo</strong>, propio de las raquetas con esta forma. Este diseño de pala se orienta al&nbsp;<strong>juego de fondo</strong>&nbsp;y ofrece mayor facilidad a la hora de manejarla.</p><p>Como es propio de la&nbsp;<strong>línea Adipower</strong>, esta pala también incluye las tecnologías<strong>&nbsp;Dual eXoskeleton&nbsp;</strong>y&nbsp;<strong>la Power Embossed Ridge</strong>, que dotan a la pala de rigidez en la estructura en la parte central de la cabeza. Esa rigidez estructural se aprovechará, sobre todo, en los remates u otros golpes de alta intensidad.&nbsp;</p><h3>Tecnología de efecto para un juego dinámico</h3><p>Además, cuenta con las<strong>&nbsp;tecnologías de efecto&nbsp;<em>Spin Blade</em>&nbsp;y&nbsp;<em>Smart Holes Curve</em></strong>, que permiten el acceso a un gran abanico de efectos en todos tus golpes. La&nbsp;<strong>pala Adipower Light 3.2</strong>, como su antecesora de la colección 2022, también es un modelo que pesa poco,&nbsp;<strong>345-360 gramos</strong>, pero que combina máxima potencia y manejabilidad en la misma medida. También hay que resaltar su núcleo de&nbsp;<strong>goma EVA<em>&nbsp;Soft Energy</em></strong>, que ofrece una gran salida de bola.</p><p>En cuanto a su diseño, destacan los detalles en color sobre un fondo negro, que dota a la pala de una&nbsp;<strong>elegancia y distinción&nbsp;</strong>sin igual, que embellecerá cada golpe que des.</p><p>No dejes escapar esta magnífica&nbsp;<strong>pala de altas prestaciones</strong>, con ella serás un oponente digno para tus rivales.</p><p></p>', 'Redonda', 'Eva Soft Energy', ' Carbono', ' Carbono Aluminizado 24k', '', '', 0, 1, 1, 1, 2),
(4, 'zapatillas-nox-ml10-hexa-navylima-neon', 'Zapatillas Nox Ml10 Hexa Navy/Lima Neon', 'zapatillas-nox-ml10-hexa-navylima-neon-1.jpg', 'zapatillas-nox-ml10-hexa-navylima-neon-2.jpg', 'zapatillas-nox-ml10-hexa-navylima-neon-3.jpg', 'zapatillas-nox-ml10-hexa-navylima-neon-4.jpg', '99,95', '<ul><li>Las&nbsp;Nox ML10 Hexa Navy Lima Neon tienen suela de espiga con pequeños tacos para un agarre perfecto.</li><li>Soporte en los laterales que aumentan el apoyo del pie para reducir el riesgo de torcerte el pie.</li><li>certificadas por el Centro Tecnológico del Calzado INESCOP.</li><li>Nuevos compuestos y materiales que ayudan a reducir la abrasión por el uso intensivo</li><li>Gran amortiguación gracias a la media suela de Goma Eva.</li><li>Pisada natural gracias a la construcción con malla técnica.</li><li>Plantilla anti bacterias que proporciona una gran comodidad.</li><li>Uno de los nuevos calzados para pádel Nox 2022.</li></ul>', '', '', '', '', '', 'hombre', 0, 1, 0, 3, 1),
(5, 'bullpadel-beker-22v-fucsia-mujer', 'Babolat Sensa Black Mujer', 'bullpadel-beker-22v-fucsia-mujer-1.jpg', 'bullpadel-beker-22v-fucsia-mujer-2.jpg', 'bullpadel-beker-22v-fucsia-mujer-3.jpg', 'bullpadel-beker-22v-fucsia-mujer-4.jpg', '42,95', '<p><strong><span>BULLPADEL BEKER 22V FUCSIA MUJER, ESTABILIDAD Y CONTROL EN EL JUEGO</span></strong></p><p>Consigue ya las nuevas&nbsp;<strong>zapatillas Bullpadel Beker 22V</strong>&nbsp;en color fucsia para mujer, un calzado de la nueva colección Bullpadel que destaca por su diseño y&nbsp;<strong>alto rendimiento a la hora del juego.</strong></p><p>Construidos con materiales y tecnologías únicas de bullpadel, son unas z<strong>apatillas que se adaptan a las superficies de tierra batida.</strong></p><h3><span>Tipo de jugador</span></h3><p>Las zapatillas perfectas para las<strong>&nbsp;jugadoras de nivel medio</strong>&nbsp;que buscan mejorar su nivel en el juego. La suela de espiga ofrece tracción y gran agarre en las superficies de tierra batida.</p><h3><span>Características y tecnologías</span></h3><p>El corte superior hecho de mesh con<strong>&nbsp;tecnología THERMO FIT</strong>&nbsp;sin costuras aporta mayor transpirabilidad y mayor ligereza. Los refuerzos de goma en la puntera y el parte interior protege de posibles roces y rozaduras.</p><p>La<strong>&nbsp;mediasuela con plantilla EVA favorece el confort y la amortiguación</strong>. La&nbsp;<strong>suela hecha de caucho</strong>&nbsp;con un diseño de espiga proporciona gran agarre y flexión.</p><h3><span>Diseño y colores</span></h3><p>El diseño de estas zapatillas destaca por su vubrante color fiusha con los detalles bullpadel en color blanco.</p>', '', '', '', '', '', 'mujer', 1, 0, 1, 3, 2),
(6, 'mochila-nox-at10-team-negro-rojo', 'Mochila Nox AT10 Team Negro Rojo', 'mochila-nox-at10-team-negro-rojo-1.jpg', 'mochila-nox-at10-team-negro-rojo-2.jpg', 'mochila-nox-at10-team-negro-rojo-3.jpg', 'mochila-nox-at10-team-negro-rojo-4.jpg', '49,50', '<div>Presentamos la nueva mochila de padel AT10 Team Series disenada especificamente para Agustin Tapia.<br><br>Cuenta con los mejores materiales y textiles tecnicos que permiten distribuir el peso de forma optima logrando aumentar la resistencia y reducir la sensacion de carga.<br><br>Caracteristicas:<br><br>Compartimento para palas u ordenador. Cuanta con revestimiento acolchado para maxima proteccion.<br>Compartimento principal para palas o equipacion. El mas espacioso. <br>Bolsillo frontal organizadores para llaves, cartera, tarjeta del club<br>Bolsillos laterales para accesorios.<br>Compartimento independiente para zapatillas con sistema de aeracion.<br>Correas y dorso acolchado para mayor comfort.<br>Textiles ergonomicos para optimizar el agarre y la circulacion del aire.<br>Alojamiento para gafas ubicado en tirante izquierdo. <br>Medidas: 480 x 330 x 200 mm<br><br>Capacidad: 23 litros</div>', '', '', '', '', 'mochila', '', 1, 1, 0, 2, 2),
(7, 'paletero-nox-at10-xxl-negro-rojo', 'Paletero Nox AT10 XXL Negro Rojo', 'paletero-nox-at10-xxl-negro-rojo-1.jpg', 'paletero-nox-at10-xxl-negro-rojo-2.jpg', 'paletero-nox-at10-xxl-negro-rojo-3.jpg', 'paletero-nox-at10-xxl-negro-rojo-4.jpg', '59,50', '<h3>Paletero Nox AT10 XXL Negro Rojo</h3>', '', '', '', '', 'paletero', '', 0, 0, 1, 2, 1),
(8, 'camiseta-bullpadel-linde-blanco', 'Caiseta Bullpadel Linde Blanco', 'camiseta-bullpadel-linde-blanco-1.jpg', 'camiseta-bullpadel-linde-blanco-2.jpg', 'camiseta-bullpadel-linde-blanco-3.jpg', 'camiseta-bullpadel-linde-blanco-4.jpg', '38,56', '<p>Camiseta de nuestra nueva línea Timeless. El tejido, ligero de Ottoman, presenta con gran cantidad de detalles de la firma Timeless, que proporcionan elegancia y destacan en la pista de juego.</p>\r\n\r\n<p>El diseño, que aúna la atemporalidad y la calidad, incorpora diversos cortes, algunos a contraste, asimetría en las sisas con espalda ranglan, cuello de rib con detalle bicolor y bajos con abertura para mayor amplitud de movimiento.</p>\r\n\r\n<p>Además, gracias a la tecnología de micro-filamentos Quickerdry, ayuda a reducir la humedad y facilita la transpiración.</p>', '', '', '', '', '', 'hombre', 1, 0, 1, 4, 1),
(9, 'short-bullpadel-listo-negro', 'Short Bullpadel Liso Negro', 'short-bullpadel-listo-negro-1.jpg', 'short-bullpadel-listo-negro-2.jpg', 'short-bullpadel-listo-negro-3.jpg', 'short-bullpadel-listo-negro-4.jpg', '45,49', '<p>El tejido, de Ribstop bielástico, presenta gran cantidad de detalles de la firma Timeless, que proporcionan elegancia y destacan en la pista de juego.</p>\r\n\r\n<p>El diseño, que aúna la atemporalidad y la calidad, incorpora braguero interior, cinturilla sobresaliente personalizada con cordón ajustable y bolsillos laterales.</p>\r\n\r\n<p>Se trata de una prenda ligera y cómoda, confeccionada en tejido bielástico con la tecnología Binamic, proporcionando una gran libertad de movimiento en dos direcciones, y la tecnología Quickerdry para reducir la humedad y ayudar a la transpiración.</p>', '', '', '', '', '', 'hombre', 0, 0, 1, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `apellidos` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(64) NOT NULL,
  `sexo` varchar(6) NOT NULL,
  `nacimiento` date NOT NULL,
  `ofertas` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `sexo`, `nacimiento`, `ofertas`) VALUES
(6, 'adsf', 'asdf', 'jsoerj@padelzone.es', '91c9c3ff310a53f8d179461d9af55371c78b67c38ab030bf9c026693ca495399', 'hombre', '2022-12-23', 0),
(7, 'asdf', 'adsf', 'asdf@asdf.es', '91c9c3ff310a53f8d179461d9af55371c78b67c38ab030bf9c026693ca495399', 'hombre', '2022-12-29', 0),
(8, 'ASDF', 'asdf', 'afafasdf@uma.es', 'f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b', 'hombre', '2022-12-19', 1),
(9, 'asdf', 'asdf', 'asdf@asdfasdfasdf.es', '6bbb0da1891646e58eb3e6a63af3a6fc3c8eb5a0d44824cba581d2e14a0450cf', 'mujer', '2022-12-22', 1),
(10, 'Jose Manuel', 'Sierras', 'jcastellanosierras@gmail.com', '9ec3affea9eebd4b8ff186a16d7a36ef79d5ce928cd57be1eac2c1826eac3f20', 'hombre', '2022-12-22', 1),
(11, 'asdf', 'fdasd', 'asdf@afdassdf.es', 'f0e4c2f76c58916ec258f246851bea091d14d4247a2fc3e18694461b1816e13b', 'mujer', '2022-12-15', 0),
(12, 'adfasdf', 'asdf', 'asdf@afdfassdf.es', '2ec65a01dea2f4b36ae57804bb5b0977304bc36b36dfb54bad756c238f690060', 'hombre', '2022-12-22', 0),
(14, 'root', 'root', 'root@padelzone.es', '0242c0436daa4c241ca8a793764b7dfb50c223121bb844cf49be670a3af4dd18', 'hombre', '2022-12-09', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
