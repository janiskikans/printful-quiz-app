<?php

use Quiz\Session;
use Quiz\View;

/**
 * @var View $this
 */
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <!--    Error Messages  -->
            <?php if (Session::getInstance()->hasMessages(SESSION::MESSAGE_TYPE_ERROR)): ?>
                <?php foreach (Session::getInstance()->getMessages(SESSION::MESSAGE_TYPE_ERROR, true) as $error): ?>
                    <div class="alert alert-dismissible alert-primary mt-3">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong><?= $error; ?></strong>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <!--    Messages    -->
            <?php if (Session::getInstance()->hasMessages(SESSION::MESSAGE_TYPE_MESSAGE)): ?>
                <?php foreach (Session::getInstance()->getMessages(SESSION::MESSAGE_TYPE_MESSAGE, true) as $message): ?>
                    <div class="alert alert-dismissible alert-success mt-3">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong><?= $message; ?></strong>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>