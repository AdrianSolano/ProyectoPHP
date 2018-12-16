<?php
    require_once '../setup.php';
    require_once '../includes/header.php'; 
    require_once '../functions/validation.php';
?>
<div class="container">
    <div class="offset-3 col-6 pt-4 pb-4">
        <?php if( $ficha ): ?>
        <h2><a href="<?=BASE_URL.'ficha/?id='.$list_id?>"><?=$ficha['nombre_ficha']?></a></h2>
        <?php endif; ?>
        <hr>
        <form action="" method="POST" novalidate>
            <div class="form-group">
                <input type="text" class="form-control <?=($errors['ficha'])?"is-invalid":""?>" id="ficha" name="ficha" aria-describedby="fichaHelp" placeholder="Introduce un nuevo ficha" value="<?=($ficha['ficha_text']??'')?>">
                <small id="fichaHelp" class="form-text text-muted">Debe introducir nacion</small>
                <?=validationDiv('ficha', 'invalid-feedback')?>
            </div>
            <?=validationDiv('login','alert')?>
            <button type="submit" name="edit_ficha" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
<?php require_once '../includes/footer.php'; ?>