const rawBaseUrl = import.meta.env.VITE_API_BASE_URL || "http://localhost:8000";
export const API_BASE_URL = rawBaseUrl.replace(/\/+$/, "");

export const API_ENDPOINTS = {
  SETTINGS: `${API_BASE_URL}/api/settings`,
  HOME: `${API_BASE_URL}/api/home`,
  ABOUT: `${API_BASE_URL}/api/about`,
  ACTIVITIES: `${API_BASE_URL}/api/activities`,
  ACTIVITY_DETAILS: (id) => `${API_BASE_URL}/api/activities/${id}`,
  DONATE: `${API_BASE_URL}/api/donate-page`,
  VOLUNTEERS: `${API_BASE_URL}/api/volunteers`,
};

export default API_ENDPOINTS;
