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
    <div id="searchbar" class="bg-neutral-off-white py-2 px-4 w-full rounded-sm flex flex-nowrap items-center justify-between gap-2">

        <!-- Dropdown et séparateur -->
        <div class="flex items-center basis-1/5">
        <label for="search-choice" class="sr-only" >Type de recherche</label>
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
            aria-live="polite"
        >
            

        <!-- Icône de recherche -->
        <i class="fas fa-magnifying-glass text-xl basis-auto" aria-label="Lancer la recherche"></i>
    </div>


    <!-- lg+ genres nav -->
    <!-- Separateur -->
    <div></div>



    <nav>
        <!-- Nouveautés, classiques etc -->
    </nav>

</header>


<!-- 
SQL:





-->