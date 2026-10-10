import { useEffect, useState, useRef } from "react";
import { motion, useInView } from "framer-motion";

const AnimatedCounter = ({ end, suffix = "", label, icon, light = false }) => {
  const [count, setCount] = useState(0);
  const ref = useRef(null);
  const inView = useInView(ref, { once: true });

  useEffect(() => {
    if (!inView) return;
    let start = 0;
    const duration = 2000;
    const step = end / (duration / 16);
    const timer = setInterval(() => {
      start += step;
      if (start >= end) {
        setCount(end);
        clearInterval(timer);
      } else {
        setCount(Math.floor(start));
      }
    }, 16);
    return () => clearInterval(timer);
  }, [inView, end]);

  return (
    <motion.div
      ref={ref}
      initial={{ opacity: 0, y: 30 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true }}
      transition={{ duration: 0.5 }}
      className="text-center"
    >
      <div className="mb-4 flex justify-center">{icon}</div>
      <div className={`font-heading text-4xl sm:text-5xl md:text-6xl font-extrabold ${light ? "text-slate-900 dark:text-white" : "text-amber-400 drop-shadow-sm"}`}>
        {count.toLocaleString()}{suffix}
      </div>
      <p className={`mt-3 text-xs sm:text-sm font-bold uppercase tracking-wider ${light ? "text-slate-600 dark:text-slate-300" : "text-white/85"}`}>
        {label}
      </p>
    </motion.div>
  );
};

export default AnimatedCounter;
