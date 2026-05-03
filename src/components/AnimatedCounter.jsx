import { useEffect, useState, useRef } from "react";
import { motion, useInView } from "framer-motion";

const AnimatedCounter = ({ end, suffix = "", label, icon }) => {
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
      <div className="text-lime mb-4 flex justify-center">{icon}</div>
      <div className="font-heading text-5xl md:text-6xl lg:text-7xl text-primary-foreground">
        {count.toLocaleString()}{suffix}
      </div>
      <p className="text-primary-foreground/60 mt-3 text-sm font-medium uppercase tracking-wider">{label}</p>
    </motion.div>
  );
};

export default AnimatedCounter;
