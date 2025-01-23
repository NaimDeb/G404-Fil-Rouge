<?php

require_once "./components/htmlstart.php";
require_once "./components/header.php";
?>

<main>
<body class="flex items-center justify-center bg-gray-100">

<div class="flex h-full w-full">
    <!-- Image de gauche -->
    <div class="w-[65%] h-auto bg-fit bg-cover bg-[url(../../assets/images/heropc.png)]">
        <div class="backdrop-blur-sm w-full h-full"></div>
    </div>

    <!-- Formulaire de connexion  -->
    <div class="w-[35%] h-[90vh] bg-primary-beige flex items-center justify-center px-24 py-4">



        <form action="../process/process_connexion.php" method="POST" class="w-full space-y-4">
        <?php 

        if(isset($_GET['error'])) {
            echo '<div class="w-full bg-red-500 text-white text-center p-2 rounded-md">Email ou mot de passe incorrect</div>';
        }
        if(isset($_GET['success'])) {
            echo '<div class="w-full bg-green-500 text-white text-center p-2 rounded-md">Bienvenue ! Veuillez vous connectez</div>';
        }

        ?>
            <h2 class="text-xl font-semibold text-center text-primary-green mb-4">Se connecter</h2>

            <div class="flex flex-col">
                <label for="mailOrUsername" class="text-sm font-semibold text-gray-600">Adresse email ou nom d'utilisateur</label>
                <input type="text" id="mailOrUsername" name="mailOrUsername" class="border border-gray-300 p-3 rounded-md mt-2" placeholder="Email" required>
            </div>

            <div class="flex flex-col">
                <label for="password" class="text-sm font-semibold text-gray-600">Mot de passe</label>
                <input type="password" id="password" name="password" class="border border-gray-300 p-3 rounded-md mt-2" placeholder="Mot de passe" required>
            </div>

            <button type="submit" class="w-full bg-primary-green text-white py-2 rounded-md mt-4">Se connecter</button>

            <div class="mt-4 text-center flex flex-col gap-2">
                <a href="#" class="text-sm text-gray-600 hover:text-gray-700">Mot de passe oublié ?</a>
                <a href="./inscription.php" class="text-sm text-primary-green hover:text-gray-600">C'est votre première fois ? Inscrivez vous</a>
            </div>
        </form>
    </div>
</div>
</main>




<?php
require_once "./components/footer.php";
?>