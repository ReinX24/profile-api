<h4>Register User</h4>
<h4 class="pico-color-jade-500"><?= $success_message ?? ""; ?></h4>
<form method="POST" enctype="multipart/form-data">
    <label for="name">Name</label>
    <input type="text" name="name">
    <p class="pico-color-red-500"><?= $errors["name_error"] ?? "" ?></p>

    <label for="email">Email</label>
    <input type="email" name="email">
    <p class="pico-color-red-500"><?= $errors["email_error"] ?? "" ?></p>

    <label for="password">Password</label>
    <input type="password" name="password">
    <p class="pico-color-red-500"><?= $errors["password_error"] ?? "" ?></p>

    <label for="contact_number">Contact Number</label>
    <input type="text" name="contact_number">

    <label for="birthdate">Birthdate</label>
    <input type="date" name="birthdate">

    <label for="address">Address</label>
    <input type="text" name="address">

    <label for="photo">Profile Photo</label>
    <input type="file" name="photo">

    <button type="submit">Register</button>
</form>