<?php
    require_once '../setup.php';
    require_once '../includes/header.php'; 
?>
<div class="container">
    <div class="offset-3 col-6 pt-4 pb-4">
        <h1>Crear Nueva Lista</h1>
        <form action="" method="POST" novalidate>
            <div class="form-group">
                <label for="nombreVehiculo">Nombre de la lista</label>
                <input type="text" class="form-control <?=($errors['nombreVehiculo'])?"is-invalid":""?>" id="nombreVehiculo" name="nombreVehiculo" aria-describedby="nombreVehiculoHelp" placeholder="Introduce un nombre para la lista" value="<?=($list['name']??'')?>">
                <small id="usernameHelp" class="form-text text-muted">Debe tener como mínimo 4 caracteres con números y letras minúsculas.</small>
                <?php if( !empty($errors['nombreVehiculo']) ): ?> 
                <div class="invalid-feedback">
                    <?php foreach ($errors['nombreVehiculo'] as $error): ?>
                        <?=$error?><br/>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="descVehiculo">Descripción</label>
                <textarea class="form-control" id="descVehiculo" name="descVehiculo" rows="3"><?=($list['description']??'')?></textarea>
            </div>
            <button type="submit" name="edit_list" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>
<?php require_once '../includes/footer.php'; ?>