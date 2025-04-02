import Image from "next/image";
import { Annonce } from "../lib/annonces";
import Link from "next/link";

export default function AnnonceCard({ annonce }: { annonce: Annonce }) {
  const price = Number(annonce.price);
  const priceCents = price % 100;
  const priceEuros = (price - priceCents) / 100;

  return (
    <article className="w-[180px] h-[180px]">
      <Link
        href={`./article/${annonce.id}`}
        className="group w-full h-full"
      >
        <div className="relative w-full h-full border-gray-400 border-[1px] flex items-center justify-center">
          <Image
            src={`${
              annonce.images[0].imgPath || "/book_covers/book_cover_default.png"
            }`}
            alt="Image de livre"
            className="object-contain max-w-full max-h-full"
            width={180}
            height={180}
          />
        </div>

        <div className="flex flex-col mt-2">
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
