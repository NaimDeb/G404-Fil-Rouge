import apiClient from "./apiClient";

export type User = {
  email: string;
  password: string;
  username: string;
  profileDesc: string;
  roles : string[];
  userDetails: {
    address: string;
    phone: string;
    country: string;
    firstName: string;
    lastName: string;
  };
  professionalDetails: {
    companyName: string;
    companyAddress: string;
    companyPhone: string;
  } | null;
  image: {
    imgPath: string | null;
  };
}

export async function login(email: string, password: string) {
  try {
    const { data } = await apiClient.post(`/login_check`, {
      email,
      password,
    });
    return data;
  } catch (error) {
    console.error("Login error:", error);
    return null;
  }
}

export async function register(user: User) {
  try {
    const { data } = await apiClient.post(`/register`, user);
    return data;
  } catch (error) {
    console.error("Registration error:", error);
    return null;
  }
}


export function me() {
    const token = localStorage.getItem("token");
    if (!token) {
        console.error("You aren't logged in !");
        return null;
    }
    
    apiClient.defaults.headers.common["Authorization"] = `Bearer ${token}`;
    return apiClient.get("/me").then((response) => response.data);
}