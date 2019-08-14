<?php
/**
 * @var View $this
 */

use Quiz\Session;
use Quiz\View;

?>

<div class="container" style="height:75vh;">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-6">
            <div class="card bg-secondary">
                <div class="card-body">
                    <form class="registerForm p-3" action="/registerPost" method="POST">
                        <h1 class="text-center"><i class="fa fa-user-plus fa-sm"></i> Registration</h1>

                        <div class="form-group">
                            <label class="required-field" for="nameInput">Name</label>
                            <input required id="nameInput" type="text" name="name" placeholder="Name"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="required-field" for="emailInput">Email</label>
                            <input required id="emailInput" type="email" name="email" placeholder="Email"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="required-field" for="passwordInput">Password</label>
                            <input required id="passwordInput" type="password" name="password" placeholder="Password"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="required-field" for="passwordRepeatedInput">Repeat Password</label>
                            <input required id="passwordRepeatedInput" type="password" name="password_confirmation"
                                   placeholder="Password" class="form-control">
                        </div>

                        <button class="btn btn-primary mt-1 mr-2" href="/logout">Register</button>
                        <span class="align-middle">Already have an account? Log in <a href="/login">here</a>.</span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>