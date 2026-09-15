import { motion } from "framer-motion";
import { Link } from "react-router-dom";
import { MapPin } from "lucide-react";

const ProjectCard = ({
  id,
  image,
  title,
  description,
  progress = 0,
  category = "Education",
  location = "Nagapattinam",
}) => {
  const targetLink = id ? `/projects/${id}` : "/projects";
  const safeProgress = Math.min(Math.max(Number(progress) || 0, 0), 100);

  return (
    <motion.article
      initial={{ opacity: 0, y: 20 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true }}
      transition={{ duration: 0.45 }}
      className="group flex h-full flex-col overflow-hidden rounded-[1.5rem] border border-[#dce4dc] bg-[#f4f6f3] shadow-xs transition-all duration-300 hover:-translate-y-1 hover:shadow-md"
    >
      <Link to={targetLink} className="flex flex-1 flex-col h-full">
        {/* Image Container */}
        <div className="relative h-56 overflow-hidden bg-muted md:h-64">
          <img
            src={image}
            alt={title}
            className="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"
            loading="lazy"
          />
          {category && (
            <span className="absolute left-4 top-4 inline-flex items-center rounded-full bg-white/90 px-3.5 py-1 text-[11px] font-extrabold uppercase tracking-widest text-[#1f3d30] shadow-xs backdrop-blur-sm">
              {category}
            </span>
          )}
        </div>

        {/* Content */}
        <div className="flex flex-1 flex-col p-6">
          <h3 className="mb-3 font-heading text-2xl font-extrabold leading-snug text-[#1f3d30] transition-colors group-hover:text-[#0f5132] md:text-[1.75rem]">
            {title}
          </h3>

          <p className="mb-6 text-sm md:text-[0.95rem] leading-relaxed text-slate-600/90 line-clamp-3">
            {description}
          </p>

          <div className="mt-auto space-y-3">
            {/* Location Row */}
            {location && (
              <div className="flex items-center gap-2 text-xs font-semibold text-slate-600">
                <MapPin className="h-4 w-4 text-[#10b981] shrink-0" />
                <span className="truncate">{location}</span>
              </div>
            )}

            {/* Progress Bar */}
            <div className="space-y-1">
              <div className="h-2.5 w-full overflow-hidden rounded-full bg-[#d0ded3]">
                <motion.div
                  className="h-full rounded-full bg-gradient-to-r from-[#2dd4bf] to-[#10b981]"
                  initial={{ width: 0 }}
                  animate={{ width: `${safeProgress}%` }}
                  transition={{ duration: 1.1, ease: "easeOut" }}
                />
              </div>
              {safeProgress > 0 && (
                <div className="flex justify-end text-[11px] font-bold text-slate-600">
                  <span>{safeProgress}% funded</span>
                </div>
              )}
            </div>
          </div>
        </div>
      </Link>
    </motion.article>
  );
};

export default ProjectCard;
