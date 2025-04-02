// Removed unused Image import
import Link from "next/link";
import { getAnnonceById, Annonce } from "@/app/lib/annonces";


// Using Next.js data fetching pattern
const getAnnonce = async (id: string): Promise<Annonce> => {
  return await getAnnonceById(Number(id));
};

// Component for displaying price in correct format
const PriceTag = ({ price }: { price: number }) => {
  const priceEuros = Math.floor(price / 100);
  const priceCents = price % 100;
  
  return (
    <label htmlFor="price" className="text-nowrap">
      <span className="text-3xl font-merriweather font-bold">{priceEuros},</span>
      <span className="text-sm font-bold">
        {priceCents.toString().padStart(2, "0")}
      </span>
      <span className="text-3xl font-bold font-merriweather">€</span>
    </label>
  );
};

// Buy button component
const BuyButton = ({ className }: { className?: string }) => (
  <button 
    className={`bg-primary-green text-neutral-off-white font-merriweather text-3xl rounded-lg px-4 text-center py-2 w-full my-6 hover:-translate-y-[2px] transition-all hover:brightness-110 ${className}`}
  >
    Acheter
  </button>
);

export default async function AnnoncePage({ params }: { params: { id: string } }) {
  const annonce = await getAnnonce(params.id);
  
  const {
    product: {
      name: productName,
      author: productAuthor,
      specifications: productSpecifications,
      type: productType,
    },
    price: annoncePrice,
    condition: annonceCondition,
  } = annonce;

  return (
    <main>
      <section className="p-8 flex flex-col gap-2 lg:px-16 lg:justify-center text-neutral-off-black">
        <div className="flex flex-col sm:flex-row gap-4 lg:justify-center">
          <div className="bg-neutral-off-white w-full h-[80vw] sm:w-[40vw] sm:h-[40vw] lg:w-[500px] lg:h-[500px] py-4 outline outline-1 outline-gray-600 flex items-center justify-center max-md:basis-1/2">
            {/* <Image
              src={`/book_covers/${productOriginalImage || "bookrandom.png"}`}
              alt="Image de livre"
              className="object-contain h-full"
              width={500}
              height={500}
            /> */}
          </div>
          <div className="sm:flex sm:flex-col lg:justify-between lg:w-[500px] lg:h-[500px] gap-4">
            <p className="text-lg text-gray-500">
              <Link href={`/categories/${productType.toLowerCase()}`}>{productType}</Link> &gt;{" "}
              {/* <Link href={`/genres/${productGenres[0].toLowerCase()}`}>{productGenres[0]}</Link> */}
            </p>
            <div className="flex justify-between">
              <div className="flex-col">
                <h2 className="text-3xl font-merriweather font-bold">
                  {productName}
                </h2>
                <h4 className="text-md">Par {String(productAuthor)}</h4>
                <h4 className="text-md text-opacity-50 text-neutral-off-black">
                  Etat : <span className="font-bold">{annonceCondition}</span>
                </h4>
              </div>
              <PriceTag price={Number(annoncePrice)} />
            </div>
            <section className="hidden lg:inline flex-col gap-8">
              <h3 className="text-2xl font-merriweather font-bold">
                Description
              </h3>
              <p className="text-lg">{productSpecifications}</p>
            </section>
            <BuyButton className="hidden lg:block" />
          </div>
        </div>
        
        <BuyButton className="lg:hidden" />
      </section>
      
      <section className="p-8 lg:hidden text-neutral-off-black">
        <h3 className="text-2xl font-merriweather font-bold">Description</h3>
        <p className="text-lg">{productSpecifications}</p>
      </section>
      
      <section className="px-8 py-8 lg:px-16 xl:px-64 text-neutral-off-black">
        <h3 className="text-2xl font-merriweather font-bold">
          Par le même auteur
        </h3>
        <div className="flex gap-4">
          {/* This would be populated by a separate component or data fetch */}
          {/* <RelatedBooks author={productAuthor} currentProductId={params.id} /> */}
        </div>
      </section>
    </main>
  );
}