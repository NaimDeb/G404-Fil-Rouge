import apiClient from "./apiClient";

export async function getLastAnnonces() {
    const { data } = await apiClient.get(`/annonces/last-five`);
    return data;
}