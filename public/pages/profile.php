<?php
require_once "../components/htmlstart.php";
require_once "../components/header.php";

$sql = "SELECT profile_desc FROM user WHERE id = :id";

$stmt = $pdo -> prepare($sql);
$stmt -> execute(['id' => $_SESSION["user"]["id"]]);


$user_desc = $stmt -> fetch()["profile_desc"];

if($user_desc == null){
    $user_desc = "Complétez votre profil avec une petite description !";
};


?>


<main class="bg-primary-beige">
    <!-- Section -->
    <section class="w-full min-h-[35vh] bg-primary-green flex flex-col my-8 py-4">

        <img src="<?= $_SESSION["user"]["imgPath"] ?>" alt="Photo de l'utilisateur" class="w-[100px] h-[100px] rounded-full m-auto backdrop-brightness-50">

        <div class="flex flex-col items-center">
            <p class="text-2xl font-bold  text-neutral-off-white  font-merriweather"> <?= $_SESSION["user"]["username"] ?> </p>
            <div class="max-w-[80%]  bg-neutral-off-white text-primary-green rounded-lg rounded-tl-none font-open-sans">
                <!-- Desc -->
                <p class="font-light py-2 px-4"> <?= $user_desc ?> </p>
            </div>
        </div>

        <!-- Boutons editer profil et deconnexion -->
        <div class="flex justify-between m-auto  font-open-sans">

            <a href="./editprofile.php" class="bg-neutral-off-white text-neutral-off-black py-2 px-4 rounded-md m-4">Editer profil</a>
            <a href="../../process/process_deconnexion.php" class="text-neutral-off-white bg-red-600 py-2 px-4 rounded-md m-4">Se déconnecter</a>

        </div>





    </section>


</main>


<?php
require_once "../components/footer.php";
?>