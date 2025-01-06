

<?php 

require_once "./public/components/htmlstart.php";
require_once "./public/components/header.php";
?>

<main>

<!-- Hero -->
<section class="bg-[url(../src/images/heromobile.png)] h-[35vh] relative" alt="Image de couverture du site">

<div class="w-fit h-fit p-8 flex flex-col gap-16">
    <h1 class="text-2xl font-bold text-neutral-off-white ">Revendez vos livres, partagez vos histoire !</h1>

    <button class="bg-primary-green rounded-md w-[75%] text-neutral-off-white text-xl py-2 px-4 text-nowrap">
        <a href="./public/pages/inscription.php">
            Vendez maintenant !
        </a>
    </button>

</div>



</section>


</main>


<?php 
require_once "./public/components/footer.php";
?>

</body>
</html>