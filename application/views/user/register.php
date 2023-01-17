
<?= $header; ?>

  <section>
    <h2>Bienvenido a Padel Zone</h2>
    <?php echo form_open(''); ?>
    <?php
    if (isset($error)) {
      echo '<span class="error">' . $error . '</span>';
    }
    ?>
    <a href="login">¿Ya tiene cuenta? ¡Inicie sesión!</a>
    <br>
    <?= form_error('register-gender', '<span class="error">', '</span>'); ?>
    <div class="fragment-form">
      <div class="name-input-radio">
        <?= form_label('Género', 'register-gender'); ?>
        <!-- <label for="register-gender">Género</label> -->
      </div>

      <div class="input-radio">
        <div>
          <?php
          $input = array(
            'type' => 'radio',
            'name' => 'register-gender',
            'id' => 'register-gender-male',
            'value' => 'hombre'
          );

          if (isset($values_form)) {
            if ($values_form['gender'] == 'hombre') {
              $input['checked'] = TRUE;
            }
          }

          echo form_radio($input);
          echo form_label('Hombre', 'register-gender-male');
          ?>
          <!-- <input type="radio" name="register-gender" id="register-gender-male" value="male">
          <label for="register-gender-male">Hombre</label> -->
        </div>

        <div>
          <?php
          $input = array(
            'type' => 'radio',
            'name' => 'register-gender',
            'id' => 'register-gender-female',
            'value' => 'mujer'
          );

          if (isset($values_form)) {
            if ($values_form['gender'] == 'mujer') {
              $input['checked'] = TRUE;
            }
          }

          echo form_radio($input);
          echo form_label('Mujer', 'register-gender-female');
          ?>
          <!-- <input type="radio" name="register-gender" id="register-gender-female" value="female">
          <label for="register-gender-female">Mujer</label> -->
        </div>
      </div>
    </div>

    <?= form_error('register-fname', '<span class="error">', '</span>'); ?>
    <div class="fragment-form">
      <?php
      $input = array(
        'name' => 'register-fname'
      );

      if (isset($values_form)) {
          $input['value'] = $values_form['fname'];
      }

      echo form_label('Nombre', 'register-fname');
      echo form_input($input);
      ?>

      <!-- <label for="register-fname">Nombre</label>
      <input type="text" name="register-fname" id="register-fname"> -->
    </div>

    <?= form_error('register-lname', '<span class="error">', '</span>'); ?>
    <div class="fragment-form">
    <?php
      $input = array(
        'name' => 'register-lname'
      );

      if (isset($values_form)) {
        $input['value'] = $values_form['lname'];
      }

      echo form_label('Apellidos', 'register-lname');
      echo form_input($input);
      ?>

      <!-- <label for="register-lname">Apellidos</label>
      <input type="text" name="register-lname" id="register-lname"> -->
    </div>

    <?= form_error('register-email', '<span class="error">', '</span>'); ?>
    <div class="fragment-form">
    <?php
      $input = array(
        'type' => 'email',
        'name' => 'register-email'
      );

      if (isset($values_form)) {
        $input['value'] = $values_form['email'];
    }

      echo form_label('Dirección de correo electrónico', 'register-email');
      echo form_input($input);
      ?>
      <!-- <label for="register-email">Dirección de correo electrónico</label>
      <input type="email" name="register-email" id="register-email"> -->
    </div>

    <?= form_error('register-password', '<span class="error">', '</span>'); ?>
    <div class="fragment-form">
    <?php
      $input = array(
        'type' => 'password',
        'name' => 'register-password'
      );

      if (isset($values_form)) {
        $input['value'] = $values_form['password'];
    }

      echo form_label('Contraseña', 'register-password');
      echo form_input($input);
      ?>
      <!-- <label for="register-password">Contraseña</label>
      <input type="password" name="register-password" id="register-password"> -->
    </div>

    <?= form_error('register-birthday', '<span class="error">', '</span>'); ?>
    <div class="fragment-form">
    <?php
      $input = array(
        'type' => 'date',
        'name' => 'register-birthday'
      );

      if (isset($values_form)) {
        $input['value'] = $values_form['birthday'];
    }

      echo form_label('Fecha de nacimiento', 'register-birthday');
      echo form_input($input);
      ?>
      <!-- <label for="register-birthday">Fecha de nacimiento</label>
      <input type="date" name="register-birthday" id=" register-birthday"> -->
    </div>

    <div class="fragment-form checkbox-form">
      <div></div>
      <div>
        <?php
        $input = array(
          'name' => 'register-receive-offers',
          'value' => 'accept'
        );

        if (isset($values_form)) {
          $input['checked'] = $values_form['ofertas'] == 1 ? TRUE : FALSE;
        }

        echo form_checkbox($input);
        echo form_label('Recibir ofertas', 'register-receive-offers');
        ?>
        <!-- <input type="checkbox" name="register-receive-offers" id="register-receive-offers">
        <label for="register-receive-offers">Recibir ofertas</label> -->
      </div>
    </div>

    <?= form_error('register-accept-terms', '<span class="error">', '</span>'); ?>
    <div class="fragment-form checkbox-form">
      <div></div>
      <div>
        <?php
        $input = array(
          'name' => 'register-accept-terms',
          'value' => 'accept'
        );

        if (isset($values_form)) {
          $input['checked'] = $values_form['terms'] == 1 ? TRUE : FALSE;
        }

        echo form_checkbox($input);
        echo form_label('Aceptar términos y condiciones y la política de privacidad', 'register-accept-terms');
        ?>
        <!-- <input type="checkbox" name="register-accept-terms" id="register-accept-terms" required>
        <label for="register-receive-offers">Aceptar términos y condiciones y la política de privacidad</label> -->
      </div>
    </div>

    <div class="fragment-form">
      <?php
      echo form_submit('submit', 'Enviar');
      ?>
      <!-- <input type="submit" value="Enviar"> -->
    </div>
    <?php echo form_close(); ?>

  </section>
</main>

<?= $footer; ?>