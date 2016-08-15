<?php

/* @var $this yii\web\View */
/**
 * @var $freeWorkers[] backend\models\User
 * @var $jobNew      backend\models\Job
 * @var $jobInWork   backend\models\Job
 * @var $jobSuspend  backend\models\Job
 * @var $worker     backend\models\User
 */

$this->title = 'Dashboard';
?>
<div class="site-index">
    <div class="row">
        <div class="col-lg-3">
            <table class="table table-striped table-bordered">
                <tbody>
                <?php foreach ($freeWorkers as $worker) : ?>
                    <tr>
                        <td><?= $worker->full_name ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-3">
            <table class="table table-striped table-bordered">
                <tbody>
                <?php foreach ($jobNew as $new) : ?>
                    <tr>
                        <td>
                            <?= $new->id ?>
                            <?= $new->client->full_name ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-3">
            <table class="table table-striped table-bordered">
                <tbody>
                <?php foreach ($jobInWork as $work) : ?>
                    <tr>
                        <td>
                            <?= $work->id ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-3">
            <table class="table table-striped table-bordered">
                <tbody>
                <?php foreach ($jobSuspend as $suspend) : ?>
                    <tr>
                        <td>
                            <?= $suspend->id ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
