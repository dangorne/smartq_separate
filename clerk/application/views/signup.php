<div class="container">

  <div class="row">

    <div class="col-md-6 col-md-offset-3">

      <div class="panel panel-default">

        <div class="panel-body">

          <?php echo validation_errors() ?>

          <?php echo form_open('signup_subscriber') ?>

            <?php
             echo '<div class="form-group">';
             echo '<label class="control-label" for="user">Username</label>';
             echo '<input type="text" name="user" id="user" class="form-control" value = "'.set_value('user').'" aria-describedby="help">';
             echo '</div>';
            ?>

            <?php
             echo '<div class="form-group">';
             echo '<label class="control-label" for="pass">Password</label>';
             echo '<input type="password" name="pass" id="pass" class="form-control" value = "'.set_value('pass').'" aria-describedby="help">';
             echo '</div>';
            ?>

            <?php
             echo '<div class="form-group">';
             echo '<label class="control-label" for="confirmpass">Confirm Password</label>';
             echo '<input type="password" name="confirmpass" id="confirmpass" class="form-control" value = "'.set_value('confirmpass').'" aria-describedby="help">';
             echo '</div>';
            ?>

           <?php echo form_submit('submit', 'Sign Up') ?>
           <?php echo form_close() ?>

        </div>

      </div>

    </div>

  </div>

</div>
