<?php
    require_once '../setup.php';
    require_once '../includes/header.php'; 
?>
<div class="container">
    <div class="offset-3 col-6 pt-4 pb-4">
        <h1>Crear nueva ficha de carro de combate</h1>
        <form action="" method="POST" novalidate>
            <div class="form-group">
                <label for="nombreVehiculo">Nombre del vehiculo</label>
                <input type="text" class="form-control <?=($errors['nombreVehiculo'])?"is-invalid":""?>" id="nombreVehiculo" name="nombreVehiculo" aria-describedby="nombreVehiculoHelp" placeholder="Introduce un nombre para el vehiculo" value="<?=($nombreVehiculo??'')?>">
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
                <textarea class="form-control" id="descVehiculo" name="descVehiculo" placeholder="Descripción del vehiculo" rows="2"><?=($descVehiculo??'')?></textarea>
            </div>
            <button type="submit" name="nuevaFicha" class="btn btn-primary">Nueva ficha</button>
        </form>
    </div>
</div>
<?php require_once '../includes/footer.php'; ?>