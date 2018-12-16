<?php
    require_once '../setup.php';
    require_once '../includes/header.php'; 
    require_once '../functions/validation.php';
?>
<div class="container">
    <div class="offset-3 col-6 pt-4 pb-4">
        <?php if( $fichas ): ?>
        <h2><?=$fichas['name']?></h2>
        <p><?=$fichas['description']?></p>
        <?php endif; ?>
        <?php if( mysqli_num_rows($result_items) == 0): ?>
        <div class="alert alert-warning" role="alert">
            No hay variantes.
        </div>
        <?php endif; ?>
        <?php if( $result_items ): ?>
        <ul class="fichas-group">
        <?php while($item = mysqli_fetch_assoc($result_items) ): ?>
            <li class="fichas-group-item fichas-group-item-info">
            <?=$item['description']?>
            <a href="<?=BASE_URL?>delete_item/?fichas_id=<?=$fichas['id']?>&item_id=<?=$item['id']?>"><i class="far fa-trash-alt float-right"></i></a>
            <a href="<?=BASE_URL?>edit_item/?fichas_id=<?=$fichas['id']?>&item_id=<?=$item['id']?>"><i class="far fa-edit float-right"></i> </a></li>
        <?php endwhile; ?>
        </ul>
        <?php endif; ?>
        <hr>
        <form action="" method="POST" novalidate>
            <div class="form-group">
                <input type="text" class="form-control <?=($errors['item'])?"is-invalid":""?>" id="item" name="item" aria-describedby="itemHelp" placeholder="Introduce un nuevo item" value="<?=($item??'')?>">
                <small id="itemHelp" class="form-text text-muted">Debe introducir algo</small>
                <?=validationDiv('item', 'invalid-feedback')?>
            </div>
            <?=validationDiv('login','alert')?>
            <button type="submit" name="saveitem" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>
<?php require_once '../includes/footer.php'; ?>