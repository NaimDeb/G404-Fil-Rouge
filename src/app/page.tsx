import Image from "next/image";
import Link from "next/link";

// Mock data for products (replace with actual data fetching later)
const mockProducts = [
  {
    id: 1,
    title: "Sample Book 1",
    author: "Author 1",
    price: 1299,
    condition: "Good",
    image: "/books/sample1.jpg",
  },
  // Add more mock products as needed
];

export default function Home() {
  return (
    <div className="min-h-screen">
      <main>
        {/* Hero Section */}
        <section className="relative h-[35vh] bg-[url('/images/heromobile.png')] lg:bg-[url('/images/heropc.png')] bg-no-repeat bg-cover">
          <div className="h-full p-8 flex flex-col justify-around backdrop-blur-sm w-full lg:p-16">
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

        {/* New Products Section */}
        <section className="py-8 px-8">
          <h2 className="font-merriweather text-2xl font-bold mb-4 md:text-3xl">
            Nouveaux produits
          </h2>

          <div className="flex gap-8 flex-nowrap h-fit my-16 mx-8 overflow-x-auto">
            {mockProducts.map((product) => (
              <div key={product.id} className="min-w-[200px] flex-shrink-0">
                <Image
                  src={product.image}
                  alt={product.title}
                  width={200}
                  height={300}
                  className="w-full h-auto object-cover"
                />
                <h3 className="font-semibold mt-2">{product.title}</h3>
                <p className="text-gray-600">{product.author}</p>
                <p className="font-bold">
                  {(product.price / 100).toFixed(2)} €
                </p>
              </div>
            ))}
          </div>
        </section>
      </main>
    </div>
  );
}
