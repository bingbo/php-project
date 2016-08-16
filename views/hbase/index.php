<?php

/* @var $this yii\web\View */

$this->title = 'My Hbase Demo';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Hbase Test!</h1>

        <p class="lead">this is demo test with hbase...</p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-10">
                <h2>tables</h2>
                <table class="table">
                <?php foreach($data['tables'] as $key => $table){ ?>
                    <tr><td><?= $table ?></td></tr>
                <?php } ?>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10">
                <h2>member table</h2>

                <table class="table">
                    <?php foreach($data['table_member'] as $key => $row){ ?>
                        <div class="divider"></div>
                        <tr><td>id</td><td><?= $row['row'] ?></td></tr>
                        <?php foreach($row['columns'] as $cn => $cv){ ?>
                        <tr><td><?= $cn ?></td><td><?= $cv['value'] ?></td></tr>
                        <?php } ?>
                    <?php } ?>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
