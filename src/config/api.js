/**
 * API Configuration for Lumina Trust
 * 
 * Automatically resolves the backend API base URL:
 * - In production: defaults to current site origin (https://luminatrust.org) or VITE_API_BASE_URL
 * - Automatically strips any legacy subpath misconfigurations (such as '/lumina_admin/public' or '/lumina_admin')
 * - In local development: defaults to http://localhost:8000
 */
const resolveBaseUrl = () => {
  let url = import.meta.env.VITE_API_BASE_URL || import.meta.env.VITE_API_URL;

  if (!url) {
    if (typeof window !== "undefined" && window.location && window.location.origin) {
      const hostname = window.location.hostname;
      if (hostname === "localhost" || hostname === "127.0.0.1") {
        url = "http://localhost:8000";
      } else {
        url = window.location.origin;
      }
    } else {
      url = "https://luminatrust.org";
    }
  }

  // Trim trailing slashes
  url = url.trim().replace(/\/+$/, "");

  // Critical safeguard: strip any legacy '/lumina_admin/public' or '/lumina_admin' subpaths
  url = url.replace(/\/lumina_admin(?:\/public)?$/i, "");

  return url;
};

export const API_BASE_URL = resolveBaseUrl();

export const API_ENDPOINTS = {
  SETTINGS: `${API_BASE_URL}/api/settings`,
  HOME: `${API_BASE_URL}/api/home`,
  ABOUT: `${API_BASE_URL}/api/about`,
  ACTIVITIES: `${API_BASE_URL}/api/activities`,
  ACTIVITY_DETAILS: (id) => `${API_BASE_URL}/api/activities/${id}`,
  DONATE: `${API_BASE_URL}/api/donate-page`,
  VOLUNTEERS: `${API_BASE_URL}/api/volunteers`,
  CONTACT: `${API_BASE_URL}/api/contact`,
  DONATIONS: `${API_BASE_URL}/api/donations`,
};

export default API_ENDPOINTS;
