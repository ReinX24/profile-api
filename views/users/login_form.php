<h4>Login User</h4>
<p class="pico-color-red-500"><?= $errors["user_error"] ?? "" ?></p>
<form method="POST">
    <label for="name">Name</label>
    <input type="text" name="name" value="<?= $_POST["name"] ?? "" ?>">
    <p class="pico-color-red-500"><?= $errors["name_error"] ?? "" ?></p>

    <label for="email">Email</label>
    <input type="email" name="email" value="<?= $_POST["email"] ?? "" ?>">
    <p class="pico-color-red-500"><?= $errors["email_error"] ?? "" ?></p>

    <label for="password">Password</label>
    <input type="password" name="password">
    <p class="pico-color-red-500"><?= $errors["password_error"] ?? "" ?></p>

    <button type="submit">Submit</button>
</form>