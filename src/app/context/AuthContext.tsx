"use client";

import { createContext, useContext, useState, useEffect } from "react";
import { me, User } from "../lib/auth";
import { useRouter } from "next/navigation";

interface AuthContextType {
  isAuthenticated: boolean;
  user: User | null;
  logout: () => void;
}


// We create the context here, with the default values
const AuthContext = createContext<AuthContextType>({
  isAuthenticated: false,
  user: null,
  logout: () => {},
});

export function AuthProvider({ children }: { children: React.ReactNode }) {
  const [isAuthenticated, setIsAuthenticated] = useState(false);
  const [user, setUser] = useState(null);
  const router = useRouter();
  
  useEffect(() => {
    const initAuth = async () => {
      const token = localStorage.getItem("token");
      if (token) {
        try {
          const user = await me();
          setUser(user);
          setIsAuthenticated(true);
        } catch (error) {
          console.error("Error fetching user data:", error);
          localStorage.removeItem("token");
          setIsAuthenticated(false);
          setUser(null);
        }
      }
    };
    initAuth();
  }, []);
  
  const logout = () => {
    localStorage.removeItem("token");
    setIsAuthenticated(false);
    setUser(null);
    router.push("/");
  };

  return (
    <AuthContext.Provider value={{ isAuthenticated, user, logout }}>
      {children}
    </AuthContext.Provider>
  );
}

export const useAuth = () => useContext(AuthContext);
