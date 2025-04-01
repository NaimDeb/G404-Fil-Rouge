'use client';

import Image from "next/image";
import { useAuth } from "@/app/context/AuthContext";
import { useState } from "react";
import { AccountForm, UserDetailsForm, ProfessionalDetailsForm } from "@/app/ui/profile/user-forms";

export default function ProfilePage() {
    const { user, logout } = useAuth();  
    const [isEditingDesc, setIsEditingDesc] = useState(false);
    const [profileDesc, setProfileDesc] = useState(user?.profileDesc || "Complétez votre profil avec une petite description !");
    const isProfessional = user?.roles.includes("ROLE_PROFESSIONAL") || false;

    if (!user) return <p>Loading...</p>;

    const handleDescChange = async () => {
        const response = await fetch("/api/update-profile", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ profileDesc }),
        });
        if (response.ok) {
            setIsEditingDesc(false);
        }
    };

    return (
        <main className="bg-primary-beige">
            <section className="w-full min-h-[35vh] bg-primary-green flex flex-col my-8 py-4">
                <Image 
                    src={`/users/${user.image.imgPath || "default.png"}`} 
                    alt="User Profile Picture" 
                    width={100} 
                    height={100} 
                    className="rounded-full m-auto backdrop-brightness-50 my-8"
                />
                <div className="flex flex-col items-center gap-2 mb-4">
                    <p className="text-2xl font-bold text-neutral-off-white font-merriweather">
                        {user.username} {isProfessional && <i title='Professional' className='fas fa-check p-2'></i>}
                    </p>
                    <div className="max-w-[80%] bg-neutral-off-white text-primary-green rounded-lg rounded-tl-none font-open-sans relative">
                        {isEditingDesc ? (
                            <input 
                                type="text" 
                                value={profileDesc} 
                                onChange={(e) => setProfileDesc(e.target.value)}
                                className="font-light py-2 px-4 text-sm w-full"
                            />
                        ) : (
                            <p className="font-light py-2 px-4">{profileDesc}</p>
                        )}
                        <button 
                            onClick={() => isEditingDesc ? handleDescChange() : setIsEditingDesc(true)} 
                            className="bg-neutral-off-white text-primary-green rounded-full p-2 text-sm m-auto absolute bottom-0 right-0"
                        >
                            <i className={isEditingDesc ? "fas fa-check" : "fas fa-pen"}></i>
                        </button>
                    </div>
                </div>
                <div className="flex justify-between m-auto font-open-sans font-semibold">
                    <a href="/profile/edit" className="bg-neutral-off-white text-neutral-off-black py-3 px-4 rounded-md m-4 hover:scale-105 hover:brightness-125">Editer mon profil</a>
                    <button onClick={logout} className="text-neutral-off-white bg-red-600 py-3 px-4 rounded-md m-4 hover:scale-105 hover:brightness-125">Se déconnecter</button>
                </div>
            </section>

            <section className="flex justify-between gap-8 flex-wrap px-8">
                <AccountForm user={user} />
                <UserDetailsForm userDetails={user.userDetails} />
                {isProfessional && <ProfessionalDetailsForm professionalDetails={user.professionalDetails} />}
            </section>
        </main>
    );
}
