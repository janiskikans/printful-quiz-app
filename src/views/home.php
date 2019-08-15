<?php
/**
 * @var View $this
 * @var array $quizData
 */

use Quiz\ActiveUser;
use Quiz\View;

if (ActiveUser::isLoggedIn()) {
    $userName = ActiveUser::getLoggedInUser()->name;
}

?>

<?php if (ActiveUser::isLoggedIn()): ?>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-8">
                <?php if (ActiveUser::isLoggedIn()): ?>
                    <quiz :name='<?= json_encode($userName); ?>' :quizzes-prop='<?= json_encode($quizData); ?>'></quiz>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="container ">
        <div class="row mt-5">
            <div class="col-12">
                <h1 class="mb-3">Welcome to the Quiz app!</h1>
                <p>You need to login to start taking quizzes. If you are already a user, then log in <a href="/login">here</a>. If you don't have an account then
                    register <a href="/register">here</a>.</p>
            </div>
        </div>
    </div>
<?php endif; ?>
