<?php
/**
 * @var $job  backend\models\Job
 * @var $task backend\models\Task
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Акт про приймання виконаних робіт № <?= $job->id ?></title>
    <style>
        table.info {
            margin-top: 40px;
        }
        table.info td {
            padding: 5px;
        }

        table.work-data {
            width: 100%;
            margin-top: 40px;
            border-collapse: collapse;
        }
        table.work-data th {
            font-weight: normal;
        }
        table.work-data td {
            text-align: center;
        }
        table.work-data th,
        table.work-data td {
            border: 1px solid #000;
        }
        table.work-data td.work-name {
            text-align: left;
        }
        table.work-data td.total-price-name {
            border: none;
            text-align: right;
            padding-right: 5px;
        }

        .total-price-by-string {
            margin-top: 40px;
        }

        table.confirm {
            margin-top: 40px;
            width: 100%;
        }
        table.confirm td.name {
            width: 10%;
        }
        table.confirm td.signature {
            border-bottom: 1px solid #000;
            width: 30%;
        }
        ul.rules {
            margin-top: 40px;
            list-style: none;
            padding: 0;
        }
        ul.rules li {
            text-align: justify;
        }
    </style>
</head>
<body>
<div class="header">
    <div style="text-align: center">
        <h3>Акт про приймання виконаних робіт № <?= $job->id ?></h3>
    </div>
    <div style="text-align: center">
        від <?= \Yii::t('app', '{0, date, long}', strtotime($job->created_at)); ?>
    </div>
</div>

<table width="100%" class="info">
    <tr>
        <td width="20%">
            Виконавець
        </td>
        <td width="80%" colspan="3">
            Moto-Moto.kiev.ua
        </td>
    </tr>
    <tr>
        <td width="20%">
            Замовник
        </td>
        <td width="30%">
            <?= $job->client->full_name ?>
        </td>
        <td width="10%">
            тел.
        </td>
        <td width="40%">
            <?= preg_replace("/([+]{1})([0-9]{3})([0-9]{2})([0-9]{3})([0-9]{2})([0-9]{2})/", "$1$2 ($3) $4-$5-$6", $job->client->phone_number); ?>
        </td>
    </tr>
    <tr>
        <td width="20%">
            Назва техніки
        </td>
        <td width="30%">
            <?= $job->vehicle->model->brand->name ?>
        </td>
        <td width="10%">
            Модель
        </td>
        <td width="40%">
            <?= $job->vehicle->model->name ?>
        </td>
    </tr>
    <tr>
        <td width="20%">
            Номер шасі
        </td>
        <td width="80%" colspan="3">
            <?= $job->vehicle->frame_number ?>
        </td>
    </tr>
</table>

<table class="work-data">
    <tr>
        <th>
            №
        </th>
        <th>
            Найменування роботи (послуги, товари)
        </th>
        <th>
            Од. вим.
        </th>
        <th>
            Кількість
        </th>
        <th>
            Ціна (грн.)
        </th>
        <th>
            Сума (грн.)
        </th>
    </tr>
    <?php $number = 0; ?>
    <?php foreach ($job->tasks as $task): ?>
    <tr>
        <td>
            <?= ++$number ?>
        </td>
        <td class="work-name">
            <?= $task->name ?>
        </td>
        <td>
            1
        </td>
        <td>
            1
        </td>
        <td>
            <?= $task->price ?>
        </td>
        <td>
            <?= $task->price ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php foreach ($job->parts as $part): ?>
        <tr>
            <td>
                <?= ++$number ?>
            </td>
            <td class="work-name">
                <?= $part->name ?>
            </td>
            <td>
                1
            </td>
            <td>
                <?= $part->quantity ?>
            </td>
            <td>
                <?= $part->price ?>
            </td>
            <td>
                <?= ($part->quantity * $part->price) ?>
            </td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="5" class="total-price-name">
            Всього:
        </td>
        <td>
            <?= number_format($job->getTotalPrice(), 2, ',', '') ?>
        </td>
    </tr>
</table>

<div class="total-price-by-string">
    Всього надано послуг на суму: <?= $job->getTotalPriceByString() ?>.
</div>
<div style="margin-top: 15px">
    Перераховані вище роботи (послуги) виконані повністю і в строк. Замовник за обсягом, якостю і термінам надання послуг претензій не має.
</div>

<table class="confirm">
    <tr>
        <td class="name">
            Виконавець
        </td>
        <td width="40%">
            <?= $job->getCreatorName() ?>
        </td>
        <td class="name">
            Замовник
        </td>
        <td class="signature">

        </td>
        <td width="10%">

        </td>
    </tr>
</table>

<ul class="rules">
    <li>
        - Притензії щодо виконаних робіт приймаються протягом 7 календарних днів з моменту видачі техніки!
    </li>
    <li>
        - СТО залишае за собою право не розглядати притензії після закінчення 7-денного терміну;
    </li>
    <li>
        - Після отримання інформації про готовність техніки через 2 доби нараховується плата за стоянку в розмірі:
    </li>
    <li>
        Мотоцикл - 50 грн./доба**, моторолер, скутер – 25грн./доба**, квароцикл – 100грн./доба**
        ** - у разі, якщо техніка не забрана протягом 1 (одного) місяця, СТО залишає за собою право вилучення техніки та/або її комплектації для погашення боргу за стоянку;
    </li>
    <li>
        - Обов’язковим є дотримання правил експлуатації ремонтної техніки, для уникнення непорозумінь,
        зверніться будь ласка, до механіка для проведення роз’яснювальної роботи щодо експлуатації Вашої техніки!
    </li>
    <li>
        Дякуємо за вибір нашої майстерні.
    </li>
</ul>

</body>
</html>