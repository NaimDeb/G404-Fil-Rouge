import Image from "next/image";
import Link from "next/link";
import NewProductsSection from "./ui/NewProductsSection";


export default function Home() {
  return (
    <div className="min-h-screen">
      <main>
        {/* Hero Section */}
        <section className="relative h-[35vh]">
          <Image
            src="/heromobile.png"
            alt="Hero background mobile"
            fill
            priority
            className="object-cover hidden max-lg:block"
          />
          <Image
            src="/heropc.png"
            alt="Hero background desktop"
            fill
            priority
            className="object-cover hidden lg:block"
          />
          <div className="relative h-full p-8 flex flex-col justify-around backdrop-blur-sm w-full lg:p-16">
              <h1 className="text-3xl font-bold text-neutral-off-white font-merriweather drop-shadow-2xl">
                Revendez vos livres,
                <br /> partagez vos histoire !
              </h1>

              <Link
                href="/inscription"
                className="bg-primary-green rounded-md max-sm:w-[75%] sm:w-2/5 md:w-64 md:ml-auto text-neutral-off-white text-xl py-2 px-4 text-nowrap font-open-sans font-semibold tracking-wide text-center"
              >
                Vendez maintenant !
              </Link>
            </div>
        </section>

        <NewProductsSection />
      </main>
    </div>
  );
}
