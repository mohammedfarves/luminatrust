import React, { createContext, useContext, useState, useEffect } from "react";

export const defaultSettings = {
  email: "support@luminatrust.org",
  phone: "+91 98947 77349",
  secondary_phone: "+91 94891 16189",
  whatsapp_number: "+91 98947 77349",
  address: "Lumina Trust, Nagapattinam",
  map_link: "https://www.google.com/maps?q=Nagapattinam,Tamil%20Nadu&output=embed",
  working_hours: "Mon – Sat: 9:00 AM – 6:00 PM",
  facebook_url: "https://facebook.com",
  twitter_url: "https://twitter.com",
  instagram_url: "https://instagram.com",
  youtube_url: "https://youtube.com",
  linkedin_url: "https://linkedin.com",
  site_title: "Lumina Trust",
  site_tagline: "Empowering Communities, Transforming Lives",
  registration_number: "Trust Reg. No: 123/2018",
  tax_exemption_info: "Donations are 100% tax exempt under Section 80G of IT Act",
  footer_about: "Empowering communities for a brighter tomorrow through education, healthcare, and sustainable grassroots initiatives.",
};

const SiteSettingsContext = createContext(defaultSettings);

export const SiteSettingsProvider = ({ children }) => {
  const [settings, setSettings] = useState(defaultSettings);

  useEffect(() => {
    fetch("http://localhost:8000/api/settings")
      .then((res) => {
        if (!res.ok) throw new Error("Failed to fetch settings");
        return res.json();
      })
      .then((data) => {
        if (data && typeof data === "object") {
          setSettings((prev) => ({
            ...prev,
            ...data,
          }));
        }
      })
      .catch((err) => {
        console.log("Using default site settings:", err);
      });
  }, []);

  return (
    <SiteSettingsContext.Provider value={settings}>
      {children}
    </SiteSettingsContext.Provider>
  );
};

export const useSiteSettings = () => useContext(SiteSettingsContext);
