<!DOCTYPE hmtl>
<html>
<head>
</head>
<body>
<h1>PAGO COMPLETADO</h1>
Codigo de operacion: <?php echo htmlspecialchars($PeticionActual); ?>
<p>Redirigiendo a la página de Inicio</p>

<script src="<?= base_url(); ?>public/js/toIndex.js"></script>
</body>
</html>