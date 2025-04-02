import apiClient from "./apiClient";

export type Annonce = {
    id: number;
    price: string;
    productCondition: string;
    condition: string;
    product: {
        id: string;
        type: string;
        name: string;
        specifications: string;
        author: {
            id: string;
            type: string;
            name: string;
        };
    };
    images: {
        id: string;
        type: string;
        imgPath: string;
    }[];
    createdAt: string;
    updatedAt: string;
};


export const createAnnonce = async (annonce: Omit<Annonce, 'id' | 'createdAt' | 'updatedAt'>): Promise<Annonce> => {
    const response = await apiClient.post<Annonce>('/annonces', annonce);
    return response.data;
};

export const getLastFiveAnnonces = async (): Promise<Annonce[]> => {
    const response = await apiClient.get<Annonce[]>('/annonce/recent');
    return response.data;
};

export const getAnnonceById = async (id: number): Promise<Annonce> => {
    const response = await apiClient.get<Annonce>(`/annonce/${id}`);
    return response.data;
};

export const getAnnonceBySameSeller = async (id: number): Promise<Annonce[]> => {
    const response = await apiClient.get<Annonce[]>(`/annonces/${id}/sameSeller`);
    return response.data;
};