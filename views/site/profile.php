<?php require_once ROOT."/views/layouts/header.php";?>

<!-- Профиль пользователя -->

<div class="container card" id="view">

    <div class="row">
        <div class="col">
            <h2>Имя</h2>
            <h6>something@gmail.com</h6>
            <button type="button" class="btn btn-outline-info">Изменить пароль</button>
            <br><br>
        </div>
    </div>
    <div class="input-group">
        <select class="custom-select" id="inputGroupSelect04">
            <option selected>Choose...</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button">Добавить</button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h4>Список желаемого/заказы</h4>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-sm">
                <thead>
                <tr class="table-active">
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
                </thead>
                <tbody>
                <tr class="table-warning">
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr class="table-success">
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once ROOT."/views/layouts/footer.php";?>