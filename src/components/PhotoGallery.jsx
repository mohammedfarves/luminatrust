import { useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { X, ChevronLeft, ChevronRight } from "lucide-react";
import SectionHeading from "@/components/SectionHeading";
import { staggerContainer, staggerItem } from "@/components/AnimationEffects";

import galleryCommunity from "@/assets/gallery-community.jpg";
import galleryEducation from "@/assets/gallery-education.jpg";
import galleryWater from "@/assets/gallery-water.jpg";
import galleryHealth from "@/assets/gallery-health.jpg";
import galleryEnvironment from "@/assets/gallery-environment.jpg";
import galleryWomen from "@/assets/gallery-women.jpg";

import sparrow1 from "@/assets/events/sparrow-event-1.jpeg";
import sparrow2 from "@/assets/events/sparrow-event-2.jpeg";
import sparrow3 from "@/assets/events/sparrow-event-3.jpeg";
import sparrow4 from "@/assets/events/sparrow-event-4.jpeg";
import sparrow5 from "@/assets/events/sparrow-event-5.jpeg";
import sparrow6 from "@/assets/events/sparrow-event-6.jpeg";
import sparrow7 from "@/assets/events/sparrow-event-7.jpeg";
import sparrow8 from "@/assets/events/sparrow-event-8.jpeg";
import sparrow9 from "@/assets/events/sparrow-event-9.jpeg";
const photos = [
  { src: galleryCommunity, alt: "Community gathering", caption: "Community Empowerment" },
  { src: galleryEducation, alt: "Children learning", caption: "Education Programs" },
  { src: galleryWater, alt: "Clean water project", caption: "Clean Water Initiative" },
  { src: galleryHealth, alt: "Healthcare camp", caption: "Healthcare Outreach" },
  { src: galleryEnvironment, alt: "Tree planting", caption: "Environmental Action" },
  { src: galleryWomen, alt: "Women empowerment", caption: "Women Empowerment" },
  { src: sparrow1, alt: "Sparrow Day Celebration", caption: "Sparrow Day Activity" },
  { src: sparrow2, alt: "Sparrow Day Celebration", caption: "Sparrow Day Activity" },
  { src: sparrow3, alt: "Sparrow Day Celebration", caption: "Sparrow Day Activity" },
  { src: sparrow4, alt: "Sparrow Day Celebration", caption: "Sparrow Day Activity" },
  { src: sparrow5, alt: "Sparrow Day Celebration", caption: "Sparrow Day Activity" },
  { src: sparrow6, alt: "Sparrow Day Celebration", caption: "Sparrow Day Activity" },
  { src: sparrow7, alt: "Sparrow Day Celebration", caption: "Sparrow Day Activity" },
  { src: sparrow8, alt: "Sparrow Day Celebration", caption: "Sparrow Day Activity" },
  { src: sparrow9, alt: "Sparrow Day Celebration", caption: "Sparrow Day Activity" },
];

const PhotoGallery = () => {
  const [selected, setSelected] = useState(null);

  const navigate = (dir) => {
    if (selected === null) return;
    setSelected((selected + dir + photos.length) % photos.length);
  };

  return (
    <section className="py-28 bg-warm">
      <div className="w-full px-6 md:px-10 max-w-6xl mx-auto">
        <SectionHeading
          subtitle="Impact in Action"
          title="Community Gallery"
          description="Moments that capture the heart of our mission."
        />

        <motion.div
          variants={staggerContainer}
          initial="hidden"
          whileInView="show"
          viewport={{ once: true }}
          className="grid grid-cols-2 md:grid-cols-3 gap-4"
        >
          {photos.map((photo, i) => (
            <motion.div
              key={i}
              variants={staggerItem}
              className={`relative overflow-hidden rounded-2xl cursor-pointer group ${
                i === 2 || i === 5 ? "row-span-2" : ""
              }`}
              onClick={() => setSelected(i)}
              whileHover={{ scale: 1.02 }}
              transition={{ type: "spring", stiffness: 300, damping: 20 }}
            >
              <img
                src={photo.src}
                alt={photo.alt}
                className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                loading="lazy"
              />
              <div className="absolute inset-0 bg-gradient-to-t from-foreground/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-5">
                <span className="text-primary-foreground font-heading text-xl">{photo.caption}</span>
              </div>
            </motion.div>
          ))}
        </motion.div>
      </div>

      <AnimatePresence>
        {selected !== null && (
          <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            className="fixed inset-0 z-[80] flex items-center justify-center"
            onClick={() => setSelected(null)}
          >
            <div className="absolute inset-0 bg-foreground/90 backdrop-blur-md" />

            <motion.button
              className="absolute top-6 right-6 z-10 w-10 h-10 rounded-full bg-primary-foreground/10 flex items-center justify-center text-primary-foreground hover:bg-primary-foreground/20 transition-colors"
              onClick={() => setSelected(null)}
              whileHover={{ scale: 1.1 }}
              whileTap={{ scale: 0.9 }}
            >
              <X className="h-5 w-5" />
            </motion.button>

            <motion.button
              className="absolute left-4 md:left-8 z-10 w-10 h-10 rounded-full bg-primary-foreground/10 flex items-center justify-center text-primary-foreground hover:bg-primary-foreground/20 transition-colors"
              onClick={(e) => { e.stopPropagation(); navigate(-1); }}
              whileHover={{ scale: 1.1 }}
              whileTap={{ scale: 0.9 }}
            >
              <ChevronLeft className="h-5 w-5" />
            </motion.button>

            <motion.button
              className="absolute right-4 md:right-8 z-10 w-10 h-10 rounded-full bg-primary-foreground/10 flex items-center justify-center text-primary-foreground hover:bg-primary-foreground/20 transition-colors"
              onClick={(e) => { e.stopPropagation(); navigate(1); }}
              whileHover={{ scale: 1.1 }}
              whileTap={{ scale: 0.9 }}
            >
              <ChevronRight className="h-5 w-5" />
            </motion.button>

            <motion.div
              key={selected}
              initial={{ opacity: 0, scale: 0.9 }}
              animate={{ opacity: 1, scale: 1 }}
              exit={{ opacity: 0, scale: 0.9 }}
              transition={{ duration: 0.3 }}
              className="relative z-10 max-w-4xl max-h-[80vh] mx-4"
              onClick={(e) => e.stopPropagation()}
            >
              <img
                src={photos[selected].src}
                alt={photos[selected].alt}
                className="w-full h-full object-contain rounded-xl"
              />
              <motion.p
                initial={{ opacity: 0, y: 10 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: 0.2 }}
                className="text-primary-foreground text-center mt-4 font-heading text-2xl"
              >
                {photos[selected].caption}
              </motion.p>
            </motion.div>
          </motion.div>
        )}
      </AnimatePresence>
    </section>
  );
};

export default PhotoGallery;
