import { motion } from "framer-motion";
import { Star } from "lucide-react";

const avatarColors = [
  "from-amber-400 to-orange-500",
  "from-cyan-400 to-blue-600",
  "from-emerald-400 to-teal-600",
];

const Testimonial = ({ quote, name, role, index = 0 }) => (
  <motion.div
    initial={{ opacity: 0, y: 30 }}
    whileInView={{ opacity: 1, y: 0 }}
    viewport={{ once: true }}
    transition={{ duration: 0.6 }}
    whileHover={{ y: -6 }}
    className="bg-card rounded-2xl p-6 shadow-ngo relative overflow-hidden group flex flex-col h-full hover:shadow-card-hover transition-all duration-500"
  >
    {/* Left border accent on hover */}
    <div className="absolute left-0 top-0 w-1 h-full bg-gradient-to-b from-amber-400 to-amber-600 rounded-l-2xl transform scale-y-0 group-hover:scale-y-100 transition-transform duration-500 origin-top" />

    {/* Large decorative quote watermark */}
    <div className="absolute -top-2 -right-1 font-heading text-[8rem] leading-none text-amber-400/8 select-none pointer-events-none">
      "
    </div>

    {/* Stars */}
    <div className="flex gap-1 mb-4">
      {Array.from({ length: 5 }).map((_, i) => (
        <Star key={i} className="h-3.5 w-3.5 text-amber-400 fill-amber-400" />
      ))}
    </div>

    {/* Quote */}
    <p className="text-foreground/85 text-sm leading-relaxed mb-6 font-body italic flex-1 relative z-10">
      "{quote}"
    </p>

    {/* Author */}
    <div className="flex items-center gap-3 mt-auto">
      <div className={`w-11 h-11 rounded-full bg-gradient-to-br ${avatarColors[index % avatarColors.length]} flex items-center justify-center text-white font-heading text-base font-bold shadow-md`}>
        {name.charAt(0)}
      </div>
      <div>
        <p className="font-semibold text-foreground text-sm leading-tight">{name}</p>
        <p className="text-xs text-muted-foreground mt-0.5">{role}</p>
      </div>
    </div>
  </motion.div>
);

export default Testimonial;
