import Image from "next/image";
import { Annonce } from "../lib/annonces";
import Link from "next/link";

export default function AnnonceCard({ annonce }: { annonce: Annonce }) {
  const price = Number(annonce.price);
  const priceCents = price % 100;
  const priceEuros = (price - priceCents) / 100;

  return (
    <article className="w-[160px] flex flex-col">
      <Link href={`./article/${annonce.id}`} className="group w-full">
        <div className="relative w-full h-[200px] border-gray-400 border-[1px] rounded-md overflow-hidden">
          <Image
            src={`${
              annonce.images[0].imgPath || "/book_covers/book_cover_default.png"
            }`}
            alt="Image de livre"
            className="object-contain hover:scale-105 transition-transform duration-200"
            fill
            sizes="160px"
          />
        </div>

        <div className="flex flex-col mt-2 gap-1">
          <h3 className="font-merriweather font-bold truncate text-lg">
            {annonce.product.name}
          </h3>

          <div className="flex justify-between w-full">
            <div className="text-sm font-open-sans text-gray-500">
              <p>{annonce.product.author.name}</p>
              <p>{annonce.productCondition}</p>
            </div>

            <p className="font-xl font-merriweather font-bold">
              {priceEuros},{String(priceCents).padStart(2, "0")}€
            </p>
          </div>
        </div>
      </Link>
    </article>
  );
}
