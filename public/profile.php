<?php
require_once "./components/htmlstart.php";
require_once "./components/header.php";


if (!isset($_SESSION["user"])) {
    header("location: ./home.php");
    die();
}


$isProfessional = false;

if ($_SESSION["professionalDetails"] !== null) {
    $isProfessional = true;
}

$username = $user->getUserName();
$user_image = $user->getImage();
$user_desc = $user->getProfile_description();


// Si la description est null, on affiche un message par défaut
if ($user_desc == null) {
    $user_desc = "Complétez votre profil avec une petite description !";
};




?>


<main class="bg-primary-beige">
    <!-- Section profil -->
    <section class="w-full min-h-[35vh]  bg-primary-green flex flex-col my-8 py-4">

        <!-- Profile pic -->

        <img src="./assets/images/users/<?php echo $user_image->getImgPath() ?>" alt="Photo de l'utilisateur" class="w-[100px] h-[100px] rounded-full m-auto backdrop-brightness-50 my-8">

        <!-- Nom et description -->
        <div class="flex flex-col items-center gap-2 mb-4">
            <p class="text-2xl font-bold  text-neutral-off-white  font-merriweather"> 
                <?php 
                echo $username; 
                if ($isProfessional === true) {
                    echo "<i title='Professionel' class='fas fa-check p-2'></i>";}
                ?> </p>
            <div class="max-w-[80%]  bg-neutral-off-white text-primary-green rounded-lg rounded-tl-none font-open-sans">
                <!-- Desc -->
                <p class="font-light py-2 px-4"> <?= $user_desc ?> </p>
            </div>
        </div>

        <!-- Boutons editer profil et deconnexion -->
        <div class="flex justify-between m-auto  font-open-sans font-semibold">

            <a href="./manageprofile.php" class="bg-neutral-off-white text-neutral-off-black py-3 px-4 rounded-md m-4 hover:scale-105 hover:brightness-125">Editer mon profil</a>
            <a href="../process/process_deconnexion.php" class="text-neutral-off-white bg-red-600 py-3 px-4 rounded-md m-4 hover:scale-105 hover:brightness-125">Se déconnecter</a>

        </div>





    </section>

<?php if ($isProfessional == true): ?>
    <!-- Section Mes annonces, seulement pour les pros -->
    <section class="py-8 px-8">
        <h2 class="font-merriweather text-2xl font-bold mb-4 md:text-3xl">Mes annonces</h2>

        <div class="relative">
            <!-- Boutons gauche et droite -->
            <button id="scrollLeftNewProducts" class="absolute z-10 top-1/2 left-3 transform -translate-y-1/2 bg-primary-green text-neutral-off-white rounded-full py-2 px-4 text-center hover:scale-105 hover:brightness-110">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button id="scrollRightNewProducts" class="absolute z-10 top-1/2 right-3 transform -translate-y-1/2 bg-primary-green text-neutral-off-white rounded-full py-2 px-4 text-center hover:scale-105 hover:brightness-110">
                <i class="fas fa-chevron-right"></i>
            </button>

            <!-- CARDS -->
            <div class="scroll flex gap-3 flex-nowrap overflow-x-auto snap-mandatory snap-x justify-between scrollbar-hide relative lg:h-|30vh] p-[1vh]">
                <?php
                    for ($i=0; $i < 10; $i++) { 
                        require "./components/testcard.php";
                    }
                ?>
            </div>
        </div>
    </section>
    <?php else: ?>
    <!-- Section Mes derniers achats, seulement pour les user -->
    <section class="py-8 px-8">
        <h2 class="font-merriweather text-2xl font-bold mb-4 md:text-3xl">Mes derniers achats</h2>

        <div class="relative">
            <!-- Boutons gauche et droite -->
            <button id="scrollLeftNewProducts" class="absolute z-10 top-1/2 left-3 transform -translate-y-1/2 bg-primary-green text-neutral-off-white rounded-full py-2 px-4 text-center hover:scale-105 hover:brightness-110">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button id="scrollRightNewProducts" class="absolute z-10 top-1/2 right-3 transform -translate-y-1/2 bg-primary-green text-neutral-off-white rounded-full py-2 px-4 text-center hover:scale-105 hover:brightness-110">
                <i class="fas fa-chevron-right"></i>
            </button>

            <!-- CARDS -->
            <div class="scroll flex gap-3 flex-nowrap overflow-x-auto snap-mandatory snap-x justify-between scrollbar-hide relative lg:h-|30vh] p-[1vh]">
                <?php
                    for ($i=0; $i < 10; $i++) { 
                        require "./components/testcard.php";
                    }
                ?>
            </div>
        </div>
    </section>
<?php endif; ?>


</main>


<?php
require_once "./components/footer.php";
?>

<!-- TODO : only seems to work once -->
<script>
    // Add smooth scrolling
    document.querySelector(".scroll").style.scrollBehavior = "smooth";

    // Get the width of the first article and scrolls by half of it
    

    document.querySelector("#scrollRightNewProducts").addEventListener("click", () => {
        let articleWidth = document.querySelector(".scroll article").getBoundingClientRect().width;
        document.querySelector(".scroll").scrollBy(articleWidth / 2, 0);
    });

    document.querySelector("#scrollLeftNewProducts").addEventListener("click", () => {
        let articleWidth = document.querySelector(".scroll article").getBoundingClientRect().width;
        document.querySelector(".scroll").scrollBy(-articleWidth / 2, 0);
    });
</script>
