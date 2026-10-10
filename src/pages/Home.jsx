import { Link } from "react-router-dom";
import { motion, useScroll, useTransform, AnimatePresence, useReducedMotion } from "framer-motion";
import { 
  Users, 
  HandHeart, 
  Target, 
  ArrowRight, 
  Send, 
  Sparkles, 
  TrendingUp, 
  BookOpen, 
  Mail, 
  Heart, 
  Eye, 
  Leaf, 
  ShieldCheck, 
  Award, 
  CheckCircle2, 
  Globe2,
  ChevronRight
} from "lucide-react";
import { useState, useRef, useEffect } from "react";
import { toast } from "sonner";

import heroBg from "@/assets/hero-bg.jpg";
import bookDistributionImg from "@/assets/activits/Book given to students/b2.png";
import beachCleanImg from "@/assets/activits/nagore beach clean/WhatsApp Image 2026-09-01 at 1.55.01 PM.jpeg";
import doctorsDayImg from "@/assets/activits/DOCTERS ADY/WhatsApp Image 2026-09-01 at 2.01.14 PM.jpeg";
import treePlantationImg from "@/assets/activits/tree plantaion/t1.png";
import cycleRallyImg from "@/assets/activits/CYCLEING/c1.jpeg";
import aboutTeamImg from "@/assets/about-team.jpg";
import mlaMeetingPhoto from "@/assets/events/mla-meeting.jpg";
import examPrepPhoto from "@/assets/events/exam-prep-training.png";

import AnimatedCounter from "@/components/AnimatedCounter";
import SectionHeading from "@/components/SectionHeading";
import ProjectCard from "@/components/ProjectCard";
import Testimonial from "@/components/Testimonial";
import MarqueeRibbon from "@/components/MarqueeRibbon";
import { FloatingParticles, staggerContainer, staggerItem, GlowCard } from "@/components/AnimationEffects";

const Home = () => {
  const [email, setEmail] = useState("");
  const [isSubmitting, setIsSubmitting] = useState(false);
  const heroRef = useRef(null);
  const shouldReduceMotion = useReducedMotion();

  // Dynamic Home Page & Live Impact Counters Data from Admin API
  const [homeData, setHomeData] = useState({
    hero_badge_text: "Empowering Communities Across Tamil Nadu",
    hero_title_line1: "Transforming Lives",
    hero_title_line2: "Through Compassion",
    hero_description: "Lumina Trust is a community-focused organization dedicated to uplifting underserved populations through sustainable education, healthcare, and livelihood initiatives.",
    hero_button_donate_text: "Donate Today",
    hero_button_volunteer_text: "Volunteer with Us",
    hero_card_title: "Lumina Trust Grassroots Drive",
    hero_card_subtitle: "Nagapattinam & Surrounding Districts",
    hero_stat_completed: "150+ Projects",
    hero_trust_badge_1: "100% Transparent NGO",
    hero_trust_badge_2: "Grassroots Impact",

    impact_subtitle: "OUR IMPACT",
    impact_title: "Numbers That Speak",
    counter_people_helped: 1000,
    counter_people_helped_suffix: "+",
    counter_people_helped_label: "PEOPLE HELPED",
    counter_volunteers: 50,
    counter_volunteers_suffix: "+",
    counter_volunteers_label: "ACTIVE VOLUNTEERS",
    counter_projects_done: 10,
    counter_projects_done_suffix: "+",
    counter_projects_done_label: "PROJECTS DONE",
    counter_communities: 10,
    counter_communities_suffix: "+",
    counter_communities_label: "COMMUNITIES",

    about_subtitle: "About Lumina Trust",
    about_title: "Uplifting Underserved Communities with Dignity",
    about_description: "Lumina Trust is a community-focused organization dedicated to uplifting underserved populations through sustainable and inclusive development initiatives. We work at the grassroots level to enable individuals and communities to achieve dignity, independence, and long-term growth.",
    about_feature_1_title: "Grassroots Reach",
    about_feature_1_desc: "Direct village & town level impact.",
    about_feature_2_title: "Full Transparency",
    about_feature_2_desc: "100% non-profit accountability.",

    newsletter_subtitle: "Stay Connected",
    newsletter_title: "Join Hands for a Brighter Future",
    newsletter_description: "Subscribe to our newsletter to receive updates on our grassroots programs, health drives, and volunteer opportunities.",
  });

  const [featuredProjects, setFeaturedProjects] = useState([
    {
      id: "book-distribution",
      image: bookDistributionImg,
      title: "Book Distribution for Students",
      category: "Education",
      description: "Providing free books, notebooks, and essential study materials to school students in need.",
      progress: 75,
      location: "Nagapattinam",
    },
    {
      id: "beach-cleanup",
      image: beachCleanImg,
      title: "Clean Water for Better Tomorrow",
      category: "Water",
      description: "Installing and maintaining clean water facilities to ensure safe drinking water for rural areas.",
      progress: 60,
      location: "Nagapattinam",
    },
    {
      id: "doctors-day",
      image: doctorsDayImg,
      title: "Free Health Check-up Camp",
      category: "Health",
      description: "Providing basic health check-ups and medical support to underprivileged communities.",
      progress: 85,
      location: "Nagapattinam",
    },
    {
      id: "world-environment-day",
      image: treePlantationImg,
      title: "Tree Plantation Drive",
      category: "Environment",
      description: "Greener today, healthier tomorrow. Join us in planting trees for a cleaner and safer planet.",
      progress: 90,
      location: "Nagapattinam",
    },
  ]);

  useEffect(() => {
    const fetchHomeData = async () => {
      try {
        const res = await fetch("http://localhost:8000/api/home");
        if (res.ok) {
          const data = await res.json();
          setHomeData((prev) => ({ ...prev, ...data }));
        }
      } catch (err) {
        // Fallback gracefully to default state
      }
    };

    const fetchProjects = async () => {
      try {
        const res = await fetch("http://localhost:8000/api/activities");
        if (res.ok) {
          const data = await res.json();
          if (Array.isArray(data) && data.length > 0) {
            const fallbackImgs = [bookDistributionImg, beachCleanImg, doctorsDayImg, treePlantationImg];
            const mapped = data.slice(0, 4).map((item, idx) => ({
              id: item.id || item.shortTitle,
              image: item.image && !item.image.includes("unsplash.com") ? item.image : fallbackImgs[idx % fallbackImgs.length],
              title: item.title,
              category: item.category || "General",
              description: item.description,
              progress: item.progress || 80,
              location: item.location || "Nagapattinam",
            }));
            setFeaturedProjects(mapped);
          }
        }
      } catch (err) {
        // Keep fallback projects
      }
    };

    fetchHomeData();
    fetchProjects();
  }, []);
  
  const { scrollYProgress } = useScroll({
    target: heroRef,
    offset: ["start start", "end start"]
  });
  
  const heroY = useTransform(scrollYProgress, [0, 1], [0, 150]);
  const heroOpacity = useTransform(scrollYProgress, [0, 0.8], [1, 0]);

  const handleNewsletter = async (e) => {
    e.preventDefault();
    if (!email) return;
    setIsSubmitting(true);
    try {
      const response = await fetch("https://api.web3forms.com/submit", {
        method: "POST",
        headers: { "Content-Type": "application/json", Accept: "application/json" },
        body: JSON.stringify({
          access_key: "50c9f574-f407-44d7-a510-ab85422ed81c",
          subject: "New Newsletter Subscription - Lumina Trust",
          email: email
        }),
      });
      const result = await response.json();
      if (result.success) {
        toast.success("Thank you for subscribing to Lumina Trust updates!");
        setEmail("");
      } else {
        toast.error(result.message || "Failed to subscribe. Please try again.");
      }
    } catch (error) {
      toast.error("Something went wrong. Please try again.");
    } finally {
      setIsSubmitting(false);
    }
  };

  return (
    <div className="overflow-hidden bg-[#FBF9F5] dark:bg-slate-950 text-foreground transition-colors duration-500">
      
      {/* ── 1. NEXT-GEN ANIMATED KINETIC HERO SECTION ── */}
      <section ref={heroRef} className="relative min-h-[92vh] flex items-center justify-center pt-32 pb-24 md:pt-40 md:pb-32 overflow-hidden bg-[#0A0E17]">
        
        {/* Dynamic Gapless Photo Collage Wall with Motion Animation & Soft Blur */}
        <div className="absolute inset-0 pointer-events-none overflow-hidden select-none">
          {/* Gapless Animated Photo Wall Grid */}
          <motion.div 
            animate={{ 
              scale: [1.05, 1.12, 1.05],
              y: [0, -25, 0],
              x: [0, 15, 0]
            }}
            transition={{ 
              duration: 22, 
              repeat: Infinity, 
              ease: "easeInOut" 
            }}
            className="absolute -inset-10 grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-6 gap-0 opacity-60 filter blur-[2px] brightness-110 contrast-110"
          >
            {[
              heroBg, bookDistributionImg, beachCleanImg, doctorsDayImg, treePlantationImg, cycleRallyImg,
              doctorsDayImg, treePlantationImg, heroBg, bookDistributionImg, cycleRallyImg, beachCleanImg,
              bookDistributionImg, heroBg, beachCleanImg, treePlantationImg, doctorsDayImg, cycleRallyImg,
              cycleRallyImg, beachCleanImg, doctorsDayImg, heroBg, bookDistributionImg, treePlantationImg
            ].map((imgSrc, idx) => (
              <div key={idx} className="aspect-[4/3] overflow-hidden">
                <img src={imgSrc} alt="" className="w-full h-full object-cover transform scale-105" />
              </div>
            ))}
          </motion.div>

          {/* Softer Ambient Gradients for High Photo Visibility & Perfect Text Contrast */}
          <div className="absolute inset-0 bg-gradient-to-r from-[#0A0E17]/90 via-[#0A0E17]/70 to-[#0A0E17]/40" />
          <div className="absolute inset-0 bg-gradient-to-t from-[#0A0E17] via-[#0A0E17]/30 to-[#0A0E17]/60" />

          {/* Animated Ambient Light Orbs */}
          <motion.div 
            animate={{ 
              scale: [1, 1.2, 1],
              opacity: [0.3, 0.5, 0.3]
            }}
            transition={{ duration: 8, repeat: Infinity, ease: "easeInOut" }}
            className="absolute -top-24 right-1/4 w-[550px] h-[550px] bg-amber-500/20 rounded-full blur-[140px]" 
          />
          <motion.div 
            animate={{ 
              scale: [1.2, 1, 1.2],
              opacity: [0.2, 0.4, 0.2]
            }}
            transition={{ duration: 10, repeat: Infinity, ease: "easeInOut" }}
            className="absolute bottom-10 left-10 w-[450px] h-[450px] bg-emerald-500/15 rounded-full blur-[120px]" 
          />
        </div>

        <FloatingParticles />

        <div className="w-full px-6 md:px-12 max-w-7xl mx-auto relative z-10">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
            
            {/* Left Hero Column */}
            <motion.div 
              style={{ opacity: heroOpacity, y: heroY }}
              className="lg:col-span-7 flex flex-col items-start text-left"
            >
              {/* Live Status Pill */}
              <motion.div
                initial={{ opacity: 0, y: -20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.6 }}
                className="inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-300 text-xs font-extrabold tracking-widest uppercase mb-6 shadow-xl backdrop-blur-md"
              >
                <span className="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping" />
                <Leaf className="h-3.5 w-3.5 text-amber-400" />
                <span>{homeData.hero_badge_text}</span>
              </motion.div>

              {/* High-Impact Headline */}
              <motion.h1
                initial={{ opacity: 0, y: 30 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.8, delay: 0.15 }}
                className="font-heading text-4xl sm:text-5xl lg:text-6xl xl:text-7xl text-white leading-[1.1] tracking-tight font-extrabold drop-shadow-md"
              >
                {homeData.hero_title_line1} <span className="bg-gradient-to-r from-amber-300 via-amber-400 to-amber-500 bg-clip-text text-transparent">{homeData.hero_title_line2}</span>
              </motion.h1>

              {/* Descriptive Subtitle */}
              <motion.p
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.7, delay: 0.3 }}
                className="text-white/80 text-base sm:text-lg md:text-xl mt-6 max-w-2xl leading-relaxed font-normal"
              >
                {homeData.hero_description}
              </motion.p>

              {/* Glowing CTA Buttons */}
              <motion.div
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.6, delay: 0.5 }}
                className="flex flex-wrap items-center gap-4 mt-8"
              >
                <motion.div whileHover={{ scale: 1.05 }} whileTap={{ scale: 0.95 }}>
                  <Link
                    to="/donate"
                    className="inline-flex items-center gap-3 bg-gradient-to-r from-amber-400 via-amber-300 to-amber-500 text-amber-950 px-9 py-4 rounded-full font-extrabold text-sm shadow-[0_10px_35px_rgba(245,158,11,0.4)] hover:shadow-[0_15px_45px_rgba(245,158,11,0.7)] transition-all"
                  >
                    <Heart className="h-4 w-4 fill-amber-950 text-amber-950 animate-pulse" />
                    <span>{homeData.hero_button_donate_text}</span>
                    <ArrowRight className="h-4 w-4" />
                  </Link>
                </motion.div>

                <motion.div whileHover={{ scale: 1.05 }} whileTap={{ scale: 0.95 }}>
                  <Link
                    to="/volunteer"
                    className="inline-flex items-center gap-2.5 border-2 border-white/30 bg-white/10 text-white px-9 py-4 rounded-full font-extrabold text-sm hover:bg-white/20 transition-all backdrop-blur-md shadow-lg"
                  >
                    <span>{homeData.hero_button_volunteer_text}</span>
                    <ArrowRight className="h-4 w-4" />
                  </Link>
                </motion.div>
              </motion.div>

              {/* Quick Trust Indicators */}
              <motion.div
                initial={{ opacity: 0 }}
                animate={{ opacity: 1 }}
                transition={{ delay: 0.7 }}
                className="flex items-center gap-6 mt-10 pt-6 border-t border-white/10 text-white/70 text-xs sm:text-sm font-semibold"
              >
                <div className="flex items-center gap-2">
                  <ShieldCheck className="h-4 w-4 text-emerald-400" />
                  <span>{homeData.hero_trust_badge_1}</span>
                </div>
                <div className="flex items-center gap-2">
                  <Globe2 className="h-4 w-4 text-amber-400" />
                  <span>{homeData.hero_trust_badge_2}</span>
                </div>
              </motion.div>
            </motion.div>

            {/* Right Hero Column: Interactive Card Visual Stack */}
            <motion.div
              initial={{ opacity: 0, scale: 0.9 }}
              animate={{ opacity: 1, scale: 1 }}
              transition={{ duration: 0.8, delay: 0.2 }}
              className="lg:col-span-5 relative flex justify-center items-center"
            >
              <div className="relative w-full max-w-md lg:max-w-none">
                
                {/* Glowing Backing Frame */}
                <div className="absolute -inset-4 bg-gradient-to-tr from-amber-400/25 via-emerald-500/20 to-amber-600/30 rounded-[3rem] blur-2xl animate-pulse" />

                {/* Hero Featured Photo Card */}
                <motion.div
                  whileHover={{ rotateY: -6, rotateX: 4, scale: 1.02 }}
                  transition={{ type: "spring", stiffness: 200, damping: 20 }}
                  className="relative rounded-[2.5rem] overflow-hidden border-4 border-white/20 shadow-2xl bg-slate-900 aspect-[4/3] group select-none"
                >
                  <img
                    src={heroBg}
                    alt="Lumina Trust Grassroots Work"
                    className="w-full h-full object-cover transform group-hover:scale-108 transition-transform duration-700"
                  />
                  <div className="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent" />
                  
                  {/* Photo Strip Tag */}
                  <div className="absolute bottom-5 left-5 right-5 p-4 rounded-2xl bg-slate-950/80 backdrop-blur-md border border-white/15 text-left">
                    <p className="text-white text-sm font-bold">{homeData.hero_card_title}</p>
                    <p className="text-amber-400 text-xs font-semibold mt-0.5">{homeData.hero_card_subtitle}</p>
                  </div>
                </motion.div>

                {/* Top Floating Badge: "Small Steps Big Changes" */}
                <motion.div
                  initial={{ opacity: 0, x: 20, rotate: 6 }}
                  animate={{ opacity: 1, x: 0, rotate: 6 }}
                  transition={{ duration: 0.6, delay: 0.7 }}
                  className="absolute -top-6 -right-3 z-20 bg-gradient-to-r from-amber-400 to-amber-500 text-amber-950 rounded-2xl px-5 py-3 shadow-xl border-2 border-white flex flex-col items-center select-none"
                >
                  <div className="flex items-center gap-1">
                    <span className="font-serif italic font-bold text-sm sm:text-base leading-tight">
                      Small Steps
                    </span>
                    <Heart className="h-3.5 w-3.5 fill-amber-950 inline text-amber-950" />
                  </div>
                  <span className="font-serif italic font-extrabold text-xs sm:text-sm leading-tight">
                    Big Changes
                  </span>
                </motion.div>

                {/* Bottom Floating Stat Badge */}
                <motion.div
                  initial={{ opacity: 0, y: 20 }}
                  animate={{ opacity: 1, y: 0 }}
                  transition={{ duration: 0.6, delay: 0.9 }}
                  className="absolute -bottom-6 -left-3 z-20 bg-slate-900/90 backdrop-blur-xl rounded-2xl px-5 py-3.5 shadow-2xl border border-amber-400/30 flex items-center gap-3 text-left"
                >
                  <div className="w-10 h-10 rounded-xl bg-amber-400/20 flex items-center justify-center shrink-0">
                    <TrendingUp className="h-5 w-5 text-amber-400" />
                  </div>
                  <div>
                    <p className="text-white text-sm font-bold leading-tight">{homeData.hero_stat_completed}</p>
                    <p className="text-white/60 text-xs">Successfully Completed</p>
                  </div>
                </motion.div>

              </div>
            </motion.div>

          </div>
        </div>

        {/* Smooth Bottom Wave */}
        <div className="absolute bottom-0 left-0 right-0 overflow-hidden leading-none z-10 pointer-events-none">
          <svg viewBox="0 0 1200 120" preserveAspectRatio="none" className="relative block w-full h-10 md:h-14 text-[#FBF9F5] dark:text-slate-950 fill-current">
            <path d="M0,0 C150,90 350,-40 500,60 C650,160 900,10 1200,40 L1200,120 L0,120 Z" />
          </svg>
        </div>
      </section>

      {/* ── 2. LIVE MARQUEE IMPACT BANNER ── */}
      <MarqueeRibbon />

      {/* ── 3. ABOUT & PURPOSE SECTION ── */}
      <section className="py-24 md:py-32 relative overflow-hidden bg-[#FAF8F5] dark:bg-slate-950">
        {/* Real Grassroots Community Photographic Backdrop */}
        <div className="absolute inset-0 z-0 overflow-hidden pointer-events-none select-none">
          <img 
            src={aboutTeamImg} 
            alt="Lumina Trust Team & Community" 
            className="w-full h-full object-cover opacity-20 filter blur-[1px] brightness-105 scale-105" 
          />
          <div className="absolute inset-0 bg-gradient-to-r from-[#FAF8F5]/95 via-[#FAF8F5]/85 to-[#FAF8F5]/90 dark:from-slate-950/95 dark:via-slate-950/85 dark:to-slate-950/90" />
          <div className="absolute inset-0 bg-gradient-to-b from-[#FAF8F5] via-transparent to-[#FAF8F5] dark:from-slate-950 dark:via-transparent dark:to-slate-950" />
          <div className="absolute top-0 right-1/4 w-[500px] h-[500px] bg-amber-400/10 rounded-full blur-[140px]" />
        </div>

        <div className="w-full px-6 md:px-12 max-w-7xl mx-auto relative z-10">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-10 items-center">
            
            {/* Left Column: Heading & Text */}
            <motion.div 
              initial={{ opacity: 0, x: -30 }} 
              whileInView={{ opacity: 1, x: 0 }} 
              viewport={{ once: true }} 
              transition={{ duration: 0.7 }}
              className="lg:col-span-6 flex flex-col items-start text-left"
            >
              <div className="inline-flex items-center gap-2 mb-3">
                <span className="w-6 h-0.5 bg-amber-500 rounded-full" />
                <span className="text-xs font-extrabold uppercase tracking-widest text-amber-600 dark:text-amber-400">
                  {homeData.about_subtitle}
                </span>
              </div>

              <h2 className="font-heading text-3xl sm:text-4xl lg:text-5xl text-slate-900 dark:text-white leading-tight font-extrabold mb-6">
                {homeData.about_title}
              </h2>

              <p className="text-slate-600 dark:text-slate-300 text-base md:text-lg leading-relaxed mb-8">
                {homeData.about_description}
              </p>

              <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full mb-8">
                <div className="flex items-start gap-3 p-3.5 rounded-2xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border border-slate-200/80 dark:border-slate-800 shadow-sm">
                  <CheckCircle2 className="h-5 w-5 text-emerald-500 shrink-0 mt-0.5" />
                  <div>
                    <h4 className="font-bold text-sm text-slate-900 dark:text-white">{homeData.about_feature_1_title}</h4>
                    <p className="text-xs text-slate-500 dark:text-slate-400">{homeData.about_feature_1_desc}</p>
                  </div>
                </div>
                <div className="flex items-start gap-3 p-3.5 rounded-2xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border border-slate-200/80 dark:border-slate-800 shadow-sm">
                  <CheckCircle2 className="h-5 w-5 text-amber-500 shrink-0 mt-0.5" />
                  <div>
                    <h4 className="font-bold text-sm text-slate-900 dark:text-white">{homeData.about_feature_2_title}</h4>
                    <p className="text-xs text-slate-500 dark:text-slate-400">{homeData.about_feature_2_desc}</p>
                  </div>
                </div>
              </div>

              <motion.div whileHover={{ scale: 1.04 }} whileTap={{ scale: 0.96 }}>
                <Link 
                  to="/about" 
                  className="inline-flex items-center gap-2.5 bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-sm px-8 py-3.5 rounded-full shadow-lg transition-all"
                >
                  <span>Learn More About Us</span>
                  <ArrowRight className="h-4 w-4" />
                </Link>
              </motion.div>
            </motion.div>

            {/* Right Column: Mission, Vision, Values Feature Cards */}
            <motion.div 
              initial={{ opacity: 0, x: 30 }} 
              whileInView={{ opacity: 1, x: 0 }} 
              viewport={{ once: true }} 
              transition={{ duration: 0.7, delay: 0.2 }}
              className="lg:col-span-6 flex flex-col gap-5 text-left"
            >
              {/* Card 1: Mission */}
              <motion.div 
                whileHover={{ y: -6, x: 4, scale: 1.01 }}
                transition={{ type: "spring", stiffness: 300, damping: 20 }}
                className="flex items-start gap-4 p-5 rounded-3xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border border-slate-200/80 dark:border-slate-800 border-l-4 border-l-emerald-500 shadow-md hover:shadow-xl transition-all group"
              >
                <div className="w-12 h-12 rounded-2xl bg-emerald-100 dark:bg-emerald-950/80 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0 shadow-inner group-hover:scale-110 transition-transform">
                  <BookOpen className="h-6 w-6" />
                </div>
                <div>
                  <h3 className="font-heading text-lg font-bold text-slate-900 dark:text-white mb-1 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                    Our Mission
                  </h3>
                  <p className="text-slate-600 dark:text-slate-300 text-xs sm:text-sm leading-relaxed">
                    To transform lives by providing access to education, skill development, health awareness, and sustainable livelihood opportunities.
                  </p>
                </div>
              </motion.div>

              {/* Card 2: Vision */}
              <motion.div 
                whileHover={{ y: -6, x: 4, scale: 1.01 }}
                transition={{ type: "spring", stiffness: 300, damping: 20 }}
                className="flex items-start gap-4 p-5 rounded-3xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border border-slate-200/80 dark:border-slate-800 border-l-4 border-l-sky-500 shadow-md hover:shadow-xl transition-all group"
              >
                <div className="w-12 h-12 rounded-2xl bg-sky-100 dark:bg-sky-950/80 text-sky-600 dark:text-sky-400 flex items-center justify-center shrink-0 shadow-inner group-hover:scale-110 transition-transform">
                  <Eye className="h-6 w-6" />
                </div>
                <div>
                  <h3 className="font-heading text-lg font-bold text-slate-900 dark:text-white mb-1 group-hover:text-sky-600 dark:group-hover:text-sky-400 transition-colors">
                    Our Vision
                  </h3>
                  <p className="text-slate-600 dark:text-slate-300 text-xs sm:text-sm leading-relaxed">
                    Empowered communities living with dignity, equality, and opportunity across every region.
                  </p>
                </div>
              </motion.div>

              {/* Card 3: Core Values */}
              <motion.div 
                whileHover={{ y: -6, x: 4, scale: 1.01 }}
                transition={{ type: "spring", stiffness: 300, damping: 20 }}
                className="flex items-start gap-4 p-5 rounded-3xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border border-slate-200/80 dark:border-slate-800 border-l-4 border-l-amber-500 shadow-md hover:shadow-xl transition-all group"
              >
                <div className="w-12 h-12 rounded-2xl bg-amber-100 dark:bg-amber-950/80 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0 shadow-inner group-hover:scale-110 transition-transform">
                  <Users className="h-6 w-6" />
                </div>
                <div>
                  <h3 className="font-heading text-lg font-bold text-slate-900 dark:text-white mb-1 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                    Our Core Values
                  </h3>
                  <p className="text-slate-600 dark:text-slate-300 text-xs sm:text-sm leading-relaxed">
                    Integrity, Inclusiveness, Compassion, Empowerment, Sustainability, and Collaboration.
                  </p>
                </div>
              </motion.div>

            </motion.div>

          </div>
        </div>
      </section>

      {/* ── 4. OUR IMPACT SECTION ── */}
      <section className="py-24 md:py-32 bg-[#0A0E17] text-white relative overflow-hidden">
        {/* Full-Bleed Grassroots Cycling Rally Photographic Backdrop */}
        <div className="absolute inset-0 z-0 overflow-hidden pointer-events-none select-none">
          <img 
            src={cycleRallyImg} 
            alt="Lumina Trust Cycling Drive" 
            className="w-full h-full object-cover opacity-35 filter brightness-50 contrast-125 scale-105" 
          />
          <div className="absolute inset-0 bg-gradient-to-r from-[#0A0E17]/95 via-[#0A0E17]/80 to-[#0A0E17]/95" />
          <div className="absolute inset-0 bg-gradient-to-t from-[#0A0E17] via-transparent to-[#0A0E17]" />
          <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[400px] bg-amber-500/15 rounded-full blur-[140px]" />
        </div>

        <FloatingParticles />

        <div className="w-full px-6 md:px-10 max-w-6xl mx-auto relative z-10 text-center">
          
          {/* Subtitle Accent */}
          <div className="inline-flex items-center gap-2 mb-3">
            <span className="w-6 h-0.5 bg-amber-400 rounded-full" />
            <span className="text-xs sm:text-sm font-bold tracking-widest text-amber-400 uppercase">
              {homeData.impact_subtitle}
            </span>
            <span className="w-6 h-0.5 bg-amber-400 rounded-full" />
          </div>

          <h2 className="font-heading text-4xl sm:text-5xl lg:text-6xl text-white font-extrabold tracking-tight leading-tight">
            {homeData.impact_title}
          </h2>

          <div className="w-16 h-1 bg-amber-400 rounded-full mx-auto mt-4 shadow-[0_0_12px_rgba(245,158,11,0.8)]" />

          {/* Animated Counter Grid with Glowing Frosted Glass Cards */}
          <div className="grid grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8 mt-14 max-w-6xl mx-auto">
            <motion.div
              whileHover={{ y: -8, scale: 1.02 }}
              transition={{ type: "spring", stiffness: 300, damping: 20 }}
              className="bg-slate-900/85 backdrop-blur-xl p-6 sm:p-8 rounded-[1.75rem] border border-white/15 hover:border-amber-400/60 shadow-[0_15px_35px_rgba(0,0,0,0.5)] transition-all duration-300 relative group overflow-hidden"
            >
              <div className="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-amber-400/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300" />
              <AnimatedCounter 
                end={Number(homeData.counter_people_helped) || 1000} 
                suffix={homeData.counter_people_helped_suffix || "+"} 
                label={homeData.counter_people_helped_label || "PEOPLE HELPED"} 
                light={false} 
                icon={
                  <div className="w-14 h-14 rounded-2xl bg-amber-400/20 border border-amber-400/30 flex items-center justify-center text-amber-400 shadow-inner group-hover:scale-110 transition-transform">
                    <Users className="h-7 w-7 stroke-[2]" />
                  </div>
                } 
              />
            </motion.div>

            <motion.div
              whileHover={{ y: -8, scale: 1.02 }}
              transition={{ type: "spring", stiffness: 300, damping: 20 }}
              className="bg-slate-900/85 backdrop-blur-xl p-6 sm:p-8 rounded-[1.75rem] border border-white/15 hover:border-amber-400/60 shadow-[0_15px_35px_rgba(0,0,0,0.5)] transition-all duration-300 relative group overflow-hidden"
            >
              <div className="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-amber-400/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300" />
              <AnimatedCounter 
                end={Number(homeData.counter_volunteers) || 50} 
                suffix={homeData.counter_volunteers_suffix || "+"} 
                label={homeData.counter_volunteers_label || "ACTIVE VOLUNTEERS"} 
                light={false} 
                icon={
                  <div className="w-14 h-14 rounded-2xl bg-amber-400/20 border border-amber-400/30 flex items-center justify-center text-amber-400 shadow-inner group-hover:scale-110 transition-transform">
                    <HandHeart className="h-7 w-7 stroke-[2]" />
                  </div>
                } 
              />
            </motion.div>

            <motion.div
              whileHover={{ y: -8, scale: 1.02 }}
              transition={{ type: "spring", stiffness: 300, damping: 20 }}
              className="bg-slate-900/85 backdrop-blur-xl p-6 sm:p-8 rounded-[1.75rem] border border-white/15 hover:border-amber-400/60 shadow-[0_15px_35px_rgba(0,0,0,0.5)] transition-all duration-300 relative group overflow-hidden"
            >
              <div className="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-amber-400/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300" />
              <AnimatedCounter 
                end={Number(homeData.counter_projects_done) || 10} 
                suffix={homeData.counter_projects_done_suffix || "+"} 
                label={homeData.counter_projects_done_label || "PROJECTS DONE"} 
                light={false} 
                icon={
                  <div className="w-14 h-14 rounded-2xl bg-amber-400/20 border border-amber-400/30 flex items-center justify-center text-amber-400 shadow-inner group-hover:scale-110 transition-transform">
                    <Target className="h-7 w-7 stroke-[2]" />
                  </div>
                } 
              />
            </motion.div>

            <motion.div
              whileHover={{ y: -8, scale: 1.02 }}
              transition={{ type: "spring", stiffness: 300, damping: 20 }}
              className="bg-slate-900/85 backdrop-blur-xl p-6 sm:p-8 rounded-[1.75rem] border border-white/15 hover:border-amber-400/60 shadow-[0_15px_35px_rgba(0,0,0,0.5)] transition-all duration-300 relative group overflow-hidden"
            >
              <div className="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-amber-400/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300" />
              <AnimatedCounter 
                end={Number(homeData.counter_communities) || 10} 
                suffix={homeData.counter_communities_suffix || "+"} 
                label={homeData.counter_communities_label || "COMMUNITIES"} 
                light={false} 
                icon={
                  <div className="w-14 h-14 rounded-2xl bg-amber-400/20 border border-amber-400/30 flex items-center justify-center text-amber-400 shadow-inner group-hover:scale-110 transition-transform">
                    <Users className="h-7 w-7 stroke-[2]" />
                  </div>
                } 
              />
            </motion.div>
          </div>

        </div>
      </section>

      {/* ── 5. OUR ACTIVITIES / FEATURED PROJECTS ── */}
      <section className="py-24 md:py-32 relative overflow-hidden bg-[#FAF8F5] dark:bg-slate-950">
        {/* Real Grassroots Education Training Photographic Backdrop */}
        <div className="absolute inset-0 z-0 overflow-hidden pointer-events-none select-none">
          <img 
            src={examPrepPhoto} 
            alt="Lumina Trust Training Session" 
            className="w-full h-full object-cover opacity-20 filter blur-[1px] brightness-105 scale-105" 
          />
          <div className="absolute inset-0 bg-gradient-to-b from-[#FAF8F5]/95 via-[#FFFFFF]/85 to-[#FAF8F5]/95 dark:from-slate-950/95 dark:via-slate-900/85 dark:to-slate-950/95" />
          <div className="absolute top-0 right-1/4 w-[500px] h-[500px] bg-amber-400/10 rounded-full blur-[140px]" />
          <div className="absolute bottom-0 left-1/4 w-[500px] h-[500px] bg-emerald-400/10 rounded-full blur-[140px]" />
        </div>

        <div className="w-full px-6 md:px-10 max-w-7xl mx-auto relative z-10">
          <SectionHeading
            subtitle="What We Do"
            title="Our Activities & Initiatives"
            description="Committed to serving humanity through charitable activities designed to make a positive impact."
          />

          <div className="grid grid-cols-1 lg:grid-cols-2 gap-7 lg:gap-8 mt-12 md:mt-14 text-left">
            {[
              {
                icon: <BookOpen className="h-5 w-5 text-amber-600 dark:text-amber-400" />,
                tag: "Education Pillar",
                title: "Education & Student Training",
                desc: "Providing free books, competitive exam training, and skill-building workshops for government school students across Tamil Nadu.",
                image: bookDistributionImg,
                borderColor: "border-slate-200/90 dark:border-slate-800 hover:border-amber-400/70 dark:hover:border-amber-400/50",
                badgeClass: "bg-white/95 text-amber-800 dark:bg-slate-900/95 dark:text-amber-300 border border-amber-300/50 backdrop-blur-md",
                iconCircleClass: "bg-amber-50 text-amber-600 dark:bg-amber-950/40 dark:text-amber-400 ring-4 ring-amber-100/50 dark:ring-amber-950/20",
                titleHoverClass: "group-hover:text-amber-600 dark:group-hover:text-amber-400",
                linkClass: "text-[#064e3b] dark:text-emerald-400 group-hover:text-amber-600 dark:group-hover:text-amber-400",
                link: "/projects"
              },
              {
                icon: <Target className="h-5 w-5 text-cyan-600 dark:text-cyan-400" />,
                tag: "Livelihood & Skill",
                title: "Livelihood & Career Support",
                desc: "Empowering youth and women with career guidance, vocational skills, and entrepreneurship opportunities for sustainable income.",
                image: beachCleanImg,
                borderColor: "border-slate-200/90 dark:border-slate-800 hover:border-cyan-400/70 dark:hover:border-cyan-400/50",
                badgeClass: "bg-white/95 text-cyan-800 dark:bg-slate-900/95 dark:text-cyan-300 border border-cyan-300/50 backdrop-blur-md",
                iconCircleClass: "bg-cyan-50 text-cyan-600 dark:bg-cyan-950/40 dark:text-cyan-400 ring-4 ring-cyan-100/50 dark:ring-cyan-950/20",
                titleHoverClass: "group-hover:text-cyan-600 dark:group-hover:text-cyan-400",
                linkClass: "text-[#064e3b] dark:text-emerald-400 group-hover:text-cyan-600 dark:group-hover:text-cyan-400",
                link: "/projects"
              },
              {
                icon: <HandHeart className="h-5 w-5 text-emerald-600 dark:text-emerald-400" />,
                tag: "Health Care",
                title: "Health Camps & Hero Recognition",
                desc: "Organizing free community medical camps, health awareness drives, and honoring dedicated doctors and healthcare professionals.",
                image: doctorsDayImg,
                borderColor: "border-slate-200/90 dark:border-slate-800 hover:border-emerald-400/70 dark:hover:border-emerald-400/50",
                badgeClass: "bg-white/95 text-emerald-800 dark:bg-slate-900/95 dark:text-emerald-300 border border-emerald-300/50 backdrop-blur-md",
                iconCircleClass: "bg-emerald-50 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-400 ring-4 ring-emerald-100/50 dark:ring-emerald-950/20",
                titleHoverClass: "group-hover:text-emerald-600 dark:group-hover:text-emerald-400",
                linkClass: "text-[#064e3b] dark:text-emerald-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-400",
                link: "/projects"
              },
              {
                icon: <Users className="h-5 w-5 text-emerald-700 dark:text-emerald-400" />,
                tag: "Environment & Community",
                title: "Environmental & Community Drives",
                desc: "Leading plastic-free campaigns, beach cleanups, sparrow conservation, and tree plantation drives to protect local ecosystems.",
                image: treePlantationImg,
                borderColor: "border-slate-200/90 dark:border-slate-800 hover:border-emerald-500/70 dark:hover:border-emerald-400/50",
                badgeClass: "bg-white/95 text-emerald-900 dark:bg-slate-900/95 dark:text-emerald-300 border border-emerald-400/50 backdrop-blur-md",
                iconCircleClass: "bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400 ring-4 ring-emerald-100/50 dark:ring-emerald-950/20",
                titleHoverClass: "group-hover:text-emerald-700 dark:group-hover:text-emerald-400",
                linkClass: "text-[#064e3b] dark:text-emerald-400 group-hover:text-emerald-700 dark:group-hover:text-emerald-300",
                link: "/projects"
              },
            ].map((item, i) => (
              <motion.div
                key={i}
                initial={{ opacity: 0, y: shouldReduceMotion ? 0 : 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true, margin: "-40px" }}
                transition={{
                  duration: shouldReduceMotion ? 0 : 0.45,
                  ease: [0.25, 0.1, 0.25, 1],
                  delay: shouldReduceMotion ? 0 : i * 0.08,
                }}
                className="h-full"
              >
                <div
                  className={`group relative h-full bg-white dark:bg-slate-900 rounded-[1.75rem] overflow-hidden border ${item.borderColor} shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_40px_-10px_rgba(15,23,42,0.12),0_10px_20px_-5px_rgba(0,0,0,0.04)] transition-all duration-400 ease-out hover:-translate-y-2 flex flex-col sm:flex-row motion-reduce:transform-none motion-reduce:transition-none`}
                >
                  {/* Left: Image Container with Category Pill */}
                  <div className="w-full sm:w-[42%] relative h-56 sm:h-auto min-h-[220px] sm:min-h-[270px] overflow-hidden shrink-0">
                    <img
                      src={item.image}
                      alt={item.title}
                      className="w-full h-full object-cover transition-transform duration-500 ease-out will-change-transform group-hover:scale-105 motion-reduce:transform-none"
                      loading="lazy"
                    />
                    <div className="absolute inset-0 bg-gradient-to-t sm:bg-gradient-to-r from-black/40 via-transparent to-transparent pointer-events-none" />

                    {/* Category Pill positioned neatly over image */}
                    <span
                      className={`absolute top-4 left-4 z-10 inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest shadow-xs transition-transform duration-300 ease-out group-hover:scale-105 ${item.badgeClass}`}
                    >
                      {item.tag}
                    </span>
                  </div>

                  {/* Right: Content Area with Soft Circular Icon */}
                  <div className="w-full sm:w-[58%] p-6 sm:p-7 md:p-8 flex flex-col justify-between flex-1 bg-white dark:bg-slate-900">
                    <div>
                      {/* Icon styled inside soft circular background */}
                      <div
                        className={`w-12 h-12 rounded-full flex items-center justify-center mb-4 transition-transform duration-300 ease-out group-hover:scale-110 shadow-xs ${item.iconCircleClass}`}
                      >
                        {item.icon}
                      </div>

                      {/* Improved Title Typography */}
                      <h3
                        className={`font-heading text-xl sm:text-[1.35rem] font-bold text-slate-900 dark:text-white mb-2.5 leading-snug tracking-tight transition-colors duration-300 ${item.titleHoverClass}`}
                      >
                        {item.title}
                      </h3>

                      {/* Description Readability */}
                      <p className="text-slate-600 dark:text-slate-300 text-xs sm:text-sm leading-relaxed mb-6 line-clamp-3">
                        {item.desc}
                      </p>
                    </div>

                    {/* Visually Attractive “EXPLORE INITIATIVE →” Action Link */}
                    <div className="pt-2 border-t border-slate-100 dark:border-slate-800/80">
                      <Link
                        to={item.link}
                        className={`inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-wider transition-colors duration-300 group/link focus-visible:outline-hidden focus-visible:ring-2 focus-visible:ring-amber-400 rounded-sm ${item.linkClass}`}
                      >
                        <span>Explore Initiative</span>
                        <ArrowRight className="h-3.5 w-3.5 transition-transform duration-300 ease-out group-hover:translate-x-1.5" />
                      </Link>
                    </div>
                  </div>
                </div>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* ── 5.1 FEATURED PROJECTS / COMMUNITY DEVELOPMENT ── */}
      <section className="py-24 md:py-32 relative overflow-hidden bg-[#FAF8F5] dark:bg-slate-950 border-t border-slate-200/50 dark:border-slate-800/50">
        <div className="w-full px-6 md:px-10 max-w-7xl mx-auto relative z-10">
          <SectionHeading
            subtitle="Our Causes"
            title="Community Development Projects"
            description="We work closely with communities, government bodies, and partners to design and implement impactful programs that address real needs and create sustainable solutions."
          />

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-12 md:mt-14">
            {featuredProjects.map((p, idx) => (
              <ProjectCard
                key={p.id || idx}
                index={idx}
                id={p.id}
                image={p.image}
                title={p.title}
                category={p.category}
                description={p.description}
                progress={p.progress}
                location={p.location}
              />
            ))}
          </div>

          <div className="text-center mt-12">
            <Link
              to="/projects"
              className="inline-flex items-center gap-2 border-2 border-amber-400 text-amber-600 dark:text-amber-400 px-8 py-3.5 rounded-full font-bold text-sm hover:bg-amber-400 hover:text-amber-950 transition-all shadow-md hover:shadow-lg"
            >
              <span>View All Projects</span>
              <ArrowRight className="h-4 w-4" />
            </Link>
          </div>
        </div>
      </section>

      {/* ── 6. TESTIMONIALS ── */}
      <Testimonial />

      {/* ── 7. NEWSLETTER CTA SECTION ── */}
      <section className="py-24 md:py-32 bg-[#06120D] text-white relative overflow-hidden">
        {/* Full-Bleed Tree Plantation Grassroots Photographic Backdrop */}
        <div className="absolute inset-0 z-0 overflow-hidden pointer-events-none select-none">
          <img 
            src={treePlantationImg} 
            alt="Lumina Trust Tree Plantation Drive" 
            className="w-full h-full object-cover opacity-35 filter brightness-50 contrast-125 scale-105" 
          />
          <div className="absolute inset-0 bg-gradient-to-r from-[#06120D]/95 via-[#0A1813]/80 to-[#06120D]/95" />
          <div className="absolute inset-0 bg-gradient-to-t from-[#06120D] via-transparent to-[#06120D]" />
          <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[650px] h-[400px] bg-emerald-500/20 rounded-full blur-[140px]" />
        </div>

        <div className="w-full px-6 md:px-10 max-w-4xl mx-auto text-center relative z-10">
          <div className="bg-slate-900/85 backdrop-blur-2xl border border-white/20 rounded-[2.5rem] p-8 md:p-14 shadow-[0_25px_60px_rgba(0,0,0,0.6)] text-white relative overflow-hidden">
            {/* Soft decorative inner glow */}
            <div className="absolute top-0 right-0 w-64 h-64 bg-amber-400/10 rounded-full blur-3xl pointer-events-none" />

            <div className="text-center max-w-2xl mx-auto">
              <div className="inline-flex items-center gap-2 mb-3">
                <span className="w-6 h-0.5 bg-amber-400 rounded-full" />
                <span className="text-xs sm:text-sm font-bold tracking-widest text-amber-400 uppercase">
                  {homeData.newsletter_subtitle}
                </span>
                <span className="w-6 h-0.5 bg-amber-400 rounded-full" />
              </div>
              <h2 className="font-heading text-3xl sm:text-4xl lg:text-5xl text-white font-extrabold tracking-tight leading-tight">
                {homeData.newsletter_title}
              </h2>
              <p className="text-white/80 text-sm sm:text-base mt-4 leading-relaxed">
                {homeData.newsletter_description}
              </p>
            </div>

            <form onSubmit={handleNewsletter} className="flex flex-col sm:flex-row items-center justify-center gap-3 mt-8 max-w-lg mx-auto">
              <input
                type="email"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                placeholder="Enter your email address"
                required
                className="w-full sm:w-auto flex-1 px-6 py-4 rounded-full bg-slate-950/80 border border-white/20 text-white placeholder:text-white/50 focus:outline-none focus:border-amber-400 text-sm shadow-inner transition-colors"
              />
              <button
                type="submit"
                disabled={isSubmitting}
                className="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-500 hover:to-amber-600 text-amber-950 px-8 py-4 rounded-full font-extrabold text-sm shadow-gold hover:shadow-xl transition-all hover:scale-105 cursor-pointer"
              >
                <span>{isSubmitting ? "Subscribing..." : "Subscribe"}</span>
                <Send className="h-4 w-4" />
              </button>
            </form>

            <div className="flex flex-wrap items-center justify-center gap-6 mt-8 pt-6 border-t border-white/10 text-white/60 text-xs">
              <span className="flex items-center gap-1.5">
                <CheckCircle2 className="h-3.5 w-3.5 text-emerald-400" /> No spam ever
              </span>
              <span className="flex items-center gap-1.5">
                <CheckCircle2 className="h-3.5 w-3.5 text-amber-400" /> Monthly impact reports
              </span>
              <span className="flex items-center gap-1.5">
                <CheckCircle2 className="h-3.5 w-3.5 text-emerald-400" /> Grassroots stories
              </span>
            </div>
          </div>
        </div>
      </section>

    </div>
  );
};

export default Home;
