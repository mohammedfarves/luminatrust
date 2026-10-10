import { motion } from "framer-motion";
import heroBg from "@/assets/hero-bg.jpg";
import bookDistributionImg from "@/assets/activits/Book given to students/b2.png";
import beachCleanImg from "@/assets/activits/nagore beach clean/WhatsApp Image 2026-09-01 at 1.55.01 PM.jpeg";
import doctorsDayImg from "@/assets/activits/DOCTERS ADY/WhatsApp Image 2026-09-01 at 2.01.14 PM.jpeg";
import treePlantationImg from "@/assets/activits/tree plantaion/t1.png";
import cycleRallyImg from "@/assets/activits/CYCLEING/c1.jpeg";
import { FloatingParticles } from "./AnimationEffects";

const collageImages = [
  heroBg, bookDistributionImg, beachCleanImg, doctorsDayImg, treePlantationImg, cycleRallyImg,
  doctorsDayImg, treePlantationImg, heroBg, bookDistributionImg, cycleRallyImg, beachCleanImg,
  bookDistributionImg, heroBg, beachCleanImg, treePlantationImg, doctorsDayImg, cycleRallyImg,
  cycleRallyImg, beachCleanImg, doctorsDayImg, heroBg, bookDistributionImg, treePlantationImg
];

const HeroBackground = () => (
  <>
    <div className="absolute inset-0 overflow-hidden pointer-events-none select-none z-0">
      {/* Gapless Animated Photo Wall Grid with Motion & Soft Blur */}
      <motion.div 
        animate={{ 
          scale: [1.05, 1.12, 1.05],
          y: [0, -25, 0],
          x: [0, 15, 0]
        }}
        transition={{ 
          duration: 22, 
          repeat: Infinity, 
          ease: "easeInOut" 
        }}
        className="absolute -inset-10 grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-6 gap-0 opacity-60 filter blur-[2px] brightness-110 contrast-110"
      >
        {collageImages.map((img, i) => (
          <div key={i} className="aspect-[4/3] overflow-hidden">
            <img src={img} alt="" className="w-full h-full object-cover transform scale-105" loading="lazy" />
          </div>
        ))}
      </motion.div>

      {/* Matching Ambient Dark Gradients for Clarity and High Readability */}
      <div className="absolute inset-0 bg-gradient-to-r from-[#0A0E17]/90 via-[#0A0E17]/70 to-[#0A0E17]/40" />
      <div className="absolute inset-0 bg-gradient-to-t from-[#0A0E17] via-[#0A0E17]/30 to-[#0A0E17]/60" />
      <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[400px] bg-amber-500/15 rounded-full blur-3xl" />
      <div className="absolute bottom-0 left-0 right-0 h-48 bg-gradient-to-t from-[#0A0E17] to-transparent" />
    </div>

    {/* Smooth Organic Bottom Wave Divider */}
    <div className="absolute bottom-0 left-0 right-0 overflow-hidden leading-none z-10 pointer-events-none">
      <svg viewBox="0 0 1200 120" preserveAspectRatio="none" className="relative block w-full h-10 md:h-14 text-[#FBF9F5] dark:text-slate-950 fill-current">
        <path d="M0,0 C150,90 350,-40 500,60 C650,160 900,10 1200,40 L1200,120 L0,120 Z" />
      </svg>
    </div>

    <FloatingParticles />
  </>
);

export default HeroBackground;
