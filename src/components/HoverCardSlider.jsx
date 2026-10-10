import { motion, AnimatePresence } from "framer-motion";
import { useState, useRef } from "react";
import { ChevronLeft, ChevronRight, Clock, Heart, ArrowRight, Sparkles, MapPin } from "lucide-react";
import { Link } from "react-router-dom";

import bookDistributionImg from "@/assets/activits/Book given to students/b2.png";
import beachCleanImg from "@/assets/activits/nagore beach clean/WhatsApp Image 2026-09-01 at 1.55.01 PM.jpeg";
import doctorsDayImg from "@/assets/activits/DOCTERS ADY/WhatsApp Image 2026-09-01 at 2.01.14 PM.jpeg";
import treePlantationImg from "@/assets/activits/tree plantaion/t1.png";
import cycleRallyImg from "@/assets/activits/CYCLEING/c1.jpeg";
import plasticFreeImg from "@/assets/activits/Plastic bag free day/p1.jpeg";

const cardsData = [
  {
    id: "book-distribution",
    badge: "⏱️ 15 min read",
    tag: "EDUCATION",
    title: "Raspberry Tart - Student Book Drive",
    author: "by Lumina Education Team",
    image: bookDistributionImg,
    location: "Nagapattinam, TN",
    raised: "₹3,75,000",
    goal: "₹5,00,000"
  },
  {
    id: "beach-cleanup",
    badge: "⏱️ 20 min read",
    tag: "ENVIRONMENT",
    title: "Pumpkin Pie - Nagore Beach Cleanup",
    author: "by Eco Volunteers",
    image: beachCleanImg,
    location: "Nagore Beach, TN",
    raised: "₹6,00,000",
    goal: "₹10,00,000"
  },
  {
    id: "doctors-day",
    badge: "⏱️ 10 min read",
    tag: "HEALTHCARE",
    title: "Brownies - Free Health Checkup Drive",
    author: "by Dr. Medical Corps",
    image: doctorsDayImg,
    location: "Nagapattinam Health Camp",
    raised: "₹4,25,000",
    goal: "₹5,00,000"
  },
  {
    id: "tree-plantation",
    badge: "⏱️ 12 min read",
    tag: "ECOLOGY",
    title: "Green Earth Tree Plantation",
    author: "by Climate Action Unit",
    image: treePlantationImg,
    location: "Nagapattinam District",
    raised: "₹4,50,000",
    goal: "₹5,00,000"
  },
  {
    id: "pedal-for-planet",
    badge: "⏱️ 18 min read",
    tag: "COMMUNITY",
    title: "Pedal For Planet Cycling Rally",
    author: "by Lumina Youth Wing",
    image: cycleRallyImg,
    location: "Collectorate Road",
    raised: "Completed",
    goal: "100% Successful"
  },
  {
    id: "plastic-free-day",
    badge: "⏱️ 14 min read",
    tag: "SUSTAINABILITY",
    title: "Plastic Free Awareness Campaign",
    author: "by Eco Champions",
    image: plasticFreeImg,
    location: "Nagapattinam Town",
    raised: "₹2,75,000",
    goal: "₹5,00,000"
  }
];

const HoverCardSlider = () => {
  const [hoveredIndex, setHoveredIndex] = useState(0);
  const scrollRef = useRef(null);

  const scroll = (direction) => {
    if (scrollRef.current) {
      const scrollAmount = direction === "left" ? -340 : 340;
      scrollRef.current.scrollBy({ left: scrollAmount, behavior: "smooth" });
    }
  };

  return (
    <section className="relative py-20 px-4 sm:px-8 bg-[#13141a] text-white overflow-hidden rounded-[2.5rem] sm:rounded-[3.5rem] my-12 border border-white/10 shadow-2xl select-none">
      {/* Decorative Webflow-style Background Circles */}
      <div className="absolute inset-0 pointer-events-none overflow-hidden">
        <svg viewBox="0 0 1000 600" className="w-full h-full opacity-15 stroke-amber-400 fill-none">
          <circle cx="150" cy="150" r="180" strokeWidth="1" />
          <circle cx="850" cy="450" r="220" strokeWidth="1" />
          <line x1="0" y1="300" x2="1000" y2="300" strokeWidth="0.5" strokeDasharray="5,5" />
        </svg>
        <div className="absolute -top-24 left-1/3 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl" />
        <div className="absolute -bottom-24 right-1/4 w-96 h-96 bg-purple-600/15 rounded-full blur-3xl" />
      </div>

      <div className="max-w-7xl mx-auto relative z-10">
        {/* Top Header Row */}
        <div className="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-10 gap-4">
          <div className="flex items-center gap-3">
            <div className="w-10 h-10 rounded-2xl bg-amber-400 text-amber-950 flex items-center justify-center font-extrabold shadow-lg">
              <Sparkles className="h-5 w-5" />
            </div>
            <div>
              <span className="text-amber-400 text-xs font-mono font-bold tracking-wider uppercase block">
                #105: Featured Impact Card Animation On Hover
              </span>
              <h2 className="font-heading text-2xl sm:text-4xl text-white font-bold tracking-tight">
                Our Interactive <span className="text-amber-400">Initiatives</span>
              </h2>
            </div>
          </div>

          {/* Controls pill tags */}
          <div className="flex items-center gap-2">
            <span className="text-xs text-white/50 font-mono mr-3 hidden md:inline">Hover over cards to expand</span>
            <button
              onClick={() => scroll("left")}
              className="w-12 h-12 rounded-full bg-gradient-to-r from-amber-400 to-amber-500 text-amber-950 flex items-center justify-center shadow-lg hover:scale-110 active:scale-95 transition-all"
              aria-label="Previous Slide"
            >
              <ChevronLeft className="h-6 w-6 stroke-[2.5]" />
            </button>
            <button
              onClick={() => scroll("right")}
              className="w-12 h-12 rounded-full bg-gradient-to-r from-amber-400 to-amber-500 text-amber-950 flex items-center justify-center shadow-lg hover:scale-110 active:scale-95 transition-all"
              aria-label="Next Slide"
            >
              <ChevronRight className="h-6 w-6 stroke-[2.5]" />
            </button>
          </div>
        </div>

        {/* Horizontal Slider Area */}
        <div
          ref={scrollRef}
          className="flex gap-6 overflow-x-auto pb-10 pt-4 scrollbar-none snap-x snap-mandatory scroll-smooth"
          style={{ scrollbarWidth: "none", msOverflowStyle: "none" }}
        >
          {cardsData.map((card, idx) => {
            const isHovered = hoveredIndex === idx;

            return (
              <motion.div
                key={card.id}
                onMouseEnter={() => setHoveredIndex(idx)}
                animate={{
                  scale: isHovered ? 1.04 : 0.98,
                  y: isHovered ? -12 : 0,
                }}
                transition={{ type: "spring", stiffness: 300, damping: 20 }}
                className="flex-none w-[300px] sm:w-[320px] snap-center cursor-pointer"
              >
                {/* White Card Container */}
                <div
                  className={`bg-white rounded-[2rem] p-4 text-slate-900 shadow-2xl transition-all duration-300 relative border-2 ${
                    isHovered
                      ? "border-amber-400 shadow-[0_20px_50px_rgba(245,158,11,0.25)]"
                      : "border-transparent opacity-95"
                  }`}
                >
                  {/* Top Image Box */}
                  <div className="relative h-64 rounded-[1.5rem] overflow-hidden bg-slate-100">
                    <img
                      src={card.image}
                      alt={card.title}
                      className={`w-full h-full object-cover transition-transform duration-700 ${
                        isHovered ? "scale-110" : "scale-100"
                      }`}
                    />
                    <div className="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-60" />

                    {/* Top Right Animated Reading Time / Status Badge */}
                    <AnimatePresence>
                      {isHovered && (
                        <motion.div
                          initial={{ opacity: 0, y: -10, scale: 0.9 }}
                          animate={{ opacity: 1, y: 0, scale: 1 }}
                          exit={{ opacity: 0, y: -10, scale: 0.9 }}
                          transition={{ duration: 0.2 }}
                          className="absolute top-3 right-3 bg-white/95 backdrop-blur-md text-slate-900 text-xs font-bold px-3.5 py-1.5 rounded-full shadow-lg border border-slate-200/60 flex items-center gap-1.5"
                        >
                          <span>{card.badge}</span>
                        </motion.div>
                      )}
                    </AnimatePresence>
                  </div>

                  {/* Card Content */}
                  <div className="pt-5 px-2 pb-2">
                    {/* Category Label */}
                    <span className="text-[11px] font-extrabold uppercase tracking-widest text-slate-400 block mb-1">
                      {card.tag}
                    </span>

                    {/* Title */}
                    <h3 className="font-heading text-2xl font-bold leading-snug text-slate-900 mb-1 line-clamp-1 hover:text-amber-600 transition-colors">
                      {card.title}
                    </h3>

                    {/* Subtitle / Author */}
                    <p className="text-xs text-slate-500 font-medium mb-4">
                      {card.author}
                    </p>

                    {/* Bottom Metadata & CTA */}
                    <div className="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                      <div className="flex items-center gap-1 text-emerald-700 font-bold">
                        <MapPin className="h-3.5 w-3.5 shrink-0" />
                        <span className="truncate max-w-[130px]">{card.location}</span>
                      </div>

                      <Link
                        to={`/projects/${card.id}`}
                        className={`inline-flex items-center gap-1 px-3 py-1.5 rounded-full font-extrabold text-[11px] uppercase tracking-wider transition-all ${
                          isHovered
                            ? "bg-amber-400 text-amber-950 shadow-md"
                            : "bg-slate-100 text-slate-700 hover:bg-amber-100"
                        }`}
                      >
                        <span>View</span>
                        <ArrowRight className="h-3 w-3" />
                      </Link>
                    </div>
                  </div>
                </div>
              </motion.div>
            );
          })}
        </div>

        {/* Bottom Webflow-style Navigation Bar */}
        <div className="pt-6 border-t border-white/10 flex flex-wrap items-center justify-between text-xs text-white/60 gap-4">
          <span className="font-mono">Visual Web Development Made Easy</span>

          <div className="flex flex-wrap items-center gap-2">
            {["Templates", "Tutorials", "Clone", "Learn UI Design", "Support Cause"].map((btnText, i) => (
              <span
                key={i}
                className={`px-4 py-1.5 rounded-full text-[11px] font-semibold transition-all border ${
                  i === 0
                    ? "bg-gradient-to-r from-amber-400 to-amber-500 text-amber-950 border-amber-400 shadow-md font-extrabold"
                    : "border-white/20 text-white/80 hover:bg-white/10"
                }`}
              >
                {btnText}
              </span>
            ))}
          </div>
        </div>
      </div>
    </section>
  );
};

export default HoverCardSlider;
