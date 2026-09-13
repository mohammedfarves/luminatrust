import { useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { X, ChevronLeft, ChevronRight, Leaf, Calendar, MapPin, ArrowRight } from "lucide-react";
import { staggerContainer, staggerItem } from "@/components/AnimationEffects";

// Activity Images
import treePlantationImg from "@/assets/activits/tree plantaion/t1.png";
import schoolSupportImg from "@/assets/activits/Book given to students/b2.png";
import envDayPoster from "@/assets/activits/world environment day/WhatsApp Image 2026-09-01 at 2.05.06 PM.jpeg";
import doctorsDayImg from "@/assets/activits/DOCTERS ADY/WhatsApp Image 2026-09-01 at 2.01.14 PM.jpeg";
import giftDistImg from "@/assets/activits/Book given to students/WhatsApp Image 2026-09-01 at 1.59.20 PM.jpeg";
import kidsYellow from "@/assets/activits/Book given to students/WhatsApp Image 2026-09-01 at 1.59.26 PM.jpeg";
import indoorKids from "@/assets/activits/Book given to students/WhatsApp Image 2026-09-01 at 1.59.24 PM.jpeg";
import cyclingImg from "@/assets/activits/CYCLEING/WhatsApp Image 2026-09-01 at 2.08.51 PM.jpeg";
import scienceCompImg from "@/assets/activits/Science Competition – Nagapattinam/WhatsApp Image 2026-09-01 at 1.55.51 PM.jpeg";

const categories = ["All", "Education", "Environment", "Community", "Awareness", "Events"];

const allItems = [
  {
    id: "tree-plantation",
    title: "Tree Plantation & Greening Drive",
    category: "Environment",
    src: treePlantationImg,
    alt: "Planting saplings for a greener future",
    pos: "top-left"
  },
  {
    id: "school-support",
    title: "School Support Program",
    category: "Education",
    date: "12 Aug 2025",
    location: "Govt. Middle School",
    src: schoolSupportImg,
    alt: "School Support Program",
    isFeatured: true,
    pos: "top-middle"
  },
  {
    id: "env-day",
    title: "World Environment Day",
    category: "Environment",
    src: envDayPoster,
    alt: "HOPE World Environment Day",
    pos: "top-right-1"
  },
  {
    id: "doctors-day",
    title: "Healthcare & Doctor's Day Camp",
    category: "Awareness",
    src: doctorsDayImg,
    alt: "Doctors Day event",
    pos: "top-right-2"
  },
  {
    id: "community-gift",
    title: "Community Outreach & Support",
    category: "Community",
    src: giftDistImg,
    alt: "Distribution drive",
    pos: "top-right-3"
  },
  {
    id: "student-mentorship",
    title: "Student Empowerment",
    category: "Education",
    src: kidsYellow,
    alt: "Children receiving support",
    pos: "top-right-4"
  },
  {
    id: "indoor-kids",
    title: "Primary Education Support",
    category: "Education",
    src: indoorKids,
    alt: "Indoor education distribution",
    pos: "bottom-left"
  },
  {
    id: "cycle-rally",
    title: "Pedal for Planet Rally",
    category: "Events",
    src: cyclingImg,
    alt: "Cycling rally for climate awareness",
    pos: "bottom-middle"
  },
  {
    id: "science-fair",
    title: "Nagapattinam Science Competition",
    category: "Awareness",
    src: scienceCompImg,
    alt: "Science competition fair",
    pos: "bottom-right"
  }
];

const LeafBranchLeft = () => (
  <svg className="w-20 h-28 md:w-32 md:h-40 text-emerald-600/20 dark:text-emerald-400/20" viewBox="0 0 100 140" fill="currentColor">
    <path d="M80 130 Q 60 80 20 20" stroke="currentColor" strokeWidth="3" fill="none" strokeLinecap="round" />
    <path d="M20 20 Q 5 15 10 35 Q 25 40 20 20" fill="currentColor" />
    <path d="M40 50 Q 15 40 20 65 Q 45 70 40 50" fill="currentColor" />
    <path d="M60 85 Q 35 75 40 100 Q 65 105 60 85" fill="currentColor" />
    <path d="M45 55 Q 65 35 75 55 Q 60 70 45 55" fill="currentColor" />
    <path d="M65 90 Q 85 70 95 90 Q 80 105 65 90" fill="currentColor" />
  </svg>
);

const LeafBranchRight = () => (
  <svg className="w-20 h-28 md:w-32 md:h-40 text-emerald-600/20 dark:text-emerald-400/20 transform scale-x-[-1]" viewBox="0 0 100 140" fill="currentColor">
    <path d="M80 130 Q 60 80 20 20" stroke="currentColor" strokeWidth="3" fill="none" strokeLinecap="round" />
    <path d="M20 20 Q 5 15 10 35 Q 25 40 20 20" fill="currentColor" />
    <path d="M40 50 Q 15 40 20 65 Q 45 70 40 50" fill="currentColor" />
    <path d="M60 85 Q 35 75 40 100 Q 65 105 60 85" fill="currentColor" />
    <path d="M45 55 Q 65 35 75 55 Q 60 70 45 55" fill="currentColor" />
    <path d="M65 90 Q 85 70 95 90 Q 80 105 65 90" fill="currentColor" />
  </svg>
);

const PhotoGallery = () => {
  const [activeTab, setActiveTab] = useState("All");
  const [selected, setSelected] = useState(null);

  const filteredItems = activeTab === "All"
    ? allItems
    : allItems.filter((item) => item.category === activeTab);

  const navigate = (dir) => {
    if (selected === null) return;
    setSelected((selected + dir + filteredItems.length) % filteredItems.length);
  };

  const featuredItem = allItems.find((i) => i.isFeatured);
  const topLeftItem = allItems.find((i) => i.pos === "top-left");
  const subGridItems = allItems.filter((i) => i.pos.startsWith("top-right"));
  const bottomItems = allItems.filter((i) => i.pos.startsWith("bottom"));

  return (
    <section className="py-24 bg-background relative overflow-hidden">
      {/* Decorative leaf branch vectors */}
      <div className="absolute top-10 left-4 md:left-12 pointer-events-none z-0">
        <LeafBranchLeft />
      </div>
      <div className="absolute top-10 right-4 md:right-12 pointer-events-none z-0">
        <LeafBranchRight />
      </div>

      <div className="w-full px-4 md:px-10 max-w-7xl mx-auto relative z-10">
        {/* Section Heading */}
        <div className="text-center max-w-3xl mx-auto mb-10">
          <span className="text-emerald-700 dark:text-emerald-400 font-bold text-xs uppercase tracking-[0.25em] block mb-2">
            OUR IMPACT
          </span>
          <h2 className="font-heading text-3xl md:text-5xl font-extrabold text-foreground tracking-tight">
            Moments That Made a Difference
          </h2>

          {/* Leaf Divider */}
          <div className="flex items-center justify-center gap-3 my-4">
            <div className="h-[2px] w-12 bg-amber-400/80 rounded-full" />
            <div className="w-8 h-8 rounded-full bg-emerald-100 dark:bg-emerald-950 flex items-center justify-center text-emerald-600 dark:text-emerald-400 shadow-sm">
              <Leaf className="w-4 h-4 fill-emerald-600 dark:fill-emerald-400" />
            </div>
            <div className="h-[2px] w-12 bg-amber-400/80 rounded-full" />
          </div>

          <p className="text-muted-foreground text-sm md:text-base leading-relaxed">
            Explore the activities, events and smiles that reflect our journey of creating a better and brighter future for our community.
          </p>
        </div>

        {/* Filter Category Tabs */}
        <div className="flex flex-wrap justify-center gap-2.5 md:gap-3 mb-12">
          {categories.map((cat) => {
            const isActive = activeTab === cat;
            return (
              <button
                key={cat}
                onClick={() => setActiveTab(cat)}
                className={`px-5 py-2 rounded-full text-xs md:text-sm font-semibold transition-all duration-300 ${
                  isActive
                    ? "bg-[#064e3b] text-white shadow-md border border-[#064e3b]"
                    : "bg-card border border-border text-foreground/80 hover:bg-emerald-50 dark:hover:bg-emerald-950/40 hover:border-emerald-200"
                }`}
              >
                {cat}
              </button>
            );
          })}
        </div>

        {/* Gallery Content */}
        {activeTab === "All" ? (
          /* Bento Grid matching mockup */
          <div className="space-y-5">
            {/* Top Row: 3 main columns */}
            <div className="grid grid-cols-1 lg:grid-cols-12 gap-5">
              {/* Top Left: Environment / Tree Plantation */}
              <motion.div
                whileHover={{ scale: 1.01 }}
                transition={{ duration: 0.3 }}
                onClick={() => setSelected(filteredItems.findIndex((i) => i.id === topLeftItem.id))}
                className="lg:col-span-4 h-[320px] md:h-[380px] rounded-2xl overflow-hidden cursor-pointer relative group shadow-sm border border-border/50"
              >
                <img
                  src={topLeftItem.src}
                  alt={topLeftItem.alt}
                  className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-5">
                  <span className="text-white font-semibold text-sm">{topLeftItem.title}</span>
                </div>
              </motion.div>

              {/* Top Middle: School Support Card */}
              <motion.div
                whileHover={{ scale: 1.01 }}
                transition={{ duration: 0.3 }}
                onClick={() => setSelected(filteredItems.findIndex((i) => i.id === featuredItem.id))}
                className="lg:col-span-4 h-[320px] md:h-[380px] rounded-2xl overflow-hidden cursor-pointer relative group shadow-sm border border-border/50"
              >
                <img
                  src={featuredItem.src}
                  alt={featuredItem.alt}
                  className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-5">
                  <span className="text-white font-semibold text-sm">{featuredItem.title}</span>
                </div>
              </motion.div>

              {/* Top Right: 2x2 Sub-grid */}
              <div className="lg:col-span-4 grid grid-cols-2 gap-3.5 h-[320px] md:h-[380px]">
                {subGridItems.map((item) => (
                  <motion.div
                    key={item.id}
                    whileHover={{ scale: 1.02 }}
                    transition={{ duration: 0.3 }}
                    onClick={() => setSelected(filteredItems.findIndex((i) => i.id === item.id))}
                    className="rounded-2xl overflow-hidden cursor-pointer relative group border border-border/50 shadow-sm"
                  >
                    <img
                      src={item.src}
                      alt={item.alt}
                      className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                    />
                    <div className="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-3">
                      <span className="text-white font-medium text-xs truncate">{item.title}</span>
                    </div>
                  </motion.div>
                ))}
              </div>
            </div>

            {/* Bottom Row: 3 Equal Columns */}
            <div className="grid grid-cols-1 md:grid-cols-3 gap-5">
              {bottomItems.map((item) => (
                <motion.div
                  key={item.id}
                  whileHover={{ scale: 1.01 }}
                  transition={{ duration: 0.3 }}
                  onClick={() => setSelected(filteredItems.findIndex((i) => i.id === item.id))}
                  className="h-[220px] md:h-[260px] rounded-2xl overflow-hidden cursor-pointer relative group border border-border/50 shadow-sm"
                >
                  <img
                    src={item.src}
                    alt={item.alt}
                    className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                  />
                  <div className="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                    <span className="text-white font-medium text-sm">{item.title}</span>
                  </div>
                </motion.div>
              ))}
            </div>
          </div>
        ) : (
          /* Filtered Items Grid */
          <motion.div
            variants={staggerContainer}
            initial="hidden"
            animate="show"
            className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"
          >
            {filteredItems.map((item, idx) => (
              <motion.div
                key={item.id}
                variants={staggerItem}
                whileHover={{ y: -4 }}
                onClick={() => setSelected(idx)}
                className="h-[280px] rounded-2xl overflow-hidden cursor-pointer relative group border border-border/50 shadow-sm"
              >
                <img
                  src={item.src}
                  alt={item.alt}
                  className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent p-5 flex flex-col justify-end">
                  <span className="bg-emerald-600 text-white font-bold text-[10px] px-2.5 py-0.5 rounded-full w-max mb-1.5">
                    {item.category}
                  </span>
                  <span className="text-white font-semibold text-base">{item.title}</span>
                </div>
              </motion.div>
            ))}
          </motion.div>
        )}

        {/* View All Activities Button */}
        <div className="text-center mt-12">
          <button
            onClick={() => setActiveTab("All")}
            className="inline-flex items-center gap-2 border-2 border-emerald-700/30 text-emerald-800 dark:text-emerald-300 hover:bg-emerald-700 hover:text-white px-8 py-3 rounded-full text-sm font-semibold transition-all duration-300 shadow-sm"
          >
            View All Activities <ArrowRight className="w-4 h-4" />
          </button>
        </div>
      </div>

      {/* Lightbox Modal */}
      <AnimatePresence>
        {selected !== null && filteredItems[selected] && (
          <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            className="fixed inset-0 z-[80] flex items-center justify-center p-4"
            onClick={() => setSelected(null)}
          >
            <div className="absolute inset-0 bg-black/90 backdrop-blur-md" />

            {/* Close Button */}
            <motion.button
              className="absolute top-6 right-6 z-10 w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors"
              onClick={() => setSelected(null)}
              whileHover={{ scale: 1.1 }}
              whileTap={{ scale: 0.9 }}
            >
              <X className="h-5 w-5" />
            </motion.button>

            {/* Prev Button */}
            <motion.button
              className="absolute left-4 md:left-8 z-10 w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors"
              onClick={(e) => {
                e.stopPropagation();
                navigate(-1);
              }}
              whileHover={{ scale: 1.1 }}
              whileTap={{ scale: 0.9 }}
            >
              <ChevronLeft className="h-5 w-5" />
            </motion.button>

            {/* Next Button */}
            <motion.button
              className="absolute right-4 md:right-8 z-10 w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors"
              onClick={(e) => {
                e.stopPropagation();
                navigate(1);
              }}
              whileHover={{ scale: 1.1 }}
              whileTap={{ scale: 0.9 }}
            >
              <ChevronRight className="h-5 w-5" />
            </motion.button>

            {/* Image & Caption */}
            <motion.div
              key={selected}
              initial={{ opacity: 0, scale: 0.95 }}
              animate={{ opacity: 1, scale: 1 }}
              exit={{ opacity: 0, scale: 0.95 }}
              transition={{ duration: 0.2 }}
              className="relative z-10 max-w-4xl max-h-[85vh] flex flex-col items-center justify-center"
              onClick={(e) => e.stopPropagation()}
            >
              <img
                src={filteredItems[selected].src}
                alt={filteredItems[selected].alt}
                className="max-w-full max-h-[75vh] object-contain rounded-2xl shadow-2xl"
              />
              <div className="text-center mt-4 space-y-1">
                <span className="bg-emerald-600 text-white text-[11px] font-bold px-3 py-1 rounded-full inline-block">
                  {filteredItems[selected].category}
                </span>
                <p className="text-white font-heading text-xl font-bold">
                  {filteredItems[selected].title}
                </p>
              </div>
            </motion.div>
          </motion.div>
        )}
      </AnimatePresence>
    </section>
  );
};

export default PhotoGallery;
