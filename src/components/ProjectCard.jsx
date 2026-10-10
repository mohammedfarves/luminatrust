import { motion, useReducedMotion } from "framer-motion";
import { Link } from "react-router-dom";
import { MapPin, ArrowRight } from "lucide-react";

const ProjectCard = ({
  id,
  image,
  title,
  description,
  progress = 0,
  category = "Education",
  location = "Nagapattinam",
  index = 0,
}) => {
  const shouldReduceMotion = useReducedMotion();
  const targetLink = id ? `/projects/${id}` : "/projects";
  const safeProgress = Math.min(Math.max(Number(progress) || 0, 0), 100);

  const cardVariants = {
    hidden: {
      opacity: 0,
      y: shouldReduceMotion ? 0 : 24,
    },
    visible: {
      opacity: 1,
      y: 0,
      transition: {
        duration: shouldReduceMotion ? 0 : 0.5,
        ease: [0.22, 1, 0.36, 1],
        delay: shouldReduceMotion ? 0 : (index % 3) * 0.08,
      },
    },
  };

  return (
    <motion.article
      variants={cardVariants}
      initial="hidden"
      whileInView="visible"
      viewport={{ once: true, margin: "-30px" }}
      className="group flex h-full flex-col overflow-hidden rounded-[1.5rem] border border-[#dce4dc] dark:border-border/60 bg-[#f4f6f3] dark:bg-card shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] transition-all duration-300 ease-out hover:-translate-y-[6px] hover:shadow-[0_20px_35px_-8px_rgba(0,0,0,0.12),0_10px_20px_-5px_rgba(16,185,129,0.08)] motion-reduce:transform-none motion-reduce:transition-none"
    >
      <Link to={targetLink} className="flex flex-1 flex-col h-full focus:outline-none">
        {/* Image Container with Consistent Aspect Ratio */}
        <div className="relative h-56 md:h-64 w-full overflow-hidden bg-muted">
          <img
            src={image}
            alt={title}
            className="h-full w-full object-cover transition-transform duration-500 ease-out will-change-transform group-hover:scale-105 motion-reduce:transform-none"
            loading="lazy"
          />

          {/* Category Badge */}
          {category && (
            <span className="absolute left-4 top-4 z-10 inline-flex items-center rounded-full bg-white/90 dark:bg-slate-900/90 px-3.5 py-1 text-[11px] font-extrabold uppercase tracking-widest text-[#1f3d30] dark:text-emerald-300 shadow-xs backdrop-blur-sm">
              {category}
            </span>
          )}

          {/* Subtle Dark Gradient Overlay with View Project Action on Hover */}
          <div className="absolute inset-0 z-10 bg-gradient-to-t from-slate-950/80 via-slate-950/25 to-transparent opacity-0 transition-opacity duration-300 ease-out group-hover:opacity-100 flex items-end justify-start p-5 motion-reduce:opacity-0">
            <span className="inline-flex items-center gap-2 rounded-full bg-white/95 dark:bg-slate-900/95 px-4 py-1.5 text-xs font-bold text-[#1f3d30] dark:text-emerald-300 shadow-lg backdrop-blur-md transform translate-y-2 opacity-0 transition-all duration-300 ease-out group-hover:translate-y-0 group-hover:opacity-100">
              <span>View Project</span>
              <ArrowRight className="h-3.5 w-3.5 transition-transform duration-300 ease-out group-hover:translate-x-1" />
            </span>
          </div>
        </div>

        {/* Content */}
        <div className="flex flex-1 flex-col p-6">
          <h3 className="mb-3 font-heading text-2xl font-extrabold leading-snug text-[#1f3d30] dark:text-foreground transition-colors duration-300 group-hover:text-[#0f5132] dark:group-hover:text-emerald-400 md:text-[1.75rem]">
            {title}
          </h3>

          <p className="mb-6 text-sm md:text-[0.95rem] leading-relaxed text-slate-600/90 dark:text-muted-foreground line-clamp-3">
            {description}
          </p>

          <div className="mt-auto space-y-3">
            {/* Location Row */}
            {location && (
              <div className="flex items-center gap-2 text-xs font-semibold text-slate-600 dark:text-slate-400">
                <MapPin className="h-4 w-4 text-[#10b981] shrink-0" />
                <span className="truncate">{location}</span>
              </div>
            )}

            {/* Progress Bar */}
            <div className="space-y-1">
              <div className="h-2.5 w-full overflow-hidden rounded-full bg-[#d0ded3] dark:bg-slate-800">
                <motion.div
                  className="h-full rounded-full bg-gradient-to-r from-[#2dd4bf] to-[#10b981]"
                  initial={{ width: 0 }}
                  whileInView={{ width: `${safeProgress}%` }}
                  viewport={{ once: true }}
                  transition={{ duration: 1.1, ease: "easeOut" }}
                />
              </div>
            </div>

            {/* Responsive / Touch-Friendly Action Row */}
            <div className="pt-2 flex items-center justify-between text-xs font-bold">
              <span className="inline-flex items-center gap-1.5 text-[#0f5132] dark:text-emerald-400 transition-colors duration-300 group-hover:text-amber-600 dark:group-hover:text-amber-400">
                <span>View Project</span>
                <ArrowRight className="h-3.5 w-3.5 transition-transform duration-300 ease-out group-hover:translate-x-1" />
              </span>
              {safeProgress > 0 && (
                <span className="text-[11px] font-bold text-slate-600 dark:text-slate-400">
                  {safeProgress}% funded
                </span>
              )}
            </div>
          </div>
        </div>
      </Link>
    </motion.article>
  );
};

export default ProjectCard;
