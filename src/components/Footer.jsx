import { Link } from "react-router-dom";
import { motion } from "framer-motion";
import { Mail, Phone, MapPin, Facebook, Twitter, Instagram, Youtube, ArrowRight } from "lucide-react";
import luminaLogo from "@/assets/lumina-logo.png";
import { staggerContainer, staggerItem } from "./AnimationEffects";
import { useSiteSettings } from "@/context/SiteSettingsContext";

const Footer = () => {
  const settings = useSiteSettings();

  const socialLinks = [
    { icon: Facebook, href: settings.facebook_url, label: "Facebook" },
    { icon: Twitter, href: settings.twitter_url, label: "Twitter/X" },
    { icon: Instagram, href: settings.instagram_url, label: "Instagram" },
    { icon: Youtube, href: settings.youtube_url, label: "YouTube" },
  ].filter(s => s.href);

  return (
  <footer className="bg-gradient-dark text-white overflow-hidden">
    {/* CTA Band */}
    <div className="relative bg-gradient-to-r from-amber-500 via-amber-400 to-yellow-400 py-10 sm:py-14 px-4 sm:px-6 overflow-hidden">
      <div className="absolute inset-0 bg-dot-grid opacity-20" />
      <div className="site-container-narrow text-center relative">
        <motion.p
          initial={{ opacity: 0, y: 10 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          className="text-xs font-bold uppercase tracking-[0.25em] text-amber-900/70 mb-2 sm:mb-3"
        >
          Join Our Mission
        </motion.p>
        <motion.h2
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ delay: 0.1 }}
          className="font-heading text-2xl sm:text-4xl lg:text-5xl text-amber-950 leading-tight mb-3 sm:mb-5"
        >
          Ready to Make a Difference?
        </motion.h2>
        <motion.p
          initial={{ opacity: 0, y: 15 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ delay: 0.2 }}
          className="text-amber-900/80 text-sm sm:text-base md:text-lg max-w-xl mx-auto mb-6 sm:mb-8"
        >
          Every contribution, big or small, creates ripples of change. Be part of our story.
        </motion.p>
        <motion.div
          initial={{ opacity: 0, y: 10 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ delay: 0.3 }}
          className="flex flex-col sm:flex-row justify-center items-center gap-3 sm:gap-4 max-w-md mx-auto"
        >
          <Link
            to="/donate"
            className="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-amber-950 text-amber-50 px-6 sm:px-8 py-3 sm:py-3.5 rounded-full font-bold text-sm hover:bg-amber-900 transition-all hover:scale-105 hover:shadow-xl"
          >
            Donate Today <ArrowRight className="h-4 w-4" />
          </Link>
          <Link
            to="/volunteer"
            className="w-full sm:w-auto inline-flex items-center justify-center gap-2 border-2 border-amber-900/40 text-amber-950 px-6 sm:px-8 py-3 sm:py-3.5 rounded-full font-bold text-sm hover:border-amber-950 transition-all hover:scale-105"
          >
            Volunteer With Us
          </Link>
        </motion.div>
      </div>
    </div>

    {/* Main footer */}
    <div className="bg-dot-grid relative">
      <div className="site-container py-12 sm:py-16 md:py-20">
        <motion.div
          variants={staggerContainer}
          initial="hidden"
          whileInView="show"
          viewport={{ once: true }}
          className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 sm:gap-12"
        >
          {/* Brand */}
          <motion.div variants={staggerItem}>
            <motion.img src={luminaLogo} alt={settings.site_title || "Lumina Trust"} className="h-12 sm:h-14 w-auto mb-4 sm:mb-5" whileHover={{ scale: 1.05 }} />
            <p className="text-white/55 text-xs sm:text-sm leading-relaxed mb-5 sm:mb-6">
              {settings.footer_about || "Empowering communities for a brighter tomorrow."}
            </p>
            <div className="flex gap-3">
              {socialLinks.map(({ icon: Icon, href, label }, i) => (
                <motion.a
                  key={i}
                  href={href}
                  target="_blank"
                  rel="noreferrer"
                  aria-label={label}
                  whileHover={{ scale: 1.2, y: -3 }}
                  whileTap={{ scale: 0.9 }}
                  className="w-8 h-8 sm:w-9 sm:h-9 rounded-full border border-white/10 flex items-center justify-center text-white/50 hover:bg-amber-400 hover:text-amber-950 hover:border-amber-400 transition-all duration-300"
                >
                  <Icon className="h-3.5 w-3.5 sm:h-4 sm:w-4" />
                </motion.a>
              ))}
            </div>
          </motion.div>

          {/* Quick Links */}
          <motion.div variants={staggerItem}>
            <h4 className="font-heading text-base sm:text-lg mb-4 sm:mb-5 text-white">Quick Links</h4>
            <div className="flex flex-col gap-2.5 sm:gap-3">
              {[["Home", "/"], ["About", "/about"], ["Activities", "/projects"], ["Volunteer", "/volunteer"], ["Donate", "/donate"], ["Contact", "/contact"]].map(([label, to]) => (
                <motion.div key={to} whileHover={{ x: 6 }}>
                  <Link to={to} className="text-xs sm:text-sm text-white/50 hover:text-amber-400 transition-colors flex items-center gap-2 group">
                    <span className="w-3 h-[1.5px] bg-amber-400/50 group-hover:w-5 transition-all duration-300 rounded-full" />
                    {label}
                  </Link>
                </motion.div>
              ))}
            </div>
          </motion.div>

          {/* Our Causes */}
          <motion.div variants={staggerItem}>
            <h4 className="font-heading text-base sm:text-lg mb-4 sm:mb-5 text-white">Our Causes</h4>
            <div className="flex flex-col gap-2.5 sm:gap-3">
              {["Education", "Clean Water", "Healthcare", "Environment", "Women Empowerment"].map((c) => (
                <span key={c} className="text-xs sm:text-sm text-white/50 flex items-center gap-2">
                  <span className="w-1.5 h-1.5 rounded-full bg-amber-400/60 shrink-0" />
                  {c}
                </span>
              ))}
            </div>
          </motion.div>

          {/* Contact */}
          <motion.div variants={staggerItem}>
            <h4 className="font-heading text-base sm:text-lg mb-4 sm:mb-5 text-white">Contact Info</h4>
            <div className="flex flex-col gap-3.5 sm:gap-4">
              {[
                { icon: <MapPin className="h-4 w-4 mt-0.5 text-amber-400 shrink-0" />, text: settings.address, href: null },
                { icon: <Phone className="h-4 w-4 text-amber-400 shrink-0" />, text: settings.phone, href: `tel:${settings.phone}` },
                { icon: <Mail className="h-4 w-4 text-amber-400 shrink-0" />, text: settings.email, href: `mailto:${settings.email}` },
              ].map((c, i) => (
                <motion.div key={i} whileHover={{ x: 3 }} className="flex items-start gap-2.5 sm:gap-3">
                  {c.icon}
                  {c.href ? (
                    <a href={c.href} className="text-xs sm:text-sm text-white/55 hover:text-amber-400 transition-colors leading-relaxed break-all">
                      {c.text}
                    </a>
                  ) : (
                    <span className="text-xs sm:text-sm text-white/55 leading-relaxed break-words">{c.text}</span>
                  )}
                </motion.div>
              ))}
            </div>
          </motion.div>
        </motion.div>

        {/* Bottom bar */}
        <div className="section-divider mt-12 sm:mt-16 mb-6 sm:mb-8" />
        <div className="flex flex-col sm:flex-row items-center justify-between gap-3 text-[11px] sm:text-xs text-white/40 text-center sm:text-left">
          <p>© {new Date().getFullYear()} {settings.site_title || "Lumina Trust"}. All rights reserved.</p>
          <a href="https://infygrid.in" target="_blank" rel="noopener noreferrer">Developed by <span className="text-amber-400 font-semibold">Infygrid Solutions</span></a>
        </div>
      </div>
    </div>
  </footer>
  );
};

export default Footer;
