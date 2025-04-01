'use client';

import Image from "next/image";
import { useAuth } from "../context/AuthContext";


export default function ProfilePage() {
    const { user, logout } = useAuth();  
    const isProfessional = user?.roles.includes("ROLE_PROFESSIONAL") || false;

    if (!user) return <p>Loading...</p>;

    return (
        <main className="bg-primary-beige">
            {/* Profile Section */}
            <section className="w-full min-h-[35vh] bg-primary-green flex flex-col my-8 py-4">
                {/* Profile Picture */}
                <Image 
                    src={`/users/${user.image.imgPath || "default.png"}`} 
                    alt="User Profile Picture" 
                    width={100} 
                    height={100} 
                    className="rounded-full m-auto backdrop-brightness-50 my-8"
                />
                {/* Name and Description */}
                <div className="flex flex-col items-center gap-2 mb-4">
                    <p className="text-2xl font-bold text-neutral-off-white font-merriweather">
                        {user.username} {isProfessional && <i title='Professional' className='fas fa-check p-2'></i>}
                    </p>
                    <div className="max-w-[80%] bg-neutral-off-white text-primary-green rounded-lg rounded-tl-none font-open-sans">
                        <p className="font-light py-2 px-4">{user.profileDesc || "Complétez votre profil avec une petite description !"}</p>
                    </div>
                </div>
                {/* Edit and Logout Buttons */}
                <div className="flex justify-between m-auto font-open-sans font-semibold">
                    <a href="/profile/edit" className="bg-neutral-off-white text-neutral-off-black py-3 px-4 rounded-md m-4 hover:scale-105 hover:brightness-125">Editer mon profil</a>
                    <a onClick={logout} className="text-neutral-off-white bg-red-600 py-3 px-4 rounded-md m-4 hover:scale-105 hover:brightness-125">Se déconnecter</a>
                </div>
            </section>
            {/* Professional Section */}
            {isProfessional ? (
                <AnnouncementsSection />
            ) : (
                <PurchasesSection />
            )}
        </main>
    );
}

function AnnouncementsSection() {
    return (
        <section className="py-8 px-8">
            <h2 className="font-merriweather text-2xl font-bold mb-4 md:text-3xl">Mes annonces</h2>
            <ScrollableSection />
        </section>
    );
}

function PurchasesSection() {
    return (
        <section className="py-8 px-8">
            <h2 className="font-merriweather text-2xl font-bold mb-4 md:text-3xl">Mes derniers achats</h2>
            <ScrollableSection />
        </section>
    );
}

function ScrollableSection() {
    return (
        <div className="relative">
            <button id="scrollLeft" className="absolute z-10 top-1/2 left-3 transform -translate-y-1/2 bg-primary-green text-neutral-off-white rounded-full py-2 px-4 text-center hover:scale-105 hover:brightness-110">
                <i className="fas fa-chevron-left"></i>
            </button>
            <button id="scrollRight" className="absolute z-10 top-1/2 right-3 transform -translate-y-1/2 bg-primary-green text-neutral-off-white rounded-full py-2 px-4 text-center hover:scale-105 hover:brightness-110">
                <i className="fas fa-chevron-right"></i>
            </button>
            <div className="scroll flex gap-3 flex-nowrap overflow-x-auto snap-mandatory snap-x justify-between scrollbar-hide relative lg:h-[30vh] p-[1vh]">
                {/* Replace with dynamic content */}
                {[...Array(10)].map((_, i) => (
                    <div key={i} className="w-48 h-32 bg-gray-300 rounded-lg"></div>
                ))}
            </div>
        </div>
    );
}
