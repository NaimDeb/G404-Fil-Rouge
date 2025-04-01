import Image from 'next/image';
import Link from 'next/link';


interface LoginFormProps {
  handleSubmit: (event: React.FormEvent<HTMLFormElement>) => void;
  errorMessage: string | null;
}

export default function LoginForm({ handleSubmit, errorMessage }: LoginFormProps) {
//   const searchParams = useSearchParams();
//   const callbackUrl = searchParams.get('callbackUrl') || '/dashboard';
// const [errorMessage, formAction, isPending] = useActionState(
//     undefined,
//   );
  return (
<div className="flex h-full w-full">
     {/* Image de gauche  */}
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

     {/* Formulaire de connexion   */}
    <div className="w-[35%] h-[90vh] bg-primary-beige flex items-center justify-center px-24 py-4">



        <form onSubmit={handleSubmit} className="w-full space-y-4">


        {errorMessage && <div className="w-full bg-red-500 text-white text-center p-2 rounded-md">{errorMessage}</div>}

            <h2 className="text-xl font-semibold text-center text-primary-green mb-4">Se connecter</h2>

            <div className="flex flex-col">
                <label htmlFor="email" className="text-sm font-semibold text-gray-600">Adresse email</label>
                <input type="text" id="email" name="email" className="border border-gray-300 p-3 rounded-md mt-2" placeholder="Email" required/>
            </div>

            <div className="flex flex-col">
                <label htmlFor="password" className="text-sm font-semibold text-gray-600">Mot de passe</label>
                <input type="password" id="password" name="password" className="border border-gray-300 p-3 rounded-md mt-2" placeholder="Mot de passe" required/>
            </div>

            <button type="submit" className="w-full bg-primary-green text-white py-2 rounded-md mt-4">Se connecter</button>

            <div className="mt-4 text-center flex flex-col gap-2">
                <a href="#" className="text-sm text-gray-600 hover:text-gray-700">Mot de passe oublié ?</a>
                <Link href='/register' key='register' >
                <button className="cursor-pointer text-sm text-primary-green hover:text-gray-600">C&apos;est votre première fois ? Inscrivez vous</button>
                </Link>
            </div>
        </form>
    </div>
</div>
  );
}
