'use client';

import AnnonceCard from "./AnnonceCard"
import { Annonce, getLastFiveAnnonces } from "../lib/annonces"
import { useEffect, useState } from "react"

export default function NewProductsSection() {
    // Fetch the last five annonces from the API
    const [annonces, setAnnonces] = useState<Annonce[]>([])
    const [isLoading, setIsLoading] = useState(true)
    
    useEffect(() => {
        const fetchAnnonces = async () => {
            try {
                setIsLoading(true)
                const response = await getLastFiveAnnonces()
                console.log("Response received:", response)
                
                // Extract annonces from the member array if it exists
                if (response && response.member && Array.isArray(response.member)) {
                    setAnnonces(response.member)
                } else if (Array.isArray(response)) {
                    setAnnonces(response)
                } else {
                    console.error("Unexpected response format:", response)
                    setAnnonces([])
                }
            } catch (error) {
                console.error("Error fetching annonces:", error)
                setAnnonces([])
            } finally {
                setIsLoading(false)
            }
        }
        
        fetchAnnonces()
    }, [])
    
    return (
        <section className="py-8 px-8">
            {/* New Products Section */}
            <h2 className="font-merriweather text-2xl font-bold mb-4 md:text-3xl">
              Nouveaux produits
            </h2>
  
            <div className="flex gap-8 flex-nowrap h-fit my-16 mx-8 overflow-x-auto">
                {isLoading ? (
                    <div className="w-full h-full flex items-center justify-center">Loading...</div>
                ) : annonces.length > 0 ? (
                    annonces.map((annonce, index) => (
                        <AnnonceCard key={annonce.id || index} annonce={annonce} />
                    ))
                ) : (
                    <div className="w-full text-center">Aucun produit disponible</div>
                )}
            </div>
        </section>
    )
}