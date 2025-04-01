"use client";

import Image from "next/image";
import Link from "next/link";
import { useAuth } from "@/app/context/AuthContext";

export default function Header() {
  const { isAuthenticated, user, logout } = useAuth();  
  

  return (
    <header className="bg-primary-green w-full h-[11vh] md:h-fit flex flex-col py-4 px-4 md:px-8">
      <div className="md:h-full flex flex-col md:flex-row md:items-center md:justify-between">
        {/* Première ligne  */}
        <div className="h-full flex flex-row items-center justify-between max-md:w-full">
          {/* Menu Hamburger  */}
          <a
            href="#"
            className="md:hidden text-neutral-off-white text-2xl px-2"
          >
            <i className="fas fa-bars"></i>
          </a>

          {/* Logo  */}
          <button className="w-[100%] md:order-1 mx-auto md:px-2">
            <Link href="/" key="home">
              <Image
                src="/Logo.svg"
                width={192}
                height={48}
                alt="Logo Bookmarket"
                className="object-scale-down max-h-12 mx-auto sm:mx-0"
              />
            </Link>
          </button>

          {/* User sm et moins  */}
          {isAuthenticated ? (
            <a
              href="./profile.php"
              className="flex gap-2 text-neutral-off-white text-2xl px-2 sm:order-3 md:hidden cursor-pointer items-center"
            >
              <span className="text-sm text-nowrap self-end ml-2">
                {user?.username}
              </span>

              <Image
                src={"/users/" + (user?.image.imgPath || "default.png")}
                alt="User Image"
                width={32}
                height={32}
                className="rounded-full h-8 w-8"
              />
            </a>
          ) : (
            <Link
              href="/login"
              className="sm:inline-flex text-neutral-off-white text-2xl px-2 sm:order-3 md:hidden cursor-pointer items-center"
            >
              <i className="fas fa-user"></i>
            </Link>
          )}
        </div>

        {/* Searchbar */}
        <div
          id="searchbar"
          className="bg-neutral-off-white py-2 px-4 w-full rounded-sm flex items-center justify-between gap-2 md:order-2 md:w-[3/5]"
        >
          {/* Dropdown et séparateur */}
          <div className="flex items-center basis-1/5">
            <label htmlFor="search-choice" className="sr-only">
              Type de recherche
            </label>
            <select
              name="searchChoice"
              id="search-choice"
              className="bg-neutral-off-white truncate text-sm font-bold w-full"
              aria-label="Choisissez le type de recherche"
            >
              <option value="all">Tous</option>
              <option value="book">Livres</option>
              <option value="author">Auteurs</option>
              <option value="user">Utilisateurs</option>
            </select>
            {/* Séparateur */}
            <div
              className="w-[1px] h-4 mx-2 bg-neutral-off-black"
              aria-hidden="true"
            ></div>
          </div>

          {/* Champ de recherche */}
          <label htmlFor="search-input" className="sr-only">
            Rechercher un livre
          </label>
          <input
            type="text"
            // onKeyUp={showResult(this.value)}
            placeholder="Vous cherchez un livre ? Recherchez ici..."
            className="text-neutral-off-black focus:outline-none basis-3/5 w-full truncate"
            aria-label="Rechercher un livre ou un utilisateur"
            aria-live="polite"
          />

          {/* Icône de recherche */}
          <i
            className="fas fa-magnifying-glass text-xl basis-auto"
            aria-label="Lancer la recherche"
          ></i>
        </div>

        {/* User (md+) */}
        {isAuthenticated ? (
          <div className="md:inline-flex text-neutral-off-white text-2xl px-2 sm:order-3 hidden items-center">
            <Image
              src={"/users/" + (user?.image.imgPath || "default.png")}
              alt="User Image"
              width={32}
              height={32}
              className="rounded-full h-8 w-8"
            />
            <span className="text-sm text-nowrap self-end mr-2">
              {user?.username}
            </span>
            <button onClick={logout} className="ml-2">
              <i className="fas fa-sign-out-alt"></i>
            </button>
          </div>
        ) : (
          <button className="md:inline-flex text-neutral-off-white text-2xl px-2 sm:order-3 hidden items-center">
            <Link href="/login">
              <span className="text-sm text-nowrap self-end mr-2">
                Se connecter
              </span>
            </Link>
            <i className="fas fa-user"></i>
          </button>
        )}
      </div>

      {/* Deuxième ligne (Navigation supplémentaire) */}
      <nav className="hidden md:flex w-full justify-between items-center mt-4 font-merriweather">
        {/* Liens principaux */}
        <div className="flex space-x-8 text-white font-bold basis-2/3 justify-between text-nowrap">
          <a href="./new.php" className="hover:underline">
            Nouveautés
          </a>
          <a href="./classics.php" className="hover:underline">
            Classiques incontournables
          </a>
          <a href="./cheap.php" className="hover:underline">
            Petits prix
          </a>
          <a href="./youth.php" className="hover:underline">
            Jeunesse
          </a>
        </div>

        {/* Bouton Vendre un livre */}
        <a
          href="./sell.php"
          className="bg-transparent border-2 border-white text-white px-6 py-2 rounded-full hover:bg-white hover:text-primary-green transition"
        >
          Vendre un livre
        </a>
      </nav>
    </header>
  );
}
