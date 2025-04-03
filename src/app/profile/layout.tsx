"use client";
import Image from "next/image";
import { useAuth } from "../context/AuthContext";
import { useState } from "react";

// export const experimental_ppr = true;

export default function Layout({ children }: { children: React.ReactNode }) {
  const { user, logout } = useAuth();
  const isProfessional = user?.roles.includes("ROLE_PROFESSIONAL") || false;
  const [isEditing, setIsEditing] = useState(false);
  const [isEditingDesc, setIsEditingDesc] = useState(false);
  const [profileDesc, setProfileDesc] = useState(
    user?.profileDesc || "Complétez votre profil avec une petite description !"
  );


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
            {user.username}{" "}
            {isProfessional && (
              <i title="Professional" className="fas fa-check p-2"></i>
            )}
          </p>
          <div className="max-w-[80%] bg-neutral-off-white text-primary-green rounded-lg rounded-tl-none font-open-sans">
            <p className="font-light py-2 px-4">
              {user.profileDesc ||
                "Complétez votre profil avec une petite description !"}
            </p>
          </div>
        </div>
        {/* Edit and Logout Buttons */}
        <div className="flex justify-between m-auto font-open-sans font-semibold">
            {!isEditing && (
                <>
          <a
            href="/profile/edit"
            className="bg-neutral-off-white text-neutral-off-black py-3 px-4 rounded-md m-4 hover:scale-105 hover:brightness-125"
          >
            Editer mon profil
          </a>
          <a
            onClick={logout}
            className="text-neutral-off-white bg-red-600 py-3 px-4 rounded-md m-4 hover:scale-105 hover:brightness-125"
          >
            Se déconnecter
          </a>
          </>

            ) }
        </div>
      </section>

      <section>{children}</section>
    </main>
  );
}
