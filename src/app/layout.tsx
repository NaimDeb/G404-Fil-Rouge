import "./globals.css";
import type { Metadata } from "next";
import { merriweather } from "@/app/ui/fonts";
import Header from "./ui/layout/header";
import Footer from "./ui/layout/footer";


export const metadata: Metadata = {
  title: "BookMarket - Votre bibliothèque en ligne",
  description: "Parcourez, achetez et gérez vos livres préférés",
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en">
      <body
        className={`${merriweather.className} antialiased !bg-primary-beige`}
        >
        <Header/>
        {children}
        <Footer/>
      </body>
    </html>
  );
}
