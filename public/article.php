<?php
require_once "../utils/autoloader.php";
require_once "./components/htmlstart.php";
require_once "./components/header.php";


if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    // header('location: ../index.php');
    die();
}

$annonceId = $_GET['id'];

$annonceRepo = new AnnonceRepository;

$annonce = $annonceRepo->fetchAnnonceById($annonceId);

if(!$annonce){
    // header('location: ../index.php');
    die();
}

// Todo : Do the whole annonce thing

// ! header don't seem to work : Warning: Cannot modify header information - headers already sent by (output started at C:\wamp64\www\Projets\BookMarket\public\components\header.php:84) in C:\wamp64\www\Projets\BookMarket\public\article.php on line 10


var_dump($annonce);

$annonceTitle = $annonce->getProduct()->getName();
$annonceAuthor = $annonce->getProduct()->getAuthor();
$annoncePrice = $annonce->getPrice();
$annonceCondition = $annonce->getCondition();
$annonceImages = $annonce->getImages();


?>

<main>

    <section class="p-8 flex flex-col gap-2 lg:px-16 lg:justify-center text-neutral-off-black">
        <div class="flex flex-col sm:flex-row gap-4 lg:justify-center">
            <!-- Todo : Carousel -->
            <div class="bg-neutral-off-white w-full h-[80vw] sm:w-[40vw] sm:h-[40vw] lg:w-[500px] lg:h-[500px] py-4 outline outline-1 outline-gray-600 flex items-center justify-center max-md:basis-1/2 ">
                <img src="./assets/images/bookrandom.png" alt="Image de livre" class="object-contain h-full">
            </div>
            <!-- Link to -->

            <div class="sm:flex sm:flex-col lg:justify-between lg:w-[500px] lg:h-[500px] gap-4">
                <p class="text-lg text-gray-500"> <a href="">Romans</a> > <a href="">Romans policiers</a> </p>
                <!-- Infos livre -->
                <div class="flex justify-between">
                    <div class="flex-col">
                        <h2 class="text-3xl font-merriweather font-bold"> Titre long Titre long Titre long</h2>
                        <h4 class="text-md"> Par auteur auteur auteurauteur auteur auteur</h4>
                        <h4 class="text-md text-opacity-50 text-neutral-off-black"> Etat : <span class="font-bold"> AAAAAAAAA</span></h4>
                    </div>
                    <!-- Prix -->
                    <label for="price" class="text-nowrap">
                        <span class="text-3xl font-merriweather font-bold">99,</span>
                        <span class="text-sm font-bold">99</span>
                        <span class="text-3xl font-bold font-merriweather ">€</span>
                    </label>
                </div>

                <!-- Description -->
                <section class="hidden lg:inline flex-col gap-8">
                    <h3 class="text-2xl font-merriweather font-bold">Description</h3>
                    <p class="text-lg"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae cumque aliquid ea nesciunt corporis alias quod saepe, qui voluptatum labore vel fugiat. Reprehenderit labore commodi veniam molestiae accusantium minus iste.</p>
                </section>

                <!-- Bouton achat -->
                <button class="bg-primary-green text-neutral-off-white font-merriweather text-3xl rounded-lg px-4 text-center py-2 w-full my-6 hidden lg:block hover: hover:-translate-y-[2px] transition-all hover:brightness-110">Acheter</button>

            </div>

        </div>

        <!-- Bouton achat -->
        <button class="bg-primary-green text-neutral-off-white font-merriweather text-3xl rounded-lg px-4 text-center py-2 w-full my-6 lg:hidden hover: hover:-translate-y-[2px] transition-all hover:brightness-110">Acheter</button>
    </section>

    <!-- Description -->
    <section class="p-8 lg:hidden text-neutral-off-black">
        <h3 class="text-2xl font-merriweather font-bold">Description</h3>
        <p class="text-lg"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae cumque aliquid ea nesciunt corporis alias quod saepe, qui voluptatum labore vel fugiat. Reprehenderit labore commodi veniam molestiae accusantium minus iste.</p>
    </section>

    <!-- Par le même auteur -->
    <section class="px-8 py-8 lg:px-16 xl:px-64 text-neutral-off-black">
        <h3 class="text-2xl font-merriweather font-bold">Par le même auteur</h3>
        <div class="flex gap-4">
            <!-- Article -->
            <div class="bg-neutral"></div>
        </div>
    </section>




</main>

<?php
require_once "./components/footer.php";
?>

</body>

</html>