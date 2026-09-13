import { motion } from "framer-motion";
import { Link } from "react-router-dom";
import { Calendar, MapPin, ArrowRight } from "lucide-react";

const categoryColors = {
  Upcoming: "bg-amber-400 text-amber-950",
  Education: "bg-sky-300 text-sky-950",
  Health: "bg-emerald-300 text-emerald-950",
  Water: "bg-purple-300 text-purple-950",
  Environment: "bg-emerald-400 text-emerald-950",
  Completed: "bg-teal-300 text-teal-950",
};

const progressColors = {
  Upcoming: "from-amber-400 to-amber-500",
  Education: "from-sky-400 to-amber-400",
  Health: "from-emerald-400 to-teal-500",
  Water: "from-purple-400 to-blue-500",
  Environment: "from-emerald-500 to-green-400",
  Completed: "from-emerald-500 to-teal-400",
};

const ProjectCard = ({
  id,
  image,
  title,
  description,
  progress = 0,
  goal,
  raised,
  category = "Education",
  date = "12 Aug 2025",
  location = "Nagapattinam",
}) => {
  const badgeClass = categoryColors[category] || "bg-emerald-400 text-emerald-950";
  const targetLink = id ? `/projects/${id}` : "/projects";
  const safeProgress = Math.min(Math.max(Number(progress) || 0, 0), 100);
  const progressBarStyle = {
    width: `${safeProgress}%`,
    background:
      category === "Education"
        ? "linear-gradient(90deg, #7dd3fc 0%, #fbbf24 100%)"
        : category === "Health"
          ? "linear-gradient(90deg, #34d399 0%, #14b8a6 100%)"
          : category === "Water"
            ? "linear-gradient(90deg, #a78bfa 0%, #3b82f6 100%)"
            : category === "Environment"
              ? "linear-gradient(90deg, #34d399 0%, #22c55e 100%)"
              : category === "Completed"
                ? "linear-gradient(90deg, #34d399 0%, #2dd4bf 100%)"
                : "linear-gradient(90deg, #fbbf24 0%, #f59e0b 100%)",
  };

  return (
    <motion.article
      initial={{ opacity: 0, y: 20 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true }}
      transition={{ duration: 0.45 }}
      className="group flex h-full flex-col overflow-hidden rounded-[28px] border border-[#dfe3d5] bg-[#f4f2ef] shadow-[0_22px_40px_-30px_rgba(15,23,42,0.35)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_26px_45px_-28px_rgba(6,78,59,0.35)]"
    >
      <div className="relative h-52 overflow-hidden bg-muted md:h-60">
        <img
          src={image}
          alt={title}
          className="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"
          loading="lazy"
        />
        {category && (
          <span
            className={`absolute left-4 top-4 inline-flex items-center rounded-full border border-white/30 bg-[#f4f2ef]/75 px-3 py-1.5 text-[10px] font-extrabold uppercase tracking-[0.22em] text-[#143b30] shadow-sm backdrop-blur-sm ${badgeClass}`}
          >
            {category}
          </span>
        )}
      </div>

      <div className="flex flex-1 flex-col p-5 md:p-6">
        <h3 className="mb-3 font-heading text-2xl md:text-[2rem] leading-none text-[#1f3d30] group-hover:text-[#0f5132] transition-colors">
          {title}
        </h3>

        <p className="mb-5 text-sm md:text-[1.05rem] leading-relaxed text-slate-600/90">
          {description}
        </p>

        <div className="mt-auto space-y-4">
          <div className="flex flex-wrap items-center justify-between gap-3 text-[11px] font-medium text-slate-600 md:text-xs">
            {date && (
              <div className="flex items-center gap-2">
                <Calendar className="h-4 w-4 text-emerald-700" />
                <span>{date}</span>
              </div>
            )}
            {location && (
              <div className="flex items-center gap-2">
                <MapPin className="h-4 w-4 text-emerald-700" />
                <span className="max-w-[160px] truncate">{location}</span>
              </div>
            )}
          </div>

          <div className="space-y-2">
            <div className="h-2.5 w-full overflow-hidden rounded-full bg-slate-300/80">
              <motion.div
                className="h-full rounded-full"
                initial={{ width: 0 }}
                animate={{ width: `${safeProgress}%` }}
                transition={{ duration: 1.1, ease: "easeOut" }}
                style={progressBarStyle}
              />
            </div>
            {safeProgress > 0 && (
              <div className="flex justify-end text-[11px] font-bold text-slate-700 md:text-xs">
                <span>{safeProgress}% funded</span>
              </div>
            )}
          </div>

          <div className="pt-1">
            <Link
              to={targetLink}
              className="inline-flex items-center gap-2 rounded-full bg-[#0f5132] px-5 py-3 text-sm font-bold text-white shadow-sm transition-all hover:bg-[#0a3e2b]"
            >
              View Details <ArrowRight className="h-4 w-4" />
            </Link>
          </div>
        </div>
      </div>
    </motion.article>
  );
};

export default ProjectCard;
