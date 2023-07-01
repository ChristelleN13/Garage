<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="/front/css/form.css">
    <link rel="stylesheet" href="/front/css/index.css">
    <title>Garage 2</title>
</head>
<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    // Rediriger vers la page d'accueil ou une autre page protégée
    header('Location: home.php');
    exit;
}

// Vérifier si le formulaire de connexion est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Valider les données (vérifier si les champs sont vides, etc.)
    if (empty($username) || empty($password)) {
        $error = "Veuillez saisir un nom d'utilisateur et un mot de passe";
    } else {
        // Connexion à la base de données (adaptation de vos paramètres de connexion)
        $dsn = "mysql:host=localhost;dbname=nom_de_votre_base_de_donnees;charset=utf8";
        $dbUsername = "votre_nom_utilisateur";
        $dbPassword = "votre_mot_de_passe";
        
        try {
            $pdo = new PDO($dsn, $dbUsername, $dbPassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête pour récupérer les informations de l'utilisateur
            $query = "SELECT id, username, password FROM users WHERE username = :username";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifier si l'utilisateur existe et si le mot de passe correspond
            if ($user && password_verify($password, $user['password'])) {
                // Stocker l'ID de l'utilisateur dans la session
                $_SESSION['user_id'] = $user['id'];

                // Rediriger vers la page d'accueil ou une autre page protégée
                header('Location: home.php');
                exit;
            } else {
                $error = "Nom d'utilisateur ou mot de passe incorrect";
            }
        } catch (PDOException $e) {
            $error = "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>

    <?php if (isset($error)) { ?>
        <div><?php echo $error; ?></div>
    <?php } ?>

    <form method="POST" action="">
        <div>
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <button type="submit">Se connecter</button>
        </div>
    </form>
</body>
</html>
