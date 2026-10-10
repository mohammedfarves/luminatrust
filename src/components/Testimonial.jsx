import { motion } from "framer-motion";
import { Star } from "lucide-react";
import mlaMeetingPhoto from "@/assets/events/mla-meeting.jpg";

const avatarColors = [
  "from-amber-400 to-orange-500",
  "from-cyan-400 to-blue-600",
  "from-emerald-400 to-teal-600",
];

const defaultTestimonials = [
  {
    quote: "Lumina Trust's educational support provided free competitive exam books and guidance that changed my daughter's academic journey.",
    name: "Kavitha R.",
    role: "Parent & Community Member"
  },
  {
    quote: "Partnering with Lumina Trust for free medical checkup camps in Nagapattinam has brought quality health awareness to hundreds of underserved families.",
    name: "Dr. S. Ramanathan",
    role: "Healthcare Volunteer"
  },
  {
    quote: "The environmental drives, beach cleanups, and tree plantation initiatives organized by Lumina Trust have truly united our youth for a greener future.",
    name: "M. Selvam",
    role: "Youth Volunteer"
  }
];

export const TestimonialCard = ({ quote, name, role, index = 0, isDark = true }) => {
  const safeName = name || "Beneficiary";
  const initial = safeName.charAt(0).toUpperCase();

  return (
    <motion.div
      initial={{ opacity: 0, y: 30 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true }}
      transition={{ duration: 0.6 }}
      whileHover={{ y: -6 }}
      className={`rounded-2xl p-7 relative overflow-hidden group flex flex-col h-full transition-all duration-500 border text-left ${
        isDark 
          ? "bg-slate-900/85 backdrop-blur-xl border-white/15 hover:border-amber-400/50 shadow-2xl" 
          : "bg-card shadow-ngo hover:shadow-card-hover border-border/40"
      }`}
    >
      {/* Left border accent on hover */}
      <div className="absolute left-0 top-0 w-1.5 h-full bg-gradient-to-b from-amber-400 to-amber-600 rounded-l-2xl transform scale-y-0 group-hover:scale-y-100 transition-transform duration-500 origin-top" />

      {/* Large decorative quote watermark */}
      <div className="absolute -top-2 -right-1 font-heading text-[8rem] leading-none text-amber-400/10 select-none pointer-events-none">
        "
      </div>

      {/* Stars */}
      <div className="flex gap-1 mb-4 relative z-10">
        {Array.from({ length: 5 }).map((_, i) => (
          <Star key={i} className="h-4 w-4 text-amber-400 fill-amber-400" />
        ))}
      </div>

      {/* Quote */}
      <p className={`text-sm leading-relaxed mb-6 font-body italic flex-1 relative z-10 ${isDark ? "text-white/85" : "text-foreground/85"}`}>
        "{quote || "Lumina Trust is making a meaningful impact across local communities."}"
      </p>

      {/* Author */}
      <div className="flex items-center gap-3 mt-auto relative z-10">
        <div className={`w-11 h-11 rounded-full bg-gradient-to-br ${avatarColors[index % avatarColors.length]} flex items-center justify-center text-slate-950 font-heading text-base font-bold shadow-md`}>
          {initial}
        </div>
        <div>
          <p className={`font-semibold text-sm leading-tight ${isDark ? "text-white" : "text-foreground"}`}>{safeName}</p>
          <p className={`text-xs mt-0.5 ${isDark ? "text-amber-400/90 font-semibold" : "text-muted-foreground"}`}>{role || "Community Partner"}</p>
        </div>
      </div>
    </motion.div>
  );
};

const Testimonial = (props) => {
  // If props has name or quote, render as single card
  if (props.name || props.quote) {
    return <TestimonialCard {...props} />;
  }

  // Otherwise render full Testimonials Section with real community photo backdrop
  return (
    <section className="py-24 md:py-32 bg-[#0A0E17] text-white relative overflow-hidden">
      {/* Real Community Photo Backdrop */}
      <div className="absolute inset-0 z-0 overflow-hidden pointer-events-none select-none">
        <img 
          src={mlaMeetingPhoto} 
          alt="Lumina Trust Community Meeting" 
          className="w-full h-full object-cover opacity-25 filter brightness-50 contrast-110 scale-105" 
        />
        <div className="absolute inset-0 bg-gradient-to-r from-[#0A0E17]/95 via-[#0A0E17]/80 to-[#0A0E17]/95" />
        <div className="absolute inset-0 bg-gradient-to-t from-[#0A0E17] via-transparent to-[#0A0E17]" />
        <div className="absolute top-1/2 left-0 w-96 h-96 bg-amber-400/15 rounded-full blur-[140px]" />
      </div>

      <div className="w-full px-6 md:px-10 max-w-7xl mx-auto relative z-10">
        <div className="text-center max-w-3xl mx-auto mb-14">
          <div className="inline-flex items-center gap-2 mb-3">
            <span className="w-6 h-0.5 bg-amber-400 rounded-full" />
            <span className="text-xs sm:text-sm font-bold tracking-widest text-amber-400 uppercase">
              Community Voices
            </span>
            <span className="w-6 h-0.5 bg-amber-400 rounded-full" />
          </div>
          <h2 className="font-heading text-3xl sm:text-4xl lg:text-5xl text-white font-extrabold tracking-tight leading-tight">
            What People Say About Us
          </h2>
          <div className="w-16 h-1 bg-amber-400 rounded-full mx-auto mt-4" />
          <p className="text-white/75 text-sm sm:text-base mt-4 leading-relaxed max-w-xl mx-auto">
            Hear from beneficiaries, volunteers, and doctors touched by Lumina Trust initiatives.
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
          {defaultTestimonials.map((item, idx) => (
            <TestimonialCard key={idx} {...item} index={idx} isDark={true} />
          ))}
        </div>
      </div>
    </section>
  );
};

export default Testimonial;
