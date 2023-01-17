<!DOCTYPE hmtl>
<html>
<head>
<style>
body {
    width: 90%;
    margin: 0 auto;
    font-family: Arial, Helvetica, sans-serif;
    border: solid 1px;
}
header {
    text-align: center;
    text-decoration: bold;
    color: blue;
}
</style>
</head>
<body>
<div>
  <header><h1>UMAPAL</h1></header>
  <div class="parametros">
    <h3>Informacion recibida:</h3>
    <ul>
      <?php
        foreach($_POST as $key => $value)
        {
          print "<li>" . $key . ":" . htmlspecialchars($value) . "</li>";
        }
      ?>
    </ul>
  </div>
  <div class="redireccion">
    <h3>Operacion:</h3>
    <h4>Aceptar envio:</h4>
    <form name="umapal_return" action="<?php echo $_POST["return"]; ?>" method="post">
    <input type="hidden" name="cartID" value="<?php echo $_POST["cartID"]; ?>">
    <input type="submit" value="Aceptar Pago" />
    </form>
    <h4>Rechazar envio:</h4>
    <form name="umapal_cancelreturn" action="<?php echo $_POST["cancel_return"]; ?>" method="post">
    <input type="hidden" name="cartID" value="<?php echo $_POST["cartID"]; ?>">
    <input type="submit" value="Rechazar Pago" />
    </form>
  </div>
</div>
</body>

</html>