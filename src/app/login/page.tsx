 'use client';

import LoginForm from '../ui/login-form';
import { FormEvent, useState } from 'react';
import { useRouter } from 'next/navigation';
import { login } from '../lib/auth';
 
export default function LoginPage() {

    const router = useRouter();

    const [error, setError] = useState<string | null>(null);

    const handleSubmit = async (event: FormEvent<HTMLFormElement>) => {
        
        event.preventDefault();

        const formData = new FormData(event.currentTarget);
        
        const email = formData.get('email') as string;
        const password = formData.get('password') as string;

        const response = await login(email, password);


        if (response?.token) {
            localStorage.setItem('token', response.token);
            router.push('/'); // Redirect to the homepage after successful login
        }
        else {
            // Handle login error (e.g., show a message to the user)
            console.log("Response : " + response);
            
            setError('Invalid email or password. Please try again.');
            
            router.refresh();


        }


    }



  return (
    <main className="flex items-center justify-center md:h-screen">
      <LoginForm handleSubmit={handleSubmit} errorMessage={error}/>
    </main>
  );
}