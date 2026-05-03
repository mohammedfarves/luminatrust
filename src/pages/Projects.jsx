import { motion } from "framer-motion";
import { useState } from "react";
import SectionHeading from "@/components/SectionHeading";
import ProjectCard from "@/components/ProjectCard";
import { FloatingParticles, staggerContainer, staggerItem } from "@/components/AnimationEffects";
import causeEducation from "@/assets/cause-education.jpg";
import causeWater from "@/assets/cause-water.jpg";
import causeHealth from "@/assets/cause-health.jpg";
import causeEnvironment from "@/assets/cause-environment.jpg";
import sparrow1 from "@/assets/events/sparrow-event-1.jpeg";
import cycleRally from "@/assets/events/cycle-rally.png";
import PhotoGallery from "@/components/PhotoGallery";

const allProjects = [
  { image: cycleRally, title: "Pedal for Planet", category: "Upcoming", description: "Join our community cycling event to raise awareness for climate change and promote sustainable urban mobility.", progress: 0, raised: "Upcoming", goal: "Join Us" },
  { image: causeEducation, title: "Education for All", category: "Education", description: "Providing quality education to underprivileged children through schools, scholarships, and digital learning.", progress: 75, raised: "3,75,000", goal: "₹5,00,000" },
  { image: causeWater, title: "Clean Water Initiative", category: "Water", description: "Building wells and water purification systems in drought-affected villages across Rajasthan and Maharashtra.", progress: 60, raised: "6,00,000", goal: "₹10,00,000" },
  { image: causeHealth, title: "Healthcare Access", category: "Health", description: "Mobile health camps bringing essential medical care and health awareness to remote communities.", progress: 85, raised: "4,25,000", goal: "₹5,00,000" },
  { image: causeEnvironment, title: "Green Tomorrow", category: "Environment", description: "Planting trees, promoting sustainable farming, and restoring natural habitats in degraded ecosystems.", progress: 45, raised: "2,25,000", goal: "₹5,00,000" },
  { image: causeEducation, title: "Women Empowerment", category: "Education", description: "Skill development, vocational training, and micro-finance support for women in underserved communities.", progress: 55, raised: "2,75,000", goal: "₹5,00,000" },
  { image: causeHealth, title: "Nutrition Program", category: "Health", description: "Combating malnutrition in children under 5 through supplementary feeding and nutrition education.", progress: 70, raised: "3,50,000", goal: "₹5,00,000" },
  { image: sparrow1, title: "Sparrow Day Celebration", category: "Completed", description: "A highly successful community event where we raised awareness and distributed bird feeders to protect our local sparrow population.", progress: 100, raised: "Completed", goal: "Successful" },
];

const tabs = ["All", "Upcoming", "Education", "Water", "Health", "Environment", "Completed"];

const Projects = () => {
  const [activeTab, setActiveTab] = useState("All");
  const filtered = activeTab === "All" ? allProjects : allProjects.filter((p) => p.category === activeTab);

  return (
    <div className="overflow-hidden">
      {/* ── HERO ── */}
      <section className="relative py-44 md:py-52 bg-gradient-dark overflow-hidden">
        <FloatingParticles />
        <div className="absolute inset-0 bg-dot-grid opacity-20" />
        <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[400px] bg-amber-600/10 rounded-full blur-3xl" />
        <div className="w-full px-6 md:px-10 text-center relative z-10">
          <motion.div initial={{ opacity: 0, y: 30 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.7 }}>
            <span className="inline-flex items-center gap-2 glass rounded-full px-5 py-2 text-amber-400 font-bold text-xs uppercase tracking-[0.2em] mb-6">Our Work</span>
            <h1 className="font-heading text-4xl md:text-6xl lg:text-7xl text-white mt-4 leading-[1.1]">
              Our <span className="text-amber-400">Projects</span>
            </h1>
            <motion.p initial={{ opacity: 0 }} animate={{ opacity: 1 }} transition={{ delay: 0.3 }} className="text-white/60 mt-6 max-w-2xl mx-auto text-lg">
              Explore our ongoing initiatives making a real difference across every corner of India.
            </motion.p>
          </motion.div>
        </div>
      </section>

      {/* ── PROJECTS GRID ── */}
      <section className="py-28">
        <div className="w-full px-6 md:px-10 max-w-7xl mx-auto">
          <SectionHeading subtitle="Active Causes" title="Projects & Initiatives" description="Support any of our ongoing projects with your generous contribution." />

          {/* Filter tabs */}
          <div className="flex flex-wrap justify-center gap-3 mb-12">
            {tabs.map((tab) => (
              <motion.button
                key={tab}
                onClick={() => setActiveTab(tab)}
                whileHover={{ scale: 1.05 }}
                whileTap={{ scale: 0.95 }}
                className={`px-6 py-2.5 rounded-full text-sm font-bold transition-all duration-300 ${activeTab === tab
                    ? "bg-gradient-to-r from-amber-400 to-amber-500 text-amber-950 shadow-gold"
                    : "bg-secondary text-muted-foreground hover:text-foreground hover:bg-amber-50 border border-transparent hover:border-amber-200"
                  }`}
              >
                {tab}
              </motion.button>
            ))}
          </div>

          <motion.div
            key={activeTab}
            variants={staggerContainer}
            initial="hidden"
            animate="show"
            className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
          >
            {filtered.map((p, i) => (
              <motion.div key={`${activeTab}-${i}`} variants={staggerItem}>
                <ProjectCard {...p} />
              </motion.div>
            ))}
          </motion.div>
        </div>
      </section>

      {/* ── GALLERY ── */}
      <PhotoGallery />
    </div>
  );
};

export default Projects;
