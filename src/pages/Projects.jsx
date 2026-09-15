import { motion } from "framer-motion";
import { useState } from "react";
import SectionHeading from "@/components/SectionHeading";
import ProjectCard from "@/components/ProjectCard";
import HeroBackground from "@/components/HeroBackground";
import { staggerContainer, staggerItem } from "@/components/AnimationEffects";
import bookDistributionImg from "@/assets/activits/Book given to students/b2.png";
import scienceCompImg from "@/assets/activits/Science Competition – Nagapattinam/s1.png";
import doctorsDayImg from "@/assets/activits/DOCTERS ADY/d1.png";
import beachCleanImg from "@/assets/activits/nagore beach clean/n1.jpeg";
import treePlantationImg from "@/assets/activits/tree plantaion/t1.png";
import plasticFreeImg from "@/assets/activits/Plastic bag free day/p1.jpeg";
import savitribaiImg from "@/assets/activits/savithri bhai pule/sb1.jpeg";
import cycleRallyImg from "@/assets/activits/CYCLEING/c1.jpeg";
import sparrow1 from "@/assets/events/sparrow-event-1.jpeg";
import mlaMeetingPhoto from "@/assets/events/mla-meeting.jpg";
import examPrepPhoto from "@/assets/events/exam-prep-training.png";
import PhotoGallery from "@/components/PhotoGallery";

const allProjects = [
  { id: "pedal-for-planet", image: cycleRallyImg, title: "Pedal for Planet", category: "Completed", description: "Join our community cycling rally to raise awareness for climate change and promote green living.", progress: 100, raised: "Completed", goal: "Successful", location: "Nagapattinam Collector Office" },
  { id: "exam-prep-training", image: examPrepPhoto, title: "Government Exam Preparation Training", category: "Education", description: "Empowering Aspirants Through Education – A focused training session to guide and prepare students for government and competitive examinations.", progress: 100, raised: "Completed", goal: "Successful", location: "Nagapattinam" },
  { id: "mla-meeting", image: mlaMeetingPhoto, title: "Building Stronger Community Partnerships", category: "Completed", description: "Lumina Trust participated in a meeting with the Honourable MLA of Nagapattinam to discuss community development, social welfare, and education.", progress: 100, raised: "Completed", goal: "Successful", location: "Nagapattinam, Tamil Nadu" },
  { id: "book-distribution", image: bookDistributionImg, title: "Book Distribution for Students", category: "Education", description: "Providing free books, notebooks, and essential study materials to school students in need.", progress: 75, raised: "3,75,000", goal: "₹5,00,000", location: "Nagapattinam" },
  { id: "science-competition", image: scienceCompImg, title: "Nagapattinam Science Competition", category: "Education", description: "Fostering scientific temperament and innovation among young school students through annual science competitions.", progress: 80, raised: "4,00,000", goal: "₹5,00,000", date: "20 Jun 2025", location: "Nagapattinam" },
  { id: "doctors-day", image: doctorsDayImg, title: "Free Health Check-up Camp", category: "Health", description: "Providing basic health check-ups and medical support to underprivileged communities.", progress: 85, raised: "4,25,000", goal: "₹5,00,000", date: "15 May 2025", location: "Nagapattinam" },
  { id: "beach-cleanup", image: beachCleanImg, title: "Clean Water for Better Tomorrow", category: "Water", description: "Installing and maintaining clean water facilities to ensure safe drinking water for rural areas.", progress: 60, raised: "6,00,000", goal: "₹10,00,000", date: "10 Apr 2025", location: "Nagapattinam" },
  { id: "world-environment-day", image: treePlantationImg, title: "Tree Plantation Drive", category: "Environment", description: "Greener today, healthier tomorrow. Join us in planting trees for a cleaner and safer planet.", progress: 90, raised: "4,50,000", goal: "₹5,00,000", date: "05 Mar 2025", location: "Nagapattinam" },
  { id: "plastic-free-day", image: plasticFreeImg, title: "Plastic Free Awareness", category: "Environment", description: "Distributing eco-friendly cloth bags and conducting door-to-door awareness campaigns to reduce single-use plastic.", progress: 55, raised: "2,75,000", goal: "₹5,00,000", date: "18 Feb 2025", location: "Nagapattinam" },
  { id: "savitribai-phule", image: savitribaiImg, title: "Women Empowerment Drive", category: "Completed", description: "Celebrating Savitribai Phule Jayanti and providing leadership, educational, and vocational guidance for women.", progress: 100, raised: "Completed", goal: "Successful", date: "03 Jan 2025", location: "Nagapattinam" },
  { id: "sparrow-initiative", image: sparrow1, title: "Sparrow Protection Initiative", category: "Completed", description: "A highly successful community drive distributing bird feeders and nest boxes to conserve local house sparrows.", progress: 100, raised: "Completed", goal: "Successful", date: "20 Dec 2024", location: "Nagapattinam" },
];

const tabs = ["All", "Education", "Environment", "Health", "Water", "Upcoming", "Completed"];

const Projects = () => {
  const [activeTab, setActiveTab] = useState("All");
  const filtered = activeTab === "All" ? allProjects : allProjects.filter((p) => p.category === activeTab);

  return (
    <div className="overflow-hidden">
      {/* ── HERO ── */}
      <section className="relative py-44 md:py-52 bg-slate-950 overflow-hidden">
        <HeroBackground />
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
              <button
                key={tab}
                onClick={() => setActiveTab(tab)}
                className={`px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 ${
                  activeTab === tab
                    ? "bg-[#064e3b] text-white shadow-md border border-[#064e3b]"
                    : "bg-card border border-border text-foreground/80 hover:bg-emerald-50 dark:hover:bg-emerald-950/40 hover:border-emerald-200"
                }`}
              >
                {tab}
              </button>
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
