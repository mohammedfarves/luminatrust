import { useState, useEffect } from "react";
import { motion, AnimatePresence } from "framer-motion";
import luminaLogo from "@/assets/iconlumina.png";

const Preloader = ({ onComplete }) => {
  const [progress, setProgress] = useState(0);
  const [phase, setPhase] = useState("loading");

  useEffect(() => {
    const interval = setInterval(() => {
      setProgress((prev) => {
        if (prev >= 100) {
          clearInterval(interval);
          setPhase("reveal");
          setTimeout(onComplete, 1200);
          return 100;
        }
        return prev + Math.random() * 8 + 2;
      });
    }, 80);
    return () => clearInterval(interval);
  }, [onComplete]);

  return (
    <AnimatePresence>
      {phase !== "reveal" || progress <= 100 ? (
        <motion.div
          className="fixed inset-0 z-[100] flex items-center justify-center"
          style={{ background: "linear-gradient(135deg, #0a1628 0%, #0d2847 40%, #1a3a5c 70%, #0a1628 100%)" }}
          exit={{ opacity: 0 }}
          transition={{ duration: 0.8, ease: "easeInOut" }}
        >
          {[...Array(5)].map((_, i) => (
            <motion.div
              key={i}
              className="absolute rounded-full"
              style={{
                width: 200 + i * 80,
                height: 200 + i * 80,
                background: `radial-gradient(circle, rgba(59,130,246,${0.08 - i * 0.012}) 0%, transparent 70%)`,
              }}
              animate={{
                x: [0, 30 * Math.sin(i), -20 * Math.cos(i), 0],
                y: [0, -20 * Math.cos(i), 30 * Math.sin(i), 0],
                scale: [1, 1.15, 0.95, 1],
              }}
              transition={{ duration: 6 + i, repeat: Infinity, ease: "easeInOut" }}
            />
          ))}

          <motion.div
            className="absolute w-48 h-48 rounded-full border border-blue-500/20"
            animate={{ rotate: 360 }}
            transition={{ duration: 8, repeat: Infinity, ease: "linear" }}
          />
          <motion.div
            className="absolute w-56 h-56 rounded-full border border-blue-400/10"
            animate={{ rotate: -360 }}
            transition={{ duration: 12, repeat: Infinity, ease: "linear" }}
          />

          {[...Array(8)].map((_, i) => {
            const angle = (i / 8) * Math.PI * 2;
            const radius = 100;
            return (
              <motion.div
                key={`dot-${i}`}
                className="absolute w-1.5 h-1.5 rounded-full bg-blue-400"
                style={{
                  left: `calc(50% + ${Math.cos(angle) * radius}px)`,
                  top: `calc(50% + ${Math.sin(angle) * radius}px)`,
                }}
                animate={{
                  opacity: [0.2, 1, 0.2],
                  scale: [0.8, 1.4, 0.8],
                }}
                transition={{
                  duration: 2,
                  repeat: Infinity,
                  delay: i * 0.25,
                  ease: "easeInOut",
                }}
              />
            );
          })}

          <div className="relative flex flex-col items-center">
            <motion.div
              className="relative mb-8"
              initial={{ scale: 0, opacity: 0 }}
              animate={{ scale: 1, opacity: 1 }}
              transition={{ duration: 0.8, ease: [0.16, 1, 0.3, 1] }}
            >
              <motion.div
                className="absolute inset-0 rounded-full blur-2xl"
                style={{ background: "radial-gradient(circle, rgba(59,130,246,0.3) 0%, transparent 70%)" }}
                animate={{ scale: [1, 1.3, 1], opacity: [0.5, 0.8, 0.5] }}
                transition={{ duration: 3, repeat: Infinity, ease: "easeInOut" }}
              />
              <motion.img
                src={luminaLogo}
                alt="Lumina Trust"
                className="relative w-24 h-24 object-contain drop-shadow-[0_0_30px_rgba(59,130,246,0.4)]"
                animate={{ y: [0, -6, 0] }}
                transition={{ duration: 3, repeat: Infinity, ease: "easeInOut" }}
              />
            </motion.div>

            <motion.h1
              className="text-3xl font-heading tracking-[0.3em] uppercase mb-2"
              style={{ color: "#e2e8f0" }}
              initial={{ opacity: 0, y: 20, letterSpacing: "0.6em" }}
              animate={{ opacity: 1, y: 0, letterSpacing: "0.3em" }}
              transition={{ duration: 1, delay: 0.4, ease: "easeOut" }}
            >
              Lumina Trust
            </motion.h1>

            <motion.p
              className="text-sm tracking-[0.5em] uppercase mb-10"
              style={{ color: "rgba(148,163,184,0.7)" }}
              initial={{ opacity: 0 }}
              animate={{ opacity: 1 }}
              transition={{ duration: 0.8, delay: 0.8 }}
            >
              Empowering Lives
            </motion.p>

            <div className="w-48 h-[2px] rounded-full overflow-hidden" style={{ background: "rgba(59,130,246,0.15)" }}>
              <motion.div
                className="h-full rounded-full"
                style={{
                  width: `${Math.min(progress, 100)}%`,
                  background: "linear-gradient(90deg, #3b82f6, #60a5fa, #93c5fd)",
                  boxShadow: "0 0 12px rgba(59,130,246,0.5)",
                }}
                transition={{ duration: 0.1 }}
              />
            </div>

            <motion.span
              className="mt-3 text-xs font-body tabular-nums"
              style={{ color: "rgba(148,163,184,0.5)" }}
              initial={{ opacity: 0 }}
              animate={{ opacity: 1 }}
              transition={{ delay: 0.6 }}
            >
              {Math.min(Math.round(progress), 100)}%
            </motion.span>
          </div>
        </motion.div>
      ) : null}
    </AnimatePresence>
  );
};

export default Preloader;
