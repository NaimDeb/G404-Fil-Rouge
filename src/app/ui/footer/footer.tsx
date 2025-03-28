import Image from "next/image";

export default function Footer() {
    return (
<footer className="w-full bg-primary-green py-4 px-8">


     
    <div className="flex flex-col md:flex-row justify-between items-center space-y-6 md:space-y-0 text-neutral-off-white">
    
    {/* Logo  */}
    <a href="#" className="max-h-full md:w-auto">
        <Image src="./assets/images/Logo.svg" alt="Logo Bookmarket" className="object-scale-down max-h-full"/>
    </a>

     {/* Liens principaux  */}
    <div className="flex flex-col sm:flex-row space-y-6 sm:space-y-0">
        
         {/* Deuxième colonne de liens  */}
        <div className="flex flex-col space-y-4 text-center sm:text-left">
            <a href="/terms" className="hover:text-gray-300">Termes & Conditions</a>
            <a href="/privacy" className="hover:text-gray-300">Mentions légales</a>
            <a href="/services" className="hover:text-gray-300">Services</a>
            <a href="/returns" className="hover:text-gray-300">Informations de livraison</a>
            <a href="/shipping" className="hover:text-gray-300">Politique de confidentialité</a>
        </div>
    </div>

     {/* Icônes sociales  */}
    <div className="flex space-x-6 items-center justify-center">
        <a href="https://www.facebook.com" target="_blank" className="hover:text-gray-300">
            <i className="fas fa-facebook"></i>
        </a>
        <a href="https://www.youtube.com" target="_blank" className="hover:text-gray-300">
        <i className="fas fa-youtube"></i>
        </a>
        <a href="https://twitter.com" target="_blank" className="hover:text-gray-300">
        <i className="fas fa-twitter"></i>
        </a>
        <a href="https://www.instagram.com" target="_blank" className="hover:text-gray-300">
        <i className="fas fa-instagram"></i>
        </a>
    </div>

    </div>




</footer>
);
}