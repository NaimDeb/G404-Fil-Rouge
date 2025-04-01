'use client';
import { User } from "@/app/lib/auth";
import FormInput from "../components/formInput";



export function AccountForm({ user }: { user: User }) {
    return (
        <form method="POST" action="/api/updateAccount" className="border-gray-400 border-2 shadow-sm w-full max-w-lg mx-auto bg-neutral-off-white p-8 rounded-lg mb-8">
            <p className="text-xl font-bold font-merriweather text-primary-green mb-4">Informations de compte</p>
            <FormInput 
                name="username"
                label="Nom d&apos;utilisateur"
                type="text"
                defaultValue={user.username}
            />
            <FormInput 
                name="user_mail"
                label="Email"
                type="email"
                defaultValue={user.email}
            />
            <div className="flex justify-end">
                <button className="px-4 py-2 bg-primary-green text-neutral-off-white font-semibold rounded-md hover:brightness-110" type="submit">Confirmer les changements</button>
            </div>
        </form>
    );
}

export function UserDetailsForm({ userDetails } : { userDetails: User["userDetails"] }) {
    return (
        <form method="POST" action="/api/updatePersonalDetails" className="border-gray-400 border-2 shadow-sm w-full max-w-lg mx-auto bg-neutral-off-white p-8 rounded-lg mb-8">
            <p className="text-xl font-bold font-merriweather text-primary-green mb-4">Informations personnelles</p>
            <FormInput 
                name="firstName"
                label="Prénom"
                type="text"
                defaultValue={userDetails.firstName}
            />
            <FormInput 
                name="lastName"
                label="Nom"
                type="text"
                defaultValue={userDetails.lastName}
            />
            <FormInput 
                name="address"
                label="Adresse"
                type="text"
                defaultValue={userDetails.address}
            />
            <FormInput 
                name="phone"
                label="Numéro de téléphone"
                type="text"
                defaultValue={userDetails.phone}
            />
            <FormInput 
                name="country"
                label="Pays"
                type="text"
                defaultValue={userDetails.country}
            />
            
            <div className="flex justify-end">
                <button className="px-4 py-2 bg-primary-green text-neutral-off-white font-semibold rounded-md hover:brightness-110" type="submit">Confirmer les changements</button>
            </div>
        </form>
    );
}

export function ProfessionalDetailsForm({ professionalDetails }: { professionalDetails: User["professionalDetails"] }) {
    if (!professionalDetails) return null;

    return (
        <form method="POST" action="/api/updateProfessionalDetails" className="border-gray-400 border-2 shadow-sm w-full max-w-lg mx-auto bg-neutral-off-white p-8 rounded-lg mb-8">
            <p className="text-xl font-bold font-merriweather text-primary-green mb-4">Informations d&apos;entreprise</p>
            <FormInput 
                name="company_name"
                label="Nom de l&apos;entreprise"
                type="text"
                defaultValue={professionalDetails.companyName}
            />
            <FormInput 
                name="company_address"
                label="Adresse de l&apos;entreprise"
                type="text"
                defaultValue={professionalDetails.companyAddress}
            />
            <FormInput 
                name="company_phone"
                label="Numéro de téléphone de l&apos;entreprise"
                type="text"
                defaultValue={professionalDetails.companyPhone}
            />
            
            <div className="flex justify-end">
                <button className="px-4 py-2 bg-primary-green text-neutral-off-white font-semibold rounded-md hover:brightness-110" type="submit">Confirmer les changements</button>
            </div>
        </form>
    );
}
