<!DOCTYPE hmtl>
<html>
<head>
</head>
<body>
<h1>PAGO CANCELADO</h1>
Codigo de operacion: <?php echo htmlspecialchars($PeticionActual); ?>
<p>Redirigiendo a la página del carrito</p>

<script src="<?= base_url(); ?>public/js/toShoppingCart.js"></script>
</body>
</html>