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
        <h2 class="  font-merriweather text-2xl font-bold mb-4 md:text-3xl">Nouveaux produits</h2>


        <div class="flex gap-3 flex-wrap justify-between">

            <!-- Card -->
            <article class="basis-[45%] md:basis-[30%] lg:basis-[20%] ">
                <a href="./pages/article.php?id=1" class="group w-21">
                    <div class="max-w-[40vw] border-gray-400 border-[1px]  items-center">
                        <img src="./assets/images/bookrandom.png" alt="" class="m-auto object-scale-down">
                    </div>

                    <div class="flex flex-col">
                        <h3 class="font-merriweather font-bold truncate text-lg">TITRE DU LIVRE</h3>

                        <div class="flex justify-between w-fit">
                            <div class="text-sm font-open-sans text-gray-500">
                                <p>AUTEUR</p>
                                <p>ETAT ETAT</p>
                            </div>
                            <p class="font-xl font-merriweather font-bold">99,99€</p>
                        </div>
                    </div>
                </a>
            </article>
            <!-- Card -->
            <article class="basis-[45%] md:basis-[30%] lg:basis-[20%] ">
                <a href="./pages/article.php?id=1" class="group w-21">
                    <div class="max-w-[40vw] border-gray-400 border-[1px]  items-center">
                        <img src="./assets/images/bookrandom.png" alt="" class="m-auto object-scale-down">
                    </div>

                    <div class="flex flex-col">
                        <h3 class="font-merriweather font-bold truncate text-lg">TITRE DU LIVRE</h3>

                        <div class="flex justify-between w-fit">
                            <div class="text-sm font-open-sans text-gray-500">
                                <p>AUTEUR</p>
                                <p>ETAT ETAT</p>
                            </div>
                            <p class="font-xl font-merriweather font-bold">99,99€</p>
                        </div>
                    </div>
                </a>
            </article>
            <!-- Card -->
            <article class="basis-[45%] md:basis-[30%] lg:basis-[20%] ">
                <a href="./pages/article.php?id=1" class="group w-21">
                    <div class="max-w-[40vw] border-gray-400 border-[1px]  items-center">
                        <img src="./assets/images/bookrandom.png" alt="" class="m-auto object-scale-down">
                    </div>

                    <div class="flex flex-col">
                        <h3 class="font-merriweather font-bold truncate text-lg">TITRE DU LIVRE</h3>

                        <div class="flex justify-between w-fit">
                            <div class="text-sm font-open-sans text-gray-500">
                                <p>AUTEUR</p>
                                <p>ETAT ETAT</p>
                            </div>
                            <p class="font-xl font-merriweather font-bold">99,99€</p>
                        </div>
                    </div>
                </a>
            </article>
            <!-- Card -->
            <article class="basis-[45%] md:basis-[30%] lg:basis-[20%] ">
                <a href="./pages/article.php?id=1" class="group w-21">
                    <div class="max-w-[40vw] border-gray-400 border-[1px]  items-center">
                        <img src="./assets/images/bookrandom.png" alt="" class="m-auto object-scale-down">
                    </div>

                    <div class="flex flex-col">
                        <h3 class="font-merriweather font-bold truncate text-lg">TITRE DU LIVRE</h3>

                        <div class="flex justify-between w-fit">
                            <div class="text-sm font-open-sans text-gray-500">
                                <p>AUTEUR</p>
                                <p>ETAT ETAT</p>
                            </div>
                            <p class="font-xl font-merriweather font-bold">99,99€</p>
                        </div>
                    </div>
                </a>
            </article>
 
           

        </div>

    </section>


</main>


<?php
require_once "./components/footer.php";
?>

</body>

</html>