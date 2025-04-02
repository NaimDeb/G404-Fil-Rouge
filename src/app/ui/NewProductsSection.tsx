"use client";

import AnnonceCard from "./AnnonceCard";
import { Annonce, getLastFiveAnnonces } from "../lib/annonces";
import { useEffect, useState, useRef } from "react";
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/react/24/outline";

export default function NewProductsSection() {
  const [annonces, setAnnonces] = useState<Annonce[]>([]);
  const [isLoading, setIsLoading] = useState(true);
  const scrollContainerRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    const fetchAnnonces = async () => {
      try {
        setIsLoading(true);
        const response = await getLastFiveAnnonces();
        console.log("Response received:", response);

        // Extract annonces from the member array if it exists
        if (response && response.member && Array.isArray(response.member)) {
          setAnnonces(response.member);
        } else if (Array.isArray(response)) {
          setAnnonces(response);
        } else {
          console.error("Unexpected response format:", response);
          setAnnonces([]);
        }
      } catch (error) {
        console.error("Error fetching annonces:", error);
        setAnnonces([]);
      } finally {
        setIsLoading(false);
      }
    };

    fetchAnnonces();
  }, []);

  const scroll = (direction: "left" | "right") => {
    if (!scrollContainerRef.current) return;

    const container = scrollContainerRef.current;
    const scrollAmount = container.clientWidth;
    const newScrollPosition =
      direction === "left"
        ? container.scrollLeft - scrollAmount
        : container.scrollLeft + scrollAmount;

    container.scrollTo({
      left: newScrollPosition,
      behavior: "smooth",
    });
  };

  return (
    <section className="py-6 px-4 md:px-32 relative">
      <h2 className="font-merriweather text-2xl font-bold mb-6 md:text-3xl">
        Nouveaux produits
      </h2>

      <div className="relative max-w-[1440px] mx-auto">
        <button
          onClick={() => scroll("left")}
          className="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 z-10 bg-white rounded-full p-2 shadow-md hover:bg-gray-100"
          aria-label="Previous items"
        >
          <ChevronLeftIcon className="h-6 w-6" />
        </button>

        <div
          ref={scrollContainerRef}
          className="grid grid-flow-col auto-cols-[160px] gap-4 overflow-x-auto pb-4 px-2 scroll-smooth snap-x snap-mandatory hide-scrollbar"
          style={{
            scrollbarWidth: "none",
            msOverflowStyle: "none",
          }}
        >
          {isLoading ? (
            <div className="w-full h-full flex items-center justify-center">
              Loading...
            </div>
          ) : annonces.length > 0 ? (
            annonces.map((annonce, index) => (
              <div key={annonce.id || index} className="snap-start">
                <AnnonceCard annonce={annonce} />
              </div>
            ))
          ) : (
            <div className="w-full text-center">Aucun produit disponible</div>
          )}
        </div>

        <button
          onClick={() => scroll("right")}
          className="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 z-10 bg-white rounded-full p-2 shadow-md hover:bg-gray-100"
          aria-label="Next items"
        >
          <ChevronRightIcon className="h-6 w-6" />
        </button>
      </div>
    </section>
  );
}
