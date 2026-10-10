import { useEffect, useState } from "react";
import { Link, useLocation } from "react-router-dom";
import { Menu, X, Phone, Mail, MapPin, Facebook, Twitter, Instagram, Youtube } from "lucide-react";
import { motion, AnimatePresence } from "framer-motion";
import luminaLogo from "@/assets/lumina-logo.png";

import { useSiteSettings } from "@/context/SiteSettingsContext";

const navLinks = [
  { to: "/", label: "Home" },
  { to: "/about", label: "About" },
  { to: "/projects", label: "Activities" },
  { to: "/volunteer", label: "Volunteer" },
  { to: "/contact", label: "Contact us" },
];

const Navbar = () => {
  const [isOpen, setIsOpen] = useState(false);
  const [scrolled, setScrolled] = useState(false);
  const location = useLocation();
  const settings = useSiteSettings();

  useEffect(() => {
    const onScroll = () => setScrolled(window.scrollY > 20);
    window.addEventListener("scroll", onScroll);
    return () => window.removeEventListener("scroll", onScroll);
  }, []);

  useEffect(() => {
    setIsOpen(false);
    window.scrollTo({ top: 0, behavior: "smooth" });
  }, [location]);

  return (
    <motion.nav
      initial={{ y: -100 }}
      animate={{ y: 0 }}
      transition={{ duration: 0.6, ease: "easeOut" }}
      className={`fixed top-0 left-0 right-0 z-50 transition-all duration-500 ${
        scrolled
          ? "bg-white/95 dark:bg-[hsl(215_45%_8%/0.96)] backdrop-blur-xl shadow-[0_4px_30px_rgba(0,0,0,0.12)] border-b border-amber-100/40"
          : "bg-transparent"
      }`}
    >
      {/* ── TOP CONTACT & SOCIAL BAR (ALL DETAILS FROM CONTACT PAGE ON LEFT SIDE) ── */}
      <div
        className={`w-full transition-all duration-300 border-b ${
          scrolled
            ? "bg-slate-950/95 border-white/10 text-white/85 py-1.5"
            : "bg-slate-950/70 backdrop-blur-md border-white/10 text-white/90 py-2"
        }`}
      >
        <div className="w-full px-4 sm:px-6 md:px-10 flex items-center justify-between text-xs">
          {/* Left Side: Phone Number, Mail ID, and Social Media Icons */}
          <div className="flex flex-wrap items-center gap-3 sm:gap-5 md:gap-6">
            {/* Phone Number */}
            <a
              href={`tel:${settings.phone}`}
              className="inline-flex items-center gap-1.5 hover:text-amber-400 transition-colors font-medium group"
              title="Call Lumina Trust"
            >
              <Phone className="h-3.5 w-3.5 text-amber-400 group-hover:scale-110 transition-transform shrink-0" />
              <span>{settings.phone}</span>
            </a>

            <span className="hidden sm:inline text-white/20 select-none">•</span>

            {/* Email ID */}
            <a
              href={`mailto:${settings.email}`}
              className="inline-flex items-center gap-1.5 hover:text-amber-400 transition-colors font-medium group"
              title="Email Lumina Trust"
            >
              <Mail className="h-3.5 w-3.5 text-amber-400 group-hover:scale-110 transition-transform shrink-0" />
              <span>{settings.email}</span>
            </a>

            <span className="hidden md:inline text-white/20 select-none">•</span>

            {/* Social Media Icons */}
            <div className="flex items-center gap-2">
              {settings.facebook_url && (
                <a
                  href={settings.facebook_url}
                  target="_blank"
                  rel="noreferrer"
                  className="w-6 h-6 rounded-full border border-white/20 hover:border-amber-400 flex items-center justify-center text-white/70 hover:text-amber-400 hover:bg-amber-400/10 transition-all hover:scale-110"
                  aria-label="Facebook"
                >
                  <Facebook className="h-3 w-3" />
                </a>
              )}
              {settings.twitter_url && (
                <a
                  href={settings.twitter_url}
                  target="_blank"
                  rel="noreferrer"
                  className="w-6 h-6 rounded-full border border-white/20 hover:border-amber-400 flex items-center justify-center text-white/70 hover:text-amber-400 hover:bg-amber-400/10 transition-all hover:scale-110"
                  aria-label="Twitter"
                >
                  <Twitter className="h-3 w-3" />
                </a>
              )}
              {settings.instagram_url && (
                <a
                  href={settings.instagram_url}
                  target="_blank"
                  rel="noreferrer"
                  className="w-6 h-6 rounded-full border border-white/20 hover:border-amber-400 flex items-center justify-center text-white/70 hover:text-amber-400 hover:bg-amber-400/10 transition-all hover:scale-110"
                  aria-label="Instagram"
                >
                  <Instagram className="h-3 w-3" />
                </a>
              )}
              {settings.youtube_url && (
                <a
                  href={settings.youtube_url}
                  target="_blank"
                  rel="noreferrer"
                  className="w-6 h-6 rounded-full border border-white/20 hover:border-amber-400 flex items-center justify-center text-white/70 hover:text-amber-400 hover:bg-amber-400/10 transition-all hover:scale-110"
                  aria-label="YouTube"
                >
                  <Youtube className="h-3 w-3" />
                </a>
              )}
            </div>
          </div>

          {/* Right Side: Location Address & Trust Tag */}
          <div className="hidden lg:flex items-center gap-2 text-white/70 text-xs">
            <MapPin className="h-3.5 w-3.5 text-amber-400 shrink-0" />
            <span className="truncate max-w-xs">{settings.address}</span>
            <span className="text-white/20 mx-1">•</span>
            <span className="text-amber-300 font-semibold">{settings.tax_exemption_info ? "80G Certified NGO" : "100% Transparent NGO"}</span>
          </div>
        </div>
      </div>

      {/* Main navigation row */}
      <div className="w-full px-6 md:px-10 flex items-center justify-between h-16 md:h-20">
        <Link to="/" className="flex items-center gap-2">
          <motion.img
            src={luminaLogo}
            alt="Lumina Trust"
            className="h-10 md:h-12 w-auto"
            whileHover={{ scale: 1.05 }}
            transition={{ type: "spring", stiffness: 400, damping: 20 }}
          />
        </Link>

        <div className="hidden md:flex items-center gap-8">
          {navLinks.map((link, i) => (
            <motion.div
              key={link.to}
              initial={{ opacity: 0, y: -20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ delay: 0.1 + i * 0.08 }}
            >
              <Link
                to={link.to}
                className={`relative text-sm font-medium tracking-wide transition-colors group ${
                  location.pathname === link.to
                    ? scrolled
                      ? "text-foreground font-bold"
                      : "text-white font-bold"
                    : scrolled
                      ? "text-muted-foreground hover:text-foreground"
                      : "text-white/75 hover:text-white"
                }`}
              >
                {link.label}
                <span
                  className={`absolute -bottom-1 left-0 h-[2px] bg-amber-400 rounded-full transition-all duration-300 ${
                    location.pathname === link.to ? "w-full" : "w-0 group-hover:w-full"
                  }`}
                />
              </Link>
            </motion.div>
          ))}
          <motion.div
            initial={{ opacity: 0, scale: 0.8 }}
            animate={{ opacity: 1, scale: 1 }}
            transition={{ delay: 0.5 }}
          >
            <Link
              to="/donate"
              className="bg-gradient-to-r from-amber-400 to-amber-500 text-amber-950 px-6 py-2.5 rounded-full text-sm font-bold transition-all hover:shadow-gold hover:scale-105 hover:from-amber-300 hover:to-amber-400"
            >
              Donate
            </Link>
          </motion.div>
        </div>

        <motion.button
          whileTap={{ scale: 0.9 }}
          onClick={() => setIsOpen(!isOpen)}
          className={`md:hidden p-2 rounded-lg ${scrolled ? "text-foreground" : "text-white"}`}
          aria-label="Toggle Navigation Menu"
        >
          <AnimatePresence mode="wait">
            {isOpen ? (
              <motion.div key="close" initial={{ rotate: -90, opacity: 0 }} animate={{ rotate: 0, opacity: 1 }} exit={{ rotate: 90, opacity: 0 }}>
                <X className="h-6 w-6" />
              </motion.div>
            ) : (
              <motion.div key="open" initial={{ rotate: 90, opacity: 0 }} animate={{ rotate: 0, opacity: 1 }} exit={{ rotate: -90, opacity: 0 }}>
                <Menu className="h-6 w-6" />
              </motion.div>
            )}
          </AnimatePresence>
        </motion.button>
      </div>

      {/* Mobile Drawer Dropdown Menu */}
      <AnimatePresence>
        {isOpen && (
          <motion.div
            initial={{ opacity: 0, height: 0 }}
            animate={{ opacity: 1, height: "auto" }}
            exit={{ opacity: 0, height: 0 }}
            className="md:hidden bg-white/95 dark:bg-[hsl(215_45%_8%/0.97)] backdrop-blur-xl border-t border-amber-100/30 overflow-hidden shadow-2xl"
          >
            <div className="px-6 py-4 flex flex-col gap-1">
              {navLinks.map((link, i) => (
                <motion.div key={link.to} initial={{ opacity: 0, x: -30 }} animate={{ opacity: 1, x: 0 }} transition={{ delay: i * 0.06 }}>
                  <Link
                    to={link.to}
                    className={`block py-3 px-3 rounded-lg text-sm font-medium ${
                      location.pathname === link.to
                        ? "text-amber-600 bg-amber-50 dark:bg-amber-950/30 font-bold"
                        : "text-foreground hover:bg-secondary"
                    }`}
                  >
                    {link.label}
                  </Link>
                </motion.div>
              ))}

              <motion.div initial={{ opacity: 0, y: 10 }} animate={{ opacity: 1, y: 0 }} transition={{ delay: 0.35 }}>
                <Link
                  to="/donate"
                  className="bg-gradient-to-r from-amber-400 to-amber-500 text-amber-950 px-5 py-2.5 rounded-full text-sm font-bold text-center mt-3 block shadow-md"
                >
                  Donate
                </Link>
              </motion.div>

              {/* Mobile Contact & Social Media Strip */}
              <div className="mt-4 pt-4 border-t border-border/50 space-y-2.5 px-1">
                <p className="text-[11px] font-bold uppercase tracking-wider text-muted-foreground">Contact & Social</p>
                <a href="tel:+919894777349" className="flex items-center gap-2 text-xs text-foreground hover:text-amber-500 font-medium">
                  <Phone className="h-3.5 w-3.5 text-amber-500" />
                  <span>+91 98947 77349</span>
                </a>
                <a href="mailto:support@luminatrust.org" className="flex items-center gap-2 text-xs text-foreground hover:text-amber-500 font-medium">
                  <Mail className="h-3.5 w-3.5 text-amber-500" />
                  <span>support@luminatrust.org</span>
                </a>
                <div className="flex items-center gap-2 text-xs text-muted-foreground">
                  <MapPin className="h-3.5 w-3.5 text-amber-500 shrink-0" />
                  <span>Lumina Trust, Nagapattinam</span>
                </div>

                <div className="flex items-center gap-3 pt-2">
                  <a href="https://facebook.com" target="_blank" rel="noreferrer" className="w-7 h-7 rounded-full border border-border flex items-center justify-center text-muted-foreground hover:text-amber-500 hover:border-amber-400 transition-colors" aria-label="Facebook">
                    <Facebook className="h-3.5 w-3.5" />
                  </a>
                  <a href="https://twitter.com" target="_blank" rel="noreferrer" className="w-7 h-7 rounded-full border border-border flex items-center justify-center text-muted-foreground hover:text-amber-500 hover:border-amber-400 transition-colors" aria-label="Twitter">
                    <Twitter className="h-3.5 w-3.5" />
                  </a>
                  <a href="https://instagram.com" target="_blank" rel="noreferrer" className="w-7 h-7 rounded-full border border-border flex items-center justify-center text-muted-foreground hover:text-amber-500 hover:border-amber-400 transition-colors" aria-label="Instagram">
                    <Instagram className="h-3.5 w-3.5" />
                  </a>
                  <a href="https://youtube.com" target="_blank" rel="noreferrer" className="w-7 h-7 rounded-full border border-border flex items-center justify-center text-muted-foreground hover:text-amber-500 hover:border-amber-400 transition-colors" aria-label="YouTube">
                    <Youtube className="h-3.5 w-3.5" />
                  </a>
                </div>
              </div>
            </div>
          </motion.div>
        )}
      </AnimatePresence>
    </motion.nav>
  );
};

export default Navbar;
