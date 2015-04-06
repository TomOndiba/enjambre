

<legend><h2>Ingresa tus Datos</h2></legend>		
<div>
    <label><?php echo elgg_echo('loginusername'); ?></label>
    <?php
    echo elgg_view('input/text', array(
        'name' => 'username',
        'class' => 'elgg-autofocus',
        'placeholder' => 'Ingresa tu nombre de usuario',
    ));
    ?>
</div><br>
<div>
    <label><?php echo elgg_echo('password'); ?></label>
    <?php echo elgg_view('input/password', array('name' => 'password', 'placeholder' => 'Ingresa tu contraseña')); ?>
</div>

<?php echo elgg_view('login/extend', $vars); ?>

<div class="elgg-foot">
    <label class="mtm float-alt">
        <input type="checkbox" name="persistent" value="true" />
        <?php echo elgg_echo('user:persistent'); ?>
    </label>


    <?php echo elgg_view('input/submit', array('value' => 'Entrar', 'name' => 'buttonLogin', 'class' => 'button-login')); ?>

    <?php
    if (isset($vars['returntoreferer'])) {
        echo elgg_view('input/hidden', array('name' => 'returntoreferer', 'value' => 'true'));
    }
    ?><br>
    <div class="row" style="text-align:right; width:100%">
        <a class="forgot_link" href="<?php echo elgg_get_site_url(); ?>forgotpassword">
            <?php echo elgg_echo('user:password:lost'); ?>
        </a>
    </div>
    <hr/>
    <ul class="elgg-menu elgg-menu-general mtm list-registro">
        <?php
        if (elgg_get_config('allow_registration')) {
            echo '<li><a class="registration_link" href="' . elgg_get_site_url() . 'usuario/registro">' . elgg_echo('register') . '</a></li>';
            echo '<li><a class="registration_link" href="' . elgg_get_site_url() . 'usuario/registro/estudiante" >Registrarse como Estudiante</a>';
        }
        ?>
        <li></li> 
    </ul>
</div> 