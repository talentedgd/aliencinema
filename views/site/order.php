<?php require_once ROOT . "/views/layouts/header.php"; ?>

<div class="container card" id="view">
    <div class="row">
        <div class="col">
            <br id="<?php echo $hall; ?>" class="hall">
            <h1 align="center" id="<?php echo $session; ?>" class="session">ЭКРАН</h1>
        </div>
    </div>

    <?php
    $i = 1;
    (int)$rowSize = $sitsCount['number_of_sits'] / $sitsCount['number_of_rows'];
    for ($row = 1; $row <= (int)$sitsCount['number_of_rows']; $row++) { ?>
        <div class="row justify-content-center">
            <?php for ($place = 1; $place <= $rowSize; $place++) {
                ?>
                <button id="<?php echo $i; ?>" style=" margin:5px; height: 40px; width: 40px;" type="button"
                        class="sits btn btn-primary">
                    <?php echo $place; ?>
                </button>
                <?php $i++;
            } ?>
        </div>
    <?php } ?>
    <?php if (!isset($_SESSION['user_id'])): ?>
        <label for="film-name">Ваш email</label>
        <input name="email" required type="text" class="form-control" id="email-order"
               placeholder="Введите email...">
    <?php endif; ?><br>
    <button type="button" id="submit-sits" class="btn btn-outline-success">Готово</button>

</div>

<?php require_once ROOT . "/views/layouts/footer.php"; ?>
