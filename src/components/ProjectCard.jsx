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
  const progressGradient = progressColors[category] || "from-emerald-500 to-teal-400";
  const targetLink = id ? `/projects/${id}` : "/projects";

  return (
    <motion.div
      initial={{ opacity: 0, y: 20 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true }}
      transition={{ duration: 0.4 }}
      className="bg-card rounded-2xl overflow-hidden border border-border/60 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col h-full group"
    >
      {/* Image Container */}
      <div className="relative h-48 md:h-52 overflow-hidden bg-muted">
        <img
          src={image}
          alt={title}
          className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
          loading="lazy"
        />
        {/* Category Badge */}
        {category && (
          <span
            className={`absolute top-3 left-3 text-[10px] font-extrabold uppercase tracking-wider px-3 py-1 rounded-full shadow-sm ${badgeClass}`}
          >
            {category}
          </span>
        )}
      </div>

      {/* Card Content */}
      <div className="p-5 flex flex-col flex-1">
        {/* Title */}
        <h3 className="font-heading font-bold text-lg md:text-xl text-foreground mb-2 leading-snug group-hover:text-emerald-700 dark:group-hover:text-emerald-400 transition-colors">
          {title}
        </h3>

        {/* Description */}
        <p className="text-xs md:text-sm text-muted-foreground mb-4 line-clamp-2 leading-relaxed">
          {description}
        </p>

        <div className="mt-auto space-y-3">
          {/* Location Row */}
          <div className="flex flex-wrap items-center justify-between text-[11px] text-muted-foreground gap-2 font-medium">
            {location && (
              <div className="flex items-center gap-1.5">
                <MapPin className="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400 shrink-0" />
                <span className="truncate max-w-[200px]">{location}</span>
              </div>
            )}
          </div>

          {/* Progress Bar & Funding Status */}
          <div className="space-y-1">
            <div className="w-full h-1.5 bg-muted rounded-full overflow-hidden">
              <motion.div
                className={`h-full rounded-full bg-gradient-to-r ${progressGradient}`}
                initial={{ width: 0 }}
                whileInView={{ width: `${Math.min(progress, 100)}%` }}
                viewport={{ once: true }}
                transition={{ duration: 1.2, ease: "easeOut" }}
              />
            </div>
            {progress > 0 && (
              <div className="flex justify-end text-[10px] font-bold text-muted-foreground">
                <span>{progress}% funded</span>
              </div>
            )}
          </div>

          {/* Action Row */}
          <div className="pt-1 flex items-center justify-between">
            <Link
              to={targetLink}
              className="inline-flex items-center gap-1.5 bg-[#064e3b] hover:bg-emerald-900 text-white px-4 py-2 rounded-full text-xs font-bold transition-all duration-300 shadow-sm"
            >
              View Details <ArrowRight className="w-3.5 h-3.5" />
            </Link>
          </div>
        </div>
      </div>
    </motion.div>
  );
};

export default ProjectCard;
