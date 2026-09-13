import heroBg from "@/assets/hero-bg.jpg";
import bookDistributionImg from "@/assets/activits/Book given to students/b2.png";
import beachCleanImg from "@/assets/activits/nagore beach clean/n1.jpeg";
import doctorsDayImg from "@/assets/activits/DOCTERS ADY/d1.png";
import treePlantationImg from "@/assets/activits/tree plantaion/t1.png";
import { FloatingParticles } from "./AnimationEffects";

const collageImages = [
  heroBg, bookDistributionImg, beachCleanImg, doctorsDayImg, treePlantationImg, heroBg,
  doctorsDayImg, beachCleanImg, bookDistributionImg, treePlantationImg, heroBg, doctorsDayImg,
  treePlantationImg, heroBg, beachCleanImg, bookDistributionImg, doctorsDayImg, beachCleanImg,
  heroBg, bookDistributionImg, treePlantationImg, doctorsDayImg, beachCleanImg, heroBg
];

const HeroBackground = () => (
  <>
    <div className="absolute inset-0 overflow-hidden pointer-events-none z-0">
      {/* Photo collage grid */}
      <div className="absolute inset-0 grid grid-cols-4 md:grid-cols-6 gap-1 opacity-50">
        {collageImages.map((img, i) => (
          <div key={i} className="aspect-square overflow-hidden">
            <img src={img} alt="" className="w-full h-full object-cover" loading="lazy" />
          </div>
        ))}
      </div>
      {/* Gradient overlays matching Home page */}
      <div className="absolute inset-0 bg-gradient-hero" />
      <div className="absolute inset-0 bg-dot-grid opacity-20" />
      <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[400px] bg-amber-600/15 rounded-full blur-3xl" />
      <div className="absolute bottom-0 left-0 right-0 h-48 bg-gradient-to-t from-amber-950/30 to-transparent" />
    </div>
    <FloatingParticles />
  </>
);

export default HeroBackground;
