<?php require 'partials/head.php'; ?>

<?php if ($errors) : ?>
    <?= displayErrors($errors); ?>
<?php endif; ?>

<div class="container">
    <div class="row">
        <div class="col-sm-6 offset-3">
            <div class="card">
                <div class="card-header bg-primary">
                <h1 class="display-1 text-light">Register</h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="\register">
                        <div class="form-group">
                            <label for="username">
                                <b>Username:</b>
                            </label>
                            <input type="text" class="form-control" name="user[username]" id="username" placeholder="Your username" required autofocus>

                        </div>

                        <div class="form-group">
                            <label for="password">
                                <b>Password:</b>
                            </label>
                            <input type="password" class="form-control" name="user[password]" id="password" placeholder="Your password" required>
                        </div>

                        <div class="form-group">
                        <label for="password_confirmation">
                                <b>Password confirmation:</b>
                            </label>
                            <input type="password" class="form-control" name="user[password_confirmation]" id="password_confirmation" placeholder="Confirm your password" required>
                        </div>

                        <button type="submit" class="btn btn-success btn-block">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'partials/footer.php'; ?>