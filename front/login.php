<!DOCTYPE html>
<html lang="fr">
    <?php require_once(__DIR__.'/partial/header.php') ?>
<body>
    <div class="container py-4 home">
        <div class="alert alert-danger d-none" role="alert" id="login-alert"></div>
        <div class="form p-4 ws-75 wd-50">
            <form action="/back" method="POST">
                <div class="form-group">
                    <label for="email-user">Email</label>
                    <input class="form-control" type="email" name="email" id="email-user" required>
                </div>
                <div class="form-group my-4">
                    <label for="password-user">Password</label>
                    <input class="form-control" type="password" name="password" id="password-user" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit"  id="send-user"/>
                </div>
            </form>
        </div>
    </div>
</body>
    <div>
        <?php require_once(__DIR__.'/partial/footer.php') ?>
    </div>
    
</html>