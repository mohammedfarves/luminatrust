const MarqueeRibbon = () => {
  return (
    <div className="w-full bg-gradient-to-r from-amber-500 via-amber-400 to-amber-500 py-3 text-amber-950 font-black text-xs sm:text-sm tracking-widest uppercase shadow-lg border-y border-white/20 select-none overflow-hidden relative z-20">
      <div className="animate-marquee gap-8 whitespace-nowrap">
        {/* Track 1 */}
        <div className="flex items-center gap-8 shrink-0">
          <span className="flex items-center gap-2">✨ 10,000+ BENEFICIARIES UPLIFTED</span>
          <span className="opacity-40">•</span>
          <span className="flex items-center gap-2">📚 FREE SCHOOL BOOKS & STUDY KITS</span>
          <span className="opacity-40">•</span>
          <span className="flex items-center gap-2">🩺 FREE COMMUNITY HEALTH CAMPS</span>
          <span className="opacity-40">•</span>
          <span className="flex items-center gap-2">🌱 5,000+ TREES PLANTING DRIVE</span>
          <span className="opacity-40">•</span>
          <span className="flex items-center gap-2">🌊 NAGORE BEACH CLEANUP & ECO INITIATIVE</span>
          <span className="opacity-40">•</span>
        </div>

        {/* Track 2 (Duplicate for Seamless Loop) */}
        <div className="flex items-center gap-8 shrink-0">
          <span className="flex items-center gap-2">✨ 10,000+ BENEFICIARIES UPLIFTED</span>
          <span className="opacity-40">•</span>
          <span className="flex items-center gap-2">📚 FREE SCHOOL BOOKS & STUDY KITS</span>
          <span className="opacity-40">•</span>
          <span className="flex items-center gap-2">🩺 FREE COMMUNITY HEALTH CAMPS</span>
          <span className="opacity-40">•</span>
          <span className="flex items-center gap-2">🌱 5,000+ TREES PLANTING DRIVE</span>
          <span className="opacity-40">•</span>
          <span className="flex items-center gap-2">🌊 NAGORE BEACH CLEANUP & ECO INITIATIVE</span>
          <span className="opacity-40">•</span>
        </div>
      </div>
    </div>
  );
};

export default MarqueeRibbon;
