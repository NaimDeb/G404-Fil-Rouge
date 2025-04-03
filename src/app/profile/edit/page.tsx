"use client";

import { useAuth } from "@/app/context/AuthContext";
import {
  AccountForm,
  UserDetailsForm,
  ProfessionalDetailsForm,
} from "@/app/ui/profile/user-forms";

export default function ProfilePage() {
  const { user, isProfessional } = useAuth();


  if (!user) return <p>Loading...</p>;



  return (
    <section className="flex justify-between gap-8 flex-wrap px-8">
      <AccountForm user={user} />
      <UserDetailsForm userDetails={user.userDetails} />
      {isProfessional && (
        <ProfessionalDetailsForm
          professionalDetails={user.professionalDetails}
        />
      )}
    </section>
  );
}
