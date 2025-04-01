import { useState } from 'react';
import Image from 'next/image';

interface RegisterFormProps {
  handleSubmit: (event: React.FormEvent<HTMLFormElement>) => void;
}

export default function RegisterForm({ handleSubmit }: RegisterFormProps) {
  const [isProfessional, setIsProfessional] = useState(false);
  const [errorMessage, setErrorMessage] = useState<string | null>(null);

  const handleError = (errorType: string) => {
    switch (errorType) {
      case 'emptyfield':
        setErrorMessage('Veuillez remplir tous les champs');
        break;
      case 'invalidmail':
        setErrorMessage('Adresse email invalide');
        break;
      case 'invalidphone':
        setErrorMessage('Numéro de téléphone invalide');
        break;
      case 'mailtaken':
        setErrorMessage('Le mail est déjà utilisé');
        break;
      case 'passwordsdontmatch':
        setErrorMessage('Les mots de passe ne correspondent pas');
        break;
      default:
        setErrorMessage('Erreur lors de l\'inscription');
        break;
    }
  };

  const onSubmit = async (event: React.FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    
    try {
      await handleSubmit(event);
    } catch (error: any) {
      // Vous pouvez gérer les erreurs ici
      handleError(error.type || 'default');
    }
  };

  return (
    <div className="flex h-full w-full">
      {/* Left Image */}
      <div className="w-[65%] h-auto relative">
        <Image
          src="/heropc.png"
          alt="Hero background"
          fill
          className="object-cover"
          priority
        />
        <div className="absolute inset-0 backdrop-blur-sm"></div>
      </div>

      {/* Registration Form */}
      <div className="w-[35%] min-h-[90vh] bg-primary-beige flex items-center justify-center px-10 py-8">
        <form onSubmit={onSubmit} className="w-full space-y-6">
          {errorMessage && (
            <div className="w-full bg-red-500 text-white text-center p-2 rounded-md">
              {errorMessage}
            </div>
          )}

          <h2 className="text-2xl font-semibold text-center text-primary-green mb-6">
            Inscription
          </h2>

          {/* Name Fields */}
          <div className="flex flex-col sm:flex-row sm:space-x-4">
            <div className="flex-1 flex flex-col">
              <label htmlFor="firstName" className="text-sm font-semibold text-gray-600">
                Prénom
              </label>
              <input
                type="text"
                id="firstName"
                name="firstName"
                className="border-[2px] border-gray-300 py-2 px-3 rounded-sm mt-2"
                placeholder="Votre prénom"
                required
              />
            </div>
            <div className="flex-1 flex flex-col mt-4 sm:mt-0">
              <label htmlFor="lastName" className="text-sm font-semibold text-gray-600">
                Nom
              </label>
              <input
                type="text"
                id="lastName"
                name="lastName"
                className="border-[2px] border-gray-300 py-2 px-3 rounded-sm mt-2"
                placeholder="Votre nom"
                required
              />
            </div>
          </div>

          {/* Username */}
          <div className="flex flex-col">
            <label htmlFor="username" className="text-sm font-semibold text-gray-600">
              Nom d&apos;utilisateur
            </label>
            <input
              type="text"
              id="username"
              name="username"
              className="border-[2px] border-gray-300 py-2 px-3 rounded-sm mt-2"
              placeholder="Nom d'utilisateur"
              required
            />
          </div>

          {/* Email */}
          <div className="flex flex-col">
            <label htmlFor="user_mail" className="text-sm font-semibold text-gray-600">
              Adresse email
            </label>
            <input
              type="email"
              id="user_mail"
              name="user_mail"
              className="border-[2px] border-gray-300 py-2 px-3 rounded-sm mt-2"
              placeholder="Email"
              required
            />
          </div>

          {/* Password Fields */}
          <div className="flex flex-col sm:flex-row sm:space-x-4">
            <div className="flex-1 flex flex-col">
              <label htmlFor="user_password" className="text-sm font-semibold text-gray-600">
                Mot de passe
              </label>
              <input
                type="password"
                id="user_password"
                name="user_password"
                className="border-[2px] border-gray-300 py-2 px-3 rounded-sm mt-2"
                placeholder="Mot de passe"
                required
              />
            </div>
            <div className="flex-1 flex flex-col mt-4 sm:mt-0">
              <label htmlFor="confirmpassword" className="text-sm font-semibold text-gray-600">
                Confirmer le mot de passe
              </label>
              <input
                type="password"
                id="confirmpassword"
                name="confirmpassword"
                className="border-[2px] border-gray-300 py-2 px-3 rounded-sm mt-2"
                placeholder="Confirmer le mot de passe"
                required
              />
            </div>
          </div>

          {/* Address Fields */}
          <div className="flex flex-col sm:flex-row sm:space-x-4">
            <div className="flex-1 flex flex-col">
              <label htmlFor="pays" className="text-sm font-semibold text-gray-600">
                Pays
              </label>
              <input
                type="text"
                id="pays"
                name="pays"
                className="border-[2px] border-gray-300 py-2 px-3 rounded-sm mt-2"
                placeholder="Votre pays"
                required
              />
            </div>
            <div className="flex-1 flex flex-col mt-4 sm:mt-0">
              <label htmlFor="adresse" className="text-sm font-semibold text-gray-600">
                Adresse
              </label>
              <input
                type="text"
                id="adresse"
                name="adresse"
                className="border-[2px] border-gray-300 py-2 px-3 rounded-sm mt-2"
                placeholder="Votre adresse"
              />
            </div>
          </div>

          {/* Phone */}
          <div className="flex flex-col">
            <label htmlFor="phone" className="text-sm font-semibold text-gray-600">
              Numéro de téléphone
            </label>
            <input
              type="text"
              id="phone"
              name="phone"
              className="border-[2px] border-gray-300 py-2 px-3 rounded-sm mt-2"
              placeholder="Numéro de téléphone"
            />
          </div>

          {/* Professional Checkbox */}
          <div className="flex items-center">
            <input
              type="checkbox"
              id="isProfessional"
              name="isProfessional"
              className="mr-2"
              checked={isProfessional}
              onChange={(e) => setIsProfessional(e.target.checked)}
            />
            <label htmlFor="isProfessional" className="text-sm font-semibold text-gray-600">
              Je suis un professionnel
            </label>
          </div>

          {/* Professional Fields */}
          {isProfessional && (
            <div className="space-y-4">
              <div className="flex flex-col sm:flex-row sm:space-x-4">
                <div className="flex-1 flex flex-col">
                  <label htmlFor="company_name" className="text-sm font-semibold text-gray-600">
                    Nom de l&apos;entreprise
                  </label>
                  <input
                    type="text"
                    id="company_name"
                    name="company_name"
                    className="border-[2px] border-gray-300 py-2 px-3 rounded-sm mt-2"
                    placeholder="Nom de l'entreprise"
                  />
                </div>
                <div className="flex-1 flex flex-col">
                  <label htmlFor="company_address" className="text-sm font-semibold text-gray-600">
                    Adresse de l&apos;entreprise
                  </label>
                  <input
                    type="text"
                    id="company_address"
                    name="company_address"
                    className="border-[2px] border-gray-300 py-2 px-3 rounded-sm mt-2"
                    placeholder="Adresse de l'entreprise"
                  />
                </div>
              </div>

              <div className="flex flex-col">
                <label htmlFor="company_phone" className="text-sm font-semibold text-gray-600">
                  Numéro de téléphone de l&apos;entreprise
                </label>
                <input
                  type="text"
                  id="company_phone"
                  name="company_phone"
                  className="border-[2px] border-gray-300 py-2 px-3 rounded-sm mt-2"
                  placeholder="Numéro de téléphone de l'entreprise"
                />
              </div>

              <p className="text-xs text-gray-500 mt-2">
                Le processus pour être reconnu en tant qu&apos;entreprise peut prendre un certain temps.
              </p>
            </div>
          )}

          <button type="submit" className="w-full bg-primary-green text-white py-3 rounded-md mt-4">
            S&apos;inscrire
          </button>

          <div className="mt-4 text-center">
            <a href="/login" className="text-sm text-primary-green hover:text-gray-600">
              Déjà un compte ? Connectez-vous
            </a>
          </div>
        </form>
      </div>
    </div>
  );
}