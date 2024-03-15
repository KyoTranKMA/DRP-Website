<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Manager Update User</title>
</head>
<body>
    <h1 class="display-1">Manager Update User</h1>
    
    <form action="/manager/user/update" method="POST">
        <input type="hidden" class="form-control" id="id" name="id" value="<?= $user->getId()?>">
        <div class="mb-3">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" value="<?= $user->getUsername()?>">
            </div>
        </div>
        <div class="mb-3">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password">
            </div>
        </div>
        <div class="mb-3">
            <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $user->getFirstName() ?? ''?>">
            </div>
        </div>
        <div class="mb-3">
            <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?= $user->getLastName() ?? ''?>">
            </div>
        </div>
        <div class="mb-3">
            <label for="date_of_birth" class="col-sm-2 col-form-label">Date Of Birth</label>
            <div class="col-sm-10">
            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?= !empty($user->getDateOfBirth()) ? date('Y-m-d', strtotime($user->getDateOfBirth())) : '' ?>">
            </div>
        </div>
        <div class="mb-3">
            <label for="date_of_birth" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" value="<?= $user->getEmail()?>">
            </div>
        </div>
        <div class="mb-3">
            <label for="date_of_birth" class="col-sm-2 col-form-label">Gender</label>
            <div class="col-sm-10">
                <select class="form-control" id="gender" name="gender" value="<?= $user->getGender() ?? ''?>">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Orther</option>
                </select>
            </div>
        </div>
        <button class="btn btn-success" name="update" type="submit">Update</button>
    </form>

    <a href="/logout" class="btn btn-primary" tabindex="-1" role="button">Logout</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>