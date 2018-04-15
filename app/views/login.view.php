<?php require 'partials/head.php'; ?>


<?php if ($message) : ?>
    <div class="alert alert-success alert-dismissible fade show">
        <p class="lead"><?= $message ?></p>
    </div>
<?php endif; ?>

<?php if ($errors) : ?>
    <?= displayErrors($errors); ?>
<?php endif; ?>

<div class="container">
    <div class="row">
        <div class="col-sm-6 offset-3">
            <div class="card">
                <div class="card-header bg-primary">
                    <h1 class="display-1 text-light">Log In</h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="\login">
                        <div class="form-group">
                            <label for="username">
                                <b>Username:</b>
                            </label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Your username" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="password">
                                <b>Password:</b>
                            </label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Your password" required>
                        </div>

                        <button type="submit" class="btn btn-success btn-block">Log In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'partials/footer.php'; ?>