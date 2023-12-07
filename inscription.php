<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/inscription.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Inscription</title>
</head>

<body>
    <div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
        <main class="inscrip">
            <div class="title">
                <h1>INSCRIPTION</h1>
            </div>
            <form action="save.php" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre adresse email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Inscription</button>
                    </div>
            </form>
        </main>
    </div>
</body>
</html>