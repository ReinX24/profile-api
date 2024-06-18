<div class="container my-4">
    <h2 class="mb-3">Register User</h2>
    <h4 class="text-success"><?= $success_message ?? ""; ?></h4>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label fs-3">Name</label>
            <input type="text" name="name" class="form-control form-control-lg">
            <p class="form-text text-danger"><?= $errors["name_error"] ?? "" ?></p>
        </div>

        <div class="mb-3"></div>
        <label for="email" class="form-label fs-3">Email</label>
        <input type="email" name="email" class="form-control form-control-lg">
        <p class="form-text text-danger"><?= $errors["email_error"] ?? "" ?></p>

        <div class="mb-3">
            <label for="password" class="form-label fs-3">Password</label>
            <input type="password" name="password" class="form-control form-control-lg">
            <p class="form-text text-danger"><?= $errors["password_error"] ?? "" ?></p>
        </div>

        <div class="mb-3">
            <label for="contact_number" class="from-label fs-3">Contact Number</label>
            <input type="text" name="contact_number" class="form-control form-control-lg">
        </div>

        <div class="mb-3">
            <label for="birthdate" class="form-label fs-3">Birthdate</label>
            <input type="date" name="birthdate" class="form-control form-control-lg">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label fs-3">Address</label>
            <input type="text" name="address" class="form-control form-control-lg">
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label fs-3">Profile Photo</label>
            <input type="file" name="photo" class="form-control form-control-lg">
        </div>

        <button type="submit" class="btn btn-primary btn-lg">Register</button>
    </form>
</div>