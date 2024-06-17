<div class="container my-4">
    <h2 class="mb-3">Login User</h2>
    <h4 class="text-danger"><?= $errors["user_error"] ?? "" ?></h4>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label fs-3">Name</label>
            <input type="text" name="name" class="form-control form-control-lg" value="<?= $_POST["name"] ?? "" ?>">
            <p class="form-text text-danger"><?= $errors["name_error"] ?? "" ?></p>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fs-3">Email</label>
            <input type="email" name="email" class="form-control form-control-lg" value="<?= $_POST["email"] ?? "" ?>">
            <p class="form-text text-danger"><?= $errors["email_error"] ?? "" ?></p>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fs-3">Password</label>
            <input type="password" name="password" class="form-control form-control-lg">
            <p class="form-text text-danger"><?= $errors["password_error"] ?? "" ?></p>
        </div>

        <button type="submit" class="btn btn-primary btn-lg">Login</button>
    </form>
</div>