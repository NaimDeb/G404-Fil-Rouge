<?php

require_once "./components/htmlstart.php";
require_once "./components/header.php";
?>

<main>
    <!-- Hero -->
    <section class="bg-[url(../images/heromobile.png)] lg:bg-[url(../images/heropc.png)] h-[35vh] relative bg-no-repeat bg-cover " alt="Image de couverture du site">

        <div class="h-full p-8 flex flex-col justify-around backdrop-blur-sm w-full lg:p-16">
            <h1 class="text-3xl font-bold text-neutral-off-white font-merriweather drop-shadow-2xl">Revendez vos livres,<br> partagez vos histoire !</h1>

            <button class="bg-primary-green rounded-md max-sm:w-[75%] sm:w-2/5 md:w-64 md:ml-auto text-neutral-off-white text-xl py-2 px-4 text-nowrap font-open-sans font-semibold tracking-wide">
                <a href="./public/inscription.php">
                    Vendez maintenant !
                </a>
            </button>

        </div>



    </section>

    <!-- Section nouveaux produits -->
    <section class="py-8 px-8">
        <h2 class="  font-merriweather text-2xl font-bold mb-4  md:text-3xl">Nouveaux produits</h2>


        <div class="flex gap-8 flex-nowrap h-fit my-16 mx-8">

            <?php
            $annonceRepo = new AnnonceRepository;

            // Todo : dynamic fetching
            $annonces = $annonceRepo->getAnnonces(10);


            foreach ($annonces as $annonce) {

                $annonceId = $annonce->getId();

                $annonceTitle = $annonce->getProduct()->getName();
                $annonceAuthor = $annonce->getProduct()->getAuthor();

                $annoncePrice = $annonce->getPrice();

                $priceEuros =  floor($annoncePrice / 100);
                $priceCents = $annoncePrice % 100;

                $annonceCondition = $annonce->getCondition();
                $annonceImages = $annonce->getImages();

                $product = $annonce->getProduct();
                $annonceUser = $annonce->getUser();

                $productName = $product->getName();
                $productSpecifications = $product->getSpecifications();

                $productOriginalImage = $product->getImage();
                $productAuthor = $product->getAuthor();
                $productType = $product->getType();
                $productGenres = $product->getGenres();

                require "./components/card.php";
            }

            ?>



        </div>

    </section>


</main>


<?php
require_once "./components/footer.php";
?>

</body>

</html>