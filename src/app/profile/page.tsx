'use client';

import { useAuth } from "../context/AuthContext";


export default function ProfilePage() {
    const { user, isProfessional } = useAuth();

    if (!user) return <p>Loading...</p>;

    return (
        <div className="flex flex-col gap-12">
            {user && (
                isProfessional ? (
                    <AnnouncementsSection />
                ) : (
                    <PurchasesSection />
                )
            )}
        </div>
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
