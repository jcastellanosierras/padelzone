<?= $header; ?>

  <section>
    <h2>Bienvenido de nuevo</h2>
    <?= form_open(''); ?>
      <?= form_error('login-email', '<span class="error">', '</span>'); ?>
      <?php
      if (isset($error)) {
        echo '<span class="error">' . $error . '</span>';
      }
      ?>
      <div class="fragment-form">
        <?php
        $input = array(
          'type' => 'email',
          'name' => 'login-email'
        );

        if (isset($value_email)) {
          $input['value'] = $value_email;
        }

        echo form_label('Dirección de correo electrónico', 'login-email');
        echo form_input($input);
        ?>

        <!-- <label for="login-email">Dirección de correo electrónico</label>
        <input type="email" name="login-email" id="login-email"> -->
      </div>

      <?= form_error('login-password', '<span class="error">', '</span>'); ?>
      <div class="fragment-form">
        <?php
        $input = array(
          'type' => 'password',
          'name' => 'login-password'
        );

        echo form_label('Contraseña', 'login-password');
        echo form_input($input);
        ?>

        <!-- <label for="login-password">Contraseña</label>
        <input type="password" name="login-password" id="login-password"> -->
      </div>
      <div class="fragment-form">
        <a href="#">¿Olvidó la contraseña?</a>
      </div>
      <div class="fragment-form">
        <?= form_submit('submit', 'Iniciar Sesión'); ?>
        <!-- <input type="submit" value="Iniciar Sesión"> -->
      </div>
      <div class="fragment-form">
        <a href="register">¿No tiene cuenta? Cree una aquí</a>
      </div>
    <?= form_close(); ?>
  </section>
</main>

<?= $footer; ?>