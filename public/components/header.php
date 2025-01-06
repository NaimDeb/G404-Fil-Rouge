<header class=" bg-primary-green w-full h-[10vh] flex flex-col p-4 items-center">

    <nav class="flex justify-between w-full h-1/2">
        <!-- Menu Hamburger -->
        <a href=""> <i class="fas fa-bars text-neutral-off-white text-2xl px-2"></i> </a>

        <!-- Logo -->
        <a href="#" class="max-h-full w-1/2">
            <img src="<?= $root_path ?>/assets/src/images/Logo.svg" alt="Logo Bookmarket" class="object-scale-down max-h-full">
        </a>

        <!-- User -->
        <a href=""> <i class="fas fa-user text-neutral-off-white text-2xl px-2"></i> </a>

    </nav>

        <!-- Searchbar -->
        <div id="searchbar" class="bg-neutral-off-white py-2 px-4 w-full rounded-sm flex-nowrap justify-between">

            <select name="searchChoice" id="search-choice" class="bg-neutral-off-white w-1/5 truncate text-sm font-bold">
            <option value="all">Tous</option>
            <option value="book">Livres</option>
            <option value="author">Auteurs</option>
            <option value="user">Utilisateurs</option>
            </select>

            <input
                type="text"
                onkeyup="showResult(this.value)"
                placeholder="Vous cherchez un livre ? Recherchez ici..."
                class=" text-neutral-off-black sm:flex-1 focus:outline-none">
            <i class="fas fa-magnifying-glass text-neutral-white"></i>

            <!-- Live Search Results -->
            <div class="livesearch absolute top-full left-0 mt-2 w-full bg-neutral-off-black shadow-lg p-4 space-y-4 hidden">
            </div>

        </div>


        <!-- Se connecter div -->

    


    <!-- lg+ genres nav -->
    <!-- Separateur -->
    <div></div>



    <nav>
        <!-- Nouveautés, classiques etc -->
    </nav>

</header>