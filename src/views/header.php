<?php

/**
 * @var View $this
 */

use Quiz\ActiveUser;
use Quiz\View;

?>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">NSWER</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03"
                aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="mr-auto"></div>

        <!--<div class="collapse navbar-collapse" id="navbarColor03">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home</a>
                </li>
            </ul>
        </div>-->

        <div>
            <?php if (ActiveUser::isLoggedIn()): ?>
                <lead>Hello, <?= ActiveUser::getLoggedInUser()->name; ?>!</lead>
                <a class="btn btn-outline-primary mr-3 ml-3" href="/logout"><i class="fa fa-sign-out-alt fa-sm"></i> Logout</a>
            <?php else: ?>
                <a href="/login" class="btn btn-primary mr-1"><i class="fa fa-sign-in fa-sm"></i> Login</a>
                <a href="/register" class="btn btn-primary"><i class="fa fa-user-plus fa-sm"></i> Registration</a>
            <?php endif; ?>
        </div>
    </nav>
</header>
