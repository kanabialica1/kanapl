<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/thank-you-page.css">
    <title>Спасибо!</title>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 text-center">
                <h2>Спасибо. Ваш заказ принят!</h2>
                <h4>
                    Вы ввели следующие данные:<br/>
                </h4>
                <h4>
                    Имя: <?php if(!empty($_GET['name'])) { echo htmlspecialchars($_GET["name"]); } ?><br/>
                    Телефон: <?php if(!empty($_GET['phone'])) { echo htmlspecialchars($_GET["phone"]); } ?>
                </h4>

                <h4>Мы позвоним Вам в ближайшие 15 минут. Держите телефон рядом.<br>
                Наш колл центр работает с 09:00 до 22:00</h4>
            </div>
        </div>
    </div>

    <!-- ДОП ТОВАРЫ -->

    <!-- 
    ОПИСАНИЕ:
    Вы можете создать свою страницу благодарности, со своими товарами.
    Для этого вам необходимо переименовать данный файл на "thank-you-page.php" или заменить содержимое файла с таким же именем на содержимое данного файла;

    Для каждого нового товара скопируйте блок кода который выделен ниже, и замените поля(удалив скобки):
    [Вставьте название товара] - название товара который хотите добавить
    [Вставьте ссылку на изображение] - на ссылку на изображение (вы можете получить её нажав правой кнопкой мыши на изображение в разделе "товары" и выбрать пункт "копировать URL картинки"
    [Вставьте старую цену] - старая цена
    [Вставьте новую цену] - новая цена
    [Вставьте ссылку на ваш поток] - Вставьте ссылку на ваш уже созданный поток или на любой другой ваш сайт. 
    -->

    <div class="row text-center mt-5">
        <div class="col-12 text-uppercase font-weight-bold text-danger">
            <h3>Специальное предложение для Вас</h3>
        </div>
    </div>
    <hr>

    <!-- Скопируйте этот блок для последующих товаров -->
    <div class="row mt-4">
        <div class="col-sm-6 col-lg-4 mb-4">
            <div class="card w-100">
                <div class="cart-body bg-danger text-center text-white font-weight-bold py-2" style="font-size: 1.2em">
                    [Вставьте название товара]
                </div>
                <img class="card-img-top" src="[Вставьте ссылку на изображение]">
                <div class="card-body">
                    <div class="row font-weight-bold my-2" style="font-size: 1.5em">
                        <div class="col-6 text-right">
                            <span style="text-decoration: line-through">[Вставьте старую цену] грн</span>
                        </div>
                        <div class="col-6">
                            <span class="text-danger">[Вставьте новую цену] грн</span>
                        </div>
                    </div>
                    <a href="[Вставьте ссылку на ваш поток]" class="btn btn-success w-100 text-center mt-2">Подробнее</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Конец блока -->

</body>
</html>

