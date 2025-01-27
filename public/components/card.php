<!-- Card -->
<article class="w-[180px] h-[180px]">
    <a href="./article.php?id=<?php echo $annonceId; ?>" class="group w-full h-full">
        <div class="relative w-full h-full border-gray-400 border-[1px] flex items-center justify-center">
            <img src="./assets/images/products/<?php echo $productOriginalImage->getImgPath(); ?>" alt="Image de livre" class="object-contain max-w-full max-h-full">
        </div>

        <div class="flex flex-col mt-2">
            <h3 class="font-merriweather font-bold truncate text-lg"><?php echo $annonceTitle; ?></h3>

            <div class="flex justify-between w-full">
                <div class="text-sm font-open-sans text-gray-500">
                    <p><?php echo $annonceAuthor->getName(); ?></p>
                    <p><?php echo $annonceCondition; ?></p>
                </div>

                <p class="font-xl font-merriweather font-bold"><?php echo $priceEuros; ?>,<?php echo str_pad($priceCents, 2, '0', STR_PAD_LEFT); ?>€</p>
            </div>
        </div>
    </a>
</article>