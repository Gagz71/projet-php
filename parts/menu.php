
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Pouponnières d'étoiles</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Accueil<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="articles.php">Articles</a>
            </li>
            
            <?php
            //Affichage de la page de Déconnexion et profil si l'utilisateur est connecté
            if(isConnected()){
                echo '<li class="nav-item">
                        <a class="nav-link" href="profil.php" >Profil</a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php" >Déconnexion</a>
                    </li>';
            } else{ //affichage de la page de connexion et d'inscription si l'utilisateur n'est pas connecté
                echo'<li class="nav-item">
                    <a class="nav-link" href="login.php">Connexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="registration.php">Inscription</a>
                </li>';

            };
            //Affichage de la page de création d'articles si l'utilisateur est admin
            if(isAdmin()){
                echo '<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Admin</a>
                        <div class="dropdown-menu"><a class="dropdown-item active" href="articles_create.php">Ajouter un article</a></div>
                    </li>';
            }
            ?>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Chercher un article">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </nav>