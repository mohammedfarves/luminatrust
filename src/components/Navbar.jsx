import { useEffect, useState } from "react";
import { Link, useLocation } from "react-router-dom";
import { Menu, X } from "lucide-react";
import { motion, AnimatePresence } from "framer-motion";
import luminaLogo from "@/assets/lumina-logo.png";

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
      className={`fixed top-0 left-0 right-0 z-50 transition-all duration-500 ${scrolled
          ? "bg-white/90 dark:bg-[hsl(215_45%_8%/0.92)] backdrop-blur-xl shadow-[0_1px_32px_rgba(0,0,0,0.10)] border-b border-amber-100/40"
          : "bg-transparent"
        }`}
    >
      {/* Top accent gradient bar */}
      <div className="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-amber-400 to-transparent opacity-80" />

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
                className={`relative text-sm font-medium tracking-wide transition-colors group ${location.pathname === link.to
                    ? scrolled ? "text-foreground" : "text-white"
                    : scrolled
                      ? "text-muted-foreground hover:text-foreground"
                      : "text-white/75 hover:text-white"
                  }`}
              >
                {link.label}
                <span className={`absolute -bottom-1 left-0 h-[2px] bg-amber-400 rounded-full transition-all duration-300 ${location.pathname === link.to ? "w-full" : "w-0 group-hover:w-full"
                  }`} />
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
          className={`md:hidden ${scrolled ? "text-foreground" : "text-white"}`}
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

      <AnimatePresence>
        {isOpen && (
          <motion.div
            initial={{ opacity: 0, height: 0 }}
            animate={{ opacity: 1, height: "auto" }}
            exit={{ opacity: 0, height: 0 }}
            className="md:hidden bg-white/95 dark:bg-[hsl(215_45%_8%/0.97)] backdrop-blur-xl border-t border-amber-100/30 overflow-hidden"
          >
            <div className="px-6 py-4 flex flex-col gap-1">
              {navLinks.map((link, i) => (
                <motion.div key={link.to} initial={{ opacity: 0, x: -30 }} animate={{ opacity: 1, x: 0 }} transition={{ delay: i * 0.06 }}>
                  <Link
                    to={link.to}
                    className={`block py-3 px-3 rounded-lg text-sm font-medium ${location.pathname === link.to
                        ? "text-amber-600 bg-amber-50 dark:bg-amber-950/30"
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
                  className="bg-gradient-to-r from-amber-400 to-amber-500 text-amber-950 px-5 py-2.5 rounded-full text-sm font-bold text-center mt-3 block"
                >
                  Donate
                </Link>
              </motion.div>
            </div>
          </motion.div>
        )}
      </AnimatePresence>
    </motion.nav>
  );
};

export default Navbar;
