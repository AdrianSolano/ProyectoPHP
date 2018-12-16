<?php
    require_once '../setup.php';
    require_once '../includes/header.php'; 
?>
<div class="container">
    <div id="mis_fichas" class="row">
    <?php while($ficha = mysqli_fetch_assoc($result_fichas)): ?>
        <div class="col-sm">
            <div id="card_ficha" class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?=$ficha['name']?></h5>
                    <p class="card-text"><?=$ficha['description']?></p>
                    <a href="<?=BASE_URL?>fichas/?id=<?=$ficha['id']?>" class="card-link btn btn-primary">Ver ficha</a>
                    <a href="<?=BASE_URL?>delete_ficha/?id=<?=$ficha['id']?>" class="card-link float-right btn btn-danger">Borrar ficha</a>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>
</div>
<?php require_once '../includes/footer.php'; ?>