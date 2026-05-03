import { motion } from "framer-motion";
import { Link } from "react-router-dom";
import { Heart } from "lucide-react";
import { GlowCard } from "./AnimationEffects";

const ProjectCard = ({ image, title, description, progress, goal, raised, category }) => (
  <GlowCard>
    <motion.div
      initial={{ opacity: 0, y: 30 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true }}
      transition={{ duration: 0.5 }}
      className="bg-card rounded-2xl overflow-hidden shadow-ngo group flex flex-col h-full hover:shadow-card-hover transition-shadow duration-500"
    >
      {/* Image */}
      <div className="relative overflow-hidden h-52">
        <motion.img
          src={image}
          alt={title}
          className="w-full h-full object-cover"
          whileHover={{ scale: 1.08 }}
          transition={{ duration: 0.6 }}
          loading="lazy"
        />
        {/* Gradient overlay */}
        <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent" />
        {/* Category badge */}
        {category && (
          <span className="absolute top-3 left-3 text-[10px] font-bold uppercase tracking-widest bg-amber-400/90 text-amber-900 px-2.5 py-1 rounded-full backdrop-blur-sm">
            {category}
          </span>
        )}
        {/* Progress % badge on image bottom */}
        <div className="absolute bottom-3 right-3 glass rounded-full px-3 py-1 text-xs font-bold text-white">
          {progress}% funded
        </div>
      </div>

      {/* Content */}
      <div className="p-5 flex flex-col flex-1">
        <h3 className="font-heading text-lg text-foreground mb-1.5 group-hover:text-amber-500 transition-colors leading-tight">
          {title}
        </h3>
        <p className="text-sm text-muted-foreground mb-4 line-clamp-2 leading-relaxed">{description}</p>

        {/* Progress */}
        <div className="mb-5 mt-auto">
          <div className="flex justify-between text-xs font-semibold mb-2">
            <span className="text-amber-500">₹{raised}</span>
            <span className="text-muted-foreground">Goal: {goal}</span>
          </div>
          <div className="w-full h-2 bg-secondary rounded-full overflow-hidden">
            <motion.div
              className="h-full rounded-full"
              style={{ background: "linear-gradient(90deg, hsl(39 100% 55%), hsl(200 85% 55%))" }}
              initial={{ width: 0 }}
              whileInView={{ width: `${progress}%` }}
              viewport={{ once: true }}
              transition={{ duration: 1.5, ease: "easeOut", delay: 0.3 }}
            />
          </div>
        </div>

        <motion.div whileHover={{ scale: 1.03 }} whileTap={{ scale: 0.97 }}>
          <Link
            to="/donate"
            className="inline-flex items-center gap-2 w-full justify-center bg-gradient-to-r from-amber-400 to-amber-500 text-amber-900 px-5 py-2.5 rounded-full text-sm font-bold hover:shadow-gold transition-all"
          >
            <Heart className="h-3.5 w-3.5 fill-amber-900" /> Donate Now
          </Link>
        </motion.div>
      </div>
    </motion.div>
  </GlowCard>
);

export default ProjectCard;
