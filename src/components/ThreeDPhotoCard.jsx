import React, { useState } from "react";
import { motion } from "framer-motion";
import { Sparkles, ArrowRight, Heart, Users, BookOpen } from "lucide-react";
import bookDistributionImg from "@/assets/activits/Book given to students/b2.png";

const ThreeDPhotoCard = () => {
  const [isHovered, setIsHovered] = useState(false);

  return (
    <div 
      className="relative w-full max-w-[340px] sm:max-w-[360px] h-[440px] select-none cursor-pointer"
      style={{ perspective: "1000px" }}
      onMouseEnter={() => setIsHovered(true)}
      onMouseLeave={() => setIsHovered(false)}
    >
      {/* Main 3D Card Base */}
      <motion.div
        animate={{
          rotateX: isHovered ? 12 : 0,
          rotateY: isHovered ? -12 : 0,
          scale: isHovered ? 1.03 : 1,
        }}
        transition={{ type: "spring", stiffness: 200, damping: 20 }}
        className="w-full h-full rounded-[45px] relative overflow-hidden shadow-[0_25px_50px_-12px_rgba(15,23,42,0.35)] transition-shadow duration-500"
        style={{
          transformStyle: "preserve-3d",
          background: "linear-gradient(135deg, #F59E0B 0%, #10B981 60%, #0D9488 100%)",
        }}
      >
        {/* 3D Glass Surface Layer */}
        <motion.div
          animate={{ translateZ: isHovered ? 35 : 20 }}
          transition={{ duration: 0.4 }}
          className="absolute inset-2.5 rounded-[36px] bg-gradient-to-b from-white/95 via-white/85 to-white/95 dark:from-slate-900/95 dark:via-slate-900/90 dark:to-slate-900/95 backdrop-blur-xl border border-white/60 dark:border-slate-700/60 shadow-inner flex flex-col justify-between p-5 overflow-hidden"
          style={{ transformStyle: "preserve-3d" }}
        >
          {/* Main Photo Frame inside the 3D Glass Layer */}
          <div className="relative w-full h-[230px] rounded-[30px] overflow-hidden border-2 border-white/80 dark:border-slate-800 shadow-md mt-2">
            <img
              src={bookDistributionImg}
              alt="Lumina Trust Community Impact"
              className="w-full h-full object-cover transform hover:scale-108 transition-transform duration-700"
            />
            <div className="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent" />
            <div className="absolute bottom-3 left-4 right-4">
              <span className="inline-block px-3 py-1 rounded-full bg-amber-400 text-amber-950 font-bold text-[10px] tracking-wider uppercase shadow-md mb-1">
                Grassroots Impact
              </span>
              <p className="text-white text-xs font-bold font-serif leading-snug">
                Student Book Distribution Drive
              </p>
            </div>
          </div>

          {/* Card Content Text (3D Translated) */}
          <motion.div
            animate={{ translateZ: isHovered ? 45 : 25 }}
            transition={{ duration: 0.4 }}
            className="mt-3 px-1"
          >
            <span className="block text-emerald-800 dark:text-emerald-400 font-extrabold text-lg leading-tight font-serif tracking-tight">
              Lumina Trust
            </span>
            <span className="block text-slate-600 dark:text-slate-300 text-xs mt-1.5 leading-relaxed font-normal">
              Transforming lives through education, healthcare, and sustainable community empowerment across Tamil Nadu.
            </span>
          </motion.div>

          {/* Bottom Bar: Action buttons & 3D floating icons */}
          <motion.div
            animate={{ translateZ: isHovered ? 55 : 30 }}
            transition={{ duration: 0.4 }}
            className="pt-3 border-t border-slate-200/60 dark:border-slate-800/80 flex items-center justify-between mt-auto"
          >
            {/* Left Social/Pill Buttons */}
            <div className="flex items-center gap-2">
              <motion.div 
                whileHover={{ scale: 1.15 }}
                className="w-8 h-8 rounded-full bg-amber-100 dark:bg-amber-950/80 text-amber-700 dark:text-amber-300 flex items-center justify-center shadow-sm border border-amber-200/50"
              >
                <Heart className="w-4 h-4 fill-amber-500 stroke-amber-600" />
              </motion.div>

              <motion.div 
                whileHover={{ scale: 1.15 }}
                className="w-8 h-8 rounded-full bg-emerald-100 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300 flex items-center justify-center shadow-sm border border-emerald-200/50"
              >
                <BookOpen className="w-4 h-4" />
              </motion.div>

              <motion.div 
                whileHover={{ scale: 1.15 }}
                className="w-8 h-8 rounded-full bg-sky-100 dark:bg-sky-950/80 text-sky-700 dark:text-sky-300 flex items-center justify-center shadow-sm border border-sky-200/50"
              >
                <Users className="w-4 h-4" />
              </motion.div>
            </div>

            {/* Right Action Button */}
            <motion.div 
              whileHover={{ x: 4, scale: 1.05 }}
              className="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 dark:text-emerald-400 hover:text-emerald-800 tracking-wider uppercase"
            >
              <span>Explore</span>
              <ArrowRight className="w-3.5 h-3.5" />
            </motion.div>
          </motion.div>
        </motion.div>
      </motion.div>
    </div>
  );
};

export default ThreeDPhotoCard;
