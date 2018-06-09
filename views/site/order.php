<?php require_once ROOT."/views/layouts/header.php";?>

    <!-- Информация о заказе -->
    <div class="container card" id="view">
        <div class="row" style="margin-bottom: 20px">
            <div class="col">
                <h2>Название кинотеатра</h2>
                <img src="http://misanec.ru/wp-content/uploads/2016/10/1249915-840x420.jpg" alt="" width="400" height="300">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mx-auto">
                <form>
                    <div class="form-row">
                        <div class="form-group col">
                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <select id="inputState" class="form-control">
                                <option selected>Выберите дату...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <select id="inputState" class="form-control">
                                <option selected>Выберите сеанс...</option>
                                <option>...</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Готово</button>
                    <button type="button" class="btn btn-danger">Отмана</button>
                </form>
            </div>
        </div>
    </div>

<?php require_once ROOT."/views/layouts/footer.php";?>