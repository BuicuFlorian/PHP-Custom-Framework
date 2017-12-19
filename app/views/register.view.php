<?php require 'partials/head.php'; ?>

<div class="container">
    <h1 class="display-1">Sign Up</h1>
    <div class="row">
        <div class="col-sm-6 offset-3">
            <form method="POST" action="\register">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required autofocus>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                        <input type="password" class="form-control" name="passwordConfirmation" id="passwordConfirmation" placeholder="Password Confirmation" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-block">Submit</button>
            </form>
        </div>
    </div>
</div>

<?php require 'partials/footer.php'; ?>