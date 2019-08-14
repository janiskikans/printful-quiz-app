<?php

/**
 * @var View $this
 */

use Quiz\View;

?>

<div class="container" style="height:75vh;">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-5">
            <div class="card bg-secondary">
                <div class="card-body">
                    <form class="registerForm m-3" action="/loginPost" method="POST">
                        <h1 class="text-center"><i class="fa fa-sign-in fa-sm"></i> Sign In</h1>

                        <div class="form-group">
                            <label for="emailInput">Email</label>
                            <input required id="emailInput" type="email" name="email" placeholder="Email"
                                   class="form-control">
                        </div>

                        <div class="form-group pb-1">
                            <label for="passwordInput">Password</label>
                            <input required id="passwordInput" type="password" name="password" placeholder="Password"
                                   class="form-control">
                        </div>

                        <button class="btn btn-block btn-primary mt-2">Login</button>

                        <p class="mt-3">Don't have an account? Register <a href="/register">here</a>.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>