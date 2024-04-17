<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => (!Yii::$app->user->isGuest)
            ? ((Yii::$app->user->identity->username != 'admin') ? ([
            ['label' => 'Таблицы',
                'items' => [
                    ['label' => 'Касса', 'url' => Yii::$app->urlManager->createUrl('/cashbox/index')],
                    ['label' => 'Клиенты', 'url' => Yii::$app->urlManager->createUrl('/clients/index')],
                    ['label' => 'Договора', 'url' => Yii::$app->urlManager->createUrl('/contracts/index')],
                    ['label' => 'Недвижимость', 'url' => Yii::$app->urlManager->createUrl('/immovables/index')],
                    ['label' => 'Операции с недвижимостью', 'url' => Yii::$app->urlManager->createUrl('/immovables-operations/index')],
                    ['label' => 'Типы недвижимости', 'url' => Yii::$app->urlManager->createUrl('/immovables-types/index')],
                    ['label' => 'Персонал', 'url' => Yii::$app->urlManager->createUrl('/personal/index')],
                    ['label' => 'Районы', 'url' => Yii::$app->urlManager->createUrl('/regions/index')],
                ],
            ],
            ['label' => 'Представления',
                'items' => [
                    ['label' => 'Полный вид имуществ с данными связей ', 'url' => Yii::$app->urlManager->createUrl('/full-view-table-with-relations-immovables/index')],
                ],
            ],
            ['label' => 'Хранимые процедуры',
                'items' => [
                    ['label' => 'Договора по конкретному работнику', 'url' => Yii::$app->urlManager->createUrl('/contracts/contract-by-personal')],
                    ['label' => 'Таблица физических лиц', 'url' => Yii::$app->urlManager->createUrl('/clients/legal-clients')],
                    ['label' => 'Сумма договоров по операции', 'url' => Yii::$app->urlManager->createUrl('/contracts/general-sum-by-immovables-operation')],
                ],
            ],
            ['label' => 'Запросы',
                'items' => [
                    ['label' => 'Недвижимость по статусу', 'url' => Yii::$app->urlManager->createUrl('/immovables/immovables-by-status')],
                    ['label' => 'Недвижимость по регионам', 'url' => Yii::$app->urlManager->createUrl('/immovables/immovables-group-by-region')],
                    ['label' => 'Поиск недвижимости по адресу', 'url' => Yii::$app->urlManager->createUrl('/immovables/immovables-by-address')],
                    ['label' => 'Клиенты по операции', 'url' => Yii::$app->urlManager->createUrl('/contracts/client-by-immovables-operations')],
                    ['label' => 'Приход по сотрудникам в текущем месяце', 'url' => Yii::$app->urlManager->createUrl('/cashbox/summary-entered-by-personal')],
                ],
            ],
            Yii::$app->user->isGuest
                ? ['label' => 'Login', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>',
            ]) : [['label' => 'Админ панель', 'url' => ['/admin']], Yii::$app->user->isGuest
                ? ['label' => 'Login', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                . Html::beginForm(['/site/logout'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'nav-link btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'] ) : ([['label' => 'Login', 'url' => ['/site/login']]])
    ]);
    NavBar::end();
    ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
