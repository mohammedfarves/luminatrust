import { motion } from "framer-motion";

const SectionHeading = ({ subtitle, title, description, light, align = "center" }) => (
  <div className={`mb-16 ${align === "center" ? "text-center" : "text-left"}`}>
    {subtitle && (
      <motion.div
        initial={{ opacity: 0, y: 10 }}
        whileInView={{ opacity: 1, y: 0 }}
        viewport={{ once: true }}
        className={`inline-flex items-center gap-2 mb-5 ${align === "center" ? "justify-center" : ""}`}
      >
        <span className="w-6 h-0.5 rounded-full bg-gradient-to-r from-yellow-400 to-amber-500" />
        <span className={`text-xs font-bold uppercase tracking-[0.25em] ${light ? "text-yellow-400" : "text-amber-500"}`}>
          {subtitle}
        </span>
        <span className="w-6 h-0.5 rounded-full bg-gradient-to-l from-yellow-400 to-amber-500" />
      </motion.div>
    )}
    <motion.h2
      initial={{ opacity: 0, y: 20 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true }}
      transition={{ duration: 0.6, delay: 0.1 }}
      className={`font-heading text-3xl md:text-4xl lg:text-5xl font-normal leading-[1.15] ${light ? "text-white" : "text-foreground"}`}
    >
      {title}
    </motion.h2>
    <motion.div
      initial={{ scaleX: 0 }}
      whileInView={{ scaleX: 1 }}
      viewport={{ once: true }}
      transition={{ duration: 0.7, delay: 0.25 }}
      className={`mt-4 h-[3px] rounded-full bg-gradient-to-r from-yellow-400 to-amber-500 ${align === "center" ? "mx-auto w-16" : "w-14"}`}
    />
    {description && (
      <motion.p
        initial={{ opacity: 0, y: 15 }}
        whileInView={{ opacity: 1, y: 0 }}
        viewport={{ once: true }}
        transition={{ duration: 0.5, delay: 0.3 }}
        className={`mt-6 max-w-2xl text-base md:text-lg leading-relaxed ${align === "center" ? "mx-auto" : ""} ${light ? "text-white/65" : "text-muted-foreground"}`}
      >
        {description}
      </motion.p>
    )}
  </div>
);

export default SectionHeading;
