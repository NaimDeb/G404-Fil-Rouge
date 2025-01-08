<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . "/BookMarket/utils/connectDB.php");
session_start();

if (isset($_SESSION["user"]) && !isset($_SESSION["user"]["imgPath"])) {

    $sql = "SELECT image.img_path FROM image JOIN user ON image.id = user.id_image WHERE user.id = :id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $_SESSION["user"]["id"]]);

    $temppath = $stmt->fetch()["img_path"];

    $_SESSION["user"]["imgPath"] = $temppath;

};



?>

<header class="bg-primary-green w-full h-[11vh] md:h-fit flex flex-col py-4 px-4 md:px-8">

    <div class="md:h-full flex flex-col md:flex-row md:items-center md:justify-between">
        <!-- Première ligne  -->
        <div class="h-full flex flex-row items-center justify-between max-md:w-full">
            <!-- Menu Hamburger  -->
            <a href="#" class="md:hidden text-neutral-off-white text-2xl px-2">
                <i class="fas fa-bars"></i>
            </a>

            <!-- Logo  -->
            <a href="<?= $root_path ?>/index.php" class="w-[80%] md:order-1 mx-auto md:px-2">
                <img src="<?= $root_path ?>/assets/src/images/Logo.svg" alt="Logo Bookmarket" class="object-scale-down max-h-12 mx-auto sm:mx-0">
            </a>

            <!-- User sm et moins  -->
            <?php if (isset($_SESSION["user"])): ?>
                <a href="<?= $root_path ?>/public/pages/profile.php" class="flex gap-2 text-neutral-off-white text-2xl px-2 sm:order-3 md:hidden cursor-pointer items-center">
                    <span class="text-sm text-nowrap self-end ml-2"><?= $_SESSION["user"]["username"] ?></span>
                    <img src="<?= $_SESSION["user"]["imgPath"] ?>" alt="User Image" class="rounded-full h-8 w-8">
                </a>
            <?php else: ?>
                <a href="<?= $root_path ?>/public/pages/login.php" class="sm:inline-flex text-neutral-off-white text-2xl px-2 sm:order-3 md:hidden cursor-pointer items-center">
                    <i class="fas fa-user"></i>
                </a>
            <?php endif; ?>

        </div>

        <!-- Searchbar -->
        <div id="searchbar" class="bg-neutral-off-white py-2 px-4 w-full rounded-sm flex items-center justify-between gap-2 md:order-2 md:w-[3/5]">
            <!-- Dropdown et séparateur -->
            <div class="flex items-center basis-1/5">
                <label for="search-choice" class="sr-only">Type de recherche</label>
                <select name="searchChoice" id="search-choice" class="bg-neutral-off-white truncate text-sm font-bold w-full" aria-label="Choisissez le type de recherche">
                    <option value="all">Tous</option>
                    <option value="book">Livres</option>
                    <option value="author">Auteurs</option>
                    <option value="user">Utilisateurs</option>
                </select>
                <!-- Séparateur -->
                <div class="w-[1px] h-4 mx-2 bg-neutral-off-black" aria-hidden="true"></div>
            </div>

            <!-- Champ de recherche -->
            <label for="search-input" class="sr-only">Rechercher un livre</label>
            <input
                type="text"
                onkeyup="showResult(this.value)"
                placeholder="Vous cherchez un livre ? Recherchez ici..."
                class="text-neutral-off-black focus:outline-none basis-3/5 w-full truncate"
                aria-label="Rechercher un livre ou un utilisateur"
                aria-live="polite">

            <!-- Icône de recherche -->
            <i class="fas fa-magnifying-glass text-xl basis-auto" aria-label="Lancer la recherche"></i>
        </div>

        <!-- User (md+) -->
        <?php if (isset($_SESSION["user"])): ?>
            <a href="<?= $root_path ?>/public/pages/profile.php" class="md:inline-flex text-neutral-off-white text-2xl px-2 sm:order-3 hidden items-center">
                <span class="text-sm text-nowrap self-end ml-2"><?= $_SESSION["user"]["username"] ?></span>
                <img src="<?= $_SESSION["user"]["imgPath"] ?>" alt="User Image" class="rounded-full h-8 w-8">
            </a>
        <?php else: ?>
            <a href="<?= $root_path ?>/public/pages/login.php" class="md:inline-flex text-neutral-off-white text-2xl px-2 sm:order-3 hidden items-center">
                <span class="text-sm text-nowrap self-end mr-2">Se connecter</span>
                <i class="fas fa-user"></i>
            </a>
        <?php endif; ?>

    </div>

    <!-- Deuxième ligne (Navigation supplémentaire) -->
    <nav class="hidden md:flex w-full justify-between items-center mt-4 font-merriweather">
        <!-- Liens principaux -->
        <div class="flex space-x-8 text-white font-bold basis-2/3 justify-between text-nowrap">
            <a href="<?= $root_path ?>/public/pages/new.php" class="hover:underline">Nouveautés</a>
            <a href="<?= $root_path ?>/public/pages/classics.php" class="hover:underline">Classiques incontournables</a>
            <a href="<?= $root_path ?>/public/pages/cheap.php" class="hover:underline">Petits prix</a>
            <a href="<?= $root_path ?>/public/pages/youth.php" class="hover:underline">Jeunesse</a>
        </div>

        <!-- Bouton Vendre un livre -->
        <a href="<?= $root_path ?>/public/pages/sell.php" class="bg-transparent border-2 border-white text-white px-6 py-2 rounded-full hover:bg-white hover:text-primary-green transition">
            Vendre un livre
        </a>
    </nav>

</header>
