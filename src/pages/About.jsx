import { Link } from "react-router-dom";
import { motion } from "framer-motion";
import { useEffect, useState } from "react";
import { 
  Users, 
  Target, 
  Shield, 
  Sparkles, 
  Eye, 
  Compass, 
  BookOpen, 
  Trees, 
  HeartPulse, 
  TrendingUp, 
  CheckCircle2, 
  ArrowRight, 
  ChevronRight, 
  Award, 
  Globe, 
  HandHeart,
  Lightbulb,
  GraduationCap
} from "lucide-react";
import heroBg from "@/assets/hero-bg.jpg";
import bookDistributionImg from "@/assets/activits/Book given to students/b2.png";
import AnimatedCounter from "@/components/AnimatedCounter";
import SectionHeading from "@/components/SectionHeading";
import HeroBackground from "@/components/HeroBackground";
import MarqueeRibbon from "@/components/MarqueeRibbon";
import { FloatingParticles, staggerContainer, staggerItem, GlowCard } from "@/components/AnimationEffects";

const team = [
  { name: "Ananya Kapoor", role: "Founder & CEO", gradient: "from-amber-400 to-orange-500", desc: "Visionary leader passionate about social equity and grassroots empowerment." },
  { name: "Vikram Mehta", role: "Director of Operations", gradient: "from-cyan-400 to-blue-600", desc: "Oversees program deployment, partner engagement, and field logistics." },
  { name: "Dr. Lakshmi Rao", role: "Head of Healthcare", gradient: "from-rose-400 to-pink-600", desc: "Leads free medical camps, community health initiatives, and doctor drives." },
  { name: "Arjun Singh", role: "Community Director", gradient: "from-emerald-400 to-teal-600", desc: "Drives student education programs, skill workshops, and volunteer mobilization." },
];

const About = () => {
  const [aboutData, setAboutData] = useState({
    title: "About Lumina Trust",
    subtitle: "Dedicated Non-Profit Organization",
    story: "Lumina Trust is a community-focused organization dedicated to uplifting underserved populations through sustainable and inclusive development initiatives. We work at the grassroots level to enable individuals and communities to achieve dignity, independence, and long-term growth.",
    hero_button_text: "Our Initiatives",
    hero_button_link: "/projects",
    secondary_button_text: "Support Our Cause",
    secondary_button_link: "/donate",
    who_we_are_title: "Uplifting Underserved Communities with Dignity",
    who_we_are_description: "Lumina Trust is a purpose-driven organization dedicated to uplifting underserved populations through sustainable and inclusive development initiatives. We work directly at the grassroots level to create meaningful change by enabling individuals and communities to achieve dignity, independence, and long-term growth.",
    image_badge_text: "100% Non-Profit NGO",
    mission: "To transform lives by providing direct access to quality education, skill development programs, preventive health awareness, and sustainable livelihood opportunities.",
    vision: "Empowered communities living with dignity, equality, and opportunity.",
    beneficiaries_count: "10,000+",
    projects_count: "150+",
    volunteers_count: "500+",
    cities_count: "25+",
    founder_name: "Ananya Kapoor",
    founder_title: "Founder & CEO",
    founder_message: "Together, we aim to illuminate lives and build a brighter, more equitable future for all.",
    main_image_url: heroBg
  });

  useEffect(() => {
    fetch("http://localhost:8000/api/about")
      .then((res) => res.json())
      .then((data) => {
        if (data) {
          setAboutData({
            title: data.title || "About Lumina Trust",
            subtitle: data.subtitle || "Dedicated Non-Profit Organization",
            story: data.story || "Lumina Trust is a community-focused organization dedicated to uplifting underserved populations through sustainable and inclusive development initiatives.",
            hero_button_text: data.hero_button_text || "Our Initiatives",
            hero_button_link: data.hero_button_link || "/projects",
            secondary_button_text: data.secondary_button_text || "Support Our Cause",
            secondary_button_link: data.secondary_button_link || "/donate",
            who_we_are_title: data.who_we_are_title || "Uplifting Underserved Communities with Dignity",
            who_we_are_description: data.who_we_are_description || data.story || "Lumina Trust is a purpose-driven organization dedicated to uplifting underserved populations through sustainable and inclusive development initiatives.",
            image_badge_text: data.image_badge_text || "100% Non-Profit NGO",
            mission: data.mission || "To transform lives by providing direct access to quality education, skill development programs, preventive health awareness, and sustainable livelihood opportunities.",
            mission_title: data.mission_title || "Transforming Lives Through Education & Healthcare",
            mission_points: Array.isArray(data.mission_points) && data.mission_points.length > 0 ? data.mission_points : [
              "Free educational support & exam materials",
              "Free medical check-up drives & health awareness",
              "Vocational guidance & youth skill building"
            ],
            vision: data.vision || "Empowered communities living with dignity, equality, and opportunity.",
            vision_title: data.vision_title || "Empowered Communities Living with Dignity & Equality",
            vision_points: Array.isArray(data.vision_points) && data.vision_points.length > 0 ? data.vision_points : [
              "Self-reliant grassroots development",
              "Equal access to education and training",
              "Healthy, sustainable, and green environments"
            ],
            impact_subtitle: data.impact_subtitle || "Areas of Impact",
            impact_title: data.impact_title || "Where We Make a Difference",
            impact_description: data.impact_description || "Our integrated programs address key pillars of community welfare for holistic social improvement.",
            impact_items: Array.isArray(data.impact_items) && data.impact_items.length > 0 ? data.impact_items : [],
            process_subtitle: data.process_subtitle || "Our Process",
            process_title: data.process_title || "How We Work",
            process_description: data.process_description || "Our systematic approach ensures every initiative reaches the right beneficiaries with maximum accountability.",
            process_steps: Array.isArray(data.process_steps) && data.process_steps.length > 0 ? data.process_steps : [],
            team_subtitle: data.team_subtitle || "Leadership",
            team_title: data.team_title || "Meet Our Team",
            team_description: data.team_description || "Dedicated professionals driving positive grassroots change every day.",
            team_members: Array.isArray(data.team_members) && data.team_members.length > 0 ? data.team_members : team,
            beneficiaries_count: data.beneficiaries_count || "10,000+",
            projects_count: data.projects_count || "150+",
            volunteers_count: data.volunteers_count || "500+",
            cities_count: data.cities_count || "25+",
            founder_name: data.founder_name || "Ananya Kapoor",
            founder_title: data.founder_title || "Founder & CEO",
            founder_message: data.founder_message || "Together, we aim to illuminate lives and build a brighter, more equitable future for all.",
            main_image_url: data.main_image_url || heroBg,
            core_values: data.core_values || []
          });
        }
      })
      .catch((err) => {
        console.log("Using fallback About page data", err);
      });
  }, []);

  const parseStat = (str, defaultNum, defaultSuffix = "+") => {
    if (!str) return { num: defaultNum, suffix: defaultSuffix };
    const num = parseInt(str.replace(/[^0-9]/g, ""), 10);
    const suffix = str.replace(/[0-9,\s]/g, "") || defaultSuffix;
    return { num: isNaN(num) ? defaultNum : num, suffix };
  };

  const stat1 = parseStat(aboutData.beneficiaries_count, 10000);
  const stat2 = parseStat(aboutData.projects_count, 150);
  const stat3 = parseStat(aboutData.volunteers_count, 500);
  const stat4 = parseStat(aboutData.cities_count, 25);

  return (
    <div className="overflow-hidden">
      {/* ── 1. HERO SECTION ── */}
      <section className="relative bg-slate-950 py-24 md:py-32 lg:py-36 min-h-[75vh] flex items-center">
        {/* Visual Background Collage with Overlaid Dark Backdrop */}
        <HeroBackground />
        
        {/* Main Content Grid */}
        <div className="w-full px-6 md:px-10 max-w-7xl mx-auto relative z-10">
          <div className="grid grid-cols-1 md:grid-cols-12 gap-10 lg:gap-14 items-center">
            
            {/* Left Column: Breadcrumb, Badge, Heading, Description, CTA */}
            <motion.div 
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.6, ease: "easeOut" }}
              className="md:col-span-7 lg:col-span-7 text-left"
            >
              {/* Breadcrumb */}
              <nav aria-label="Breadcrumb" className="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-amber-400 mb-4">
                <Link to="/" className="text-white/60 hover:text-white transition-colors">Home</Link>
                <ChevronRight className="h-3.5 w-3.5 text-white/40" />
                <span>About Us</span>
              </nav>

              {/* Badge */}
              <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-400/10 border border-amber-400/20 text-amber-300 text-xs font-semibold tracking-wide mb-6">
                <Sparkles className="h-3.5 w-3.5 text-amber-400 shrink-0" />
                <span>{aboutData.subtitle}</span>
              </div>

              {/* Heading */}
              <h1 className="font-heading text-3xl sm:text-4xl md:text-5xl lg:text-6xl text-white font-bold leading-tight tracking-tight mb-5">
                {/lumina trust/i.test(aboutData.title) ? (
                  <>
                    {aboutData.title.replace(/lumina trust/i, "").trim()}{" "}
                    <span className="text-amber-400">Lumina Trust</span>
                  </>
                ) : (
                  aboutData.title
                )}
              </h1>

              {/* Introductory Paragraph */}
              <p className="text-white/80 text-base md:text-lg leading-relaxed mb-8 max-w-xl">
                {aboutData.story}
              </p>

              {/* CTA Buttons */}
              <div className="flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                <Link 
                  to={aboutData.hero_button_link || "/projects"} 
                  className="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-full bg-amber-400 hover:bg-amber-500 text-slate-950 font-bold text-sm transition-colors shadow-sm"
                >
                  <span>{aboutData.hero_button_text || "Our Initiatives"}</span>
                  <ArrowRight className="h-4 w-4" />
                </Link>
                <Link 
                  to={aboutData.secondary_button_link || "/volunteer"} 
                  className="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-full border border-white/20 hover:border-white/40 text-white font-semibold text-sm transition-colors"
                >
                  <span>{aboutData.secondary_button_text || "Volunteer with Us"}</span>
                </Link>
              </div>
            </motion.div>

            {/* Right Column: Integrated Image Visual */}
            <motion.div 
              initial={{ opacity: 0, scale: 0.96 }}
              animate={{ opacity: 1, scale: 1 }}
              transition={{ duration: 0.6, delay: 0.15, ease: "easeOut" }}
              className="md:col-span-5 lg:col-span-5"
            >
              <div className="relative rounded-2xl overflow-hidden border border-white/10 shadow-2xl bg-slate-900">
                <img 
                  src={aboutData.main_image_url || heroBg} 
                  alt={aboutData.title} 
                  className="w-full h-[320px] sm:h-[380px] md:h-[400px] lg:h-[440px] object-cover"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent" />
                
                {/* Clean Image Caption Strip */}
                <div className="absolute bottom-0 left-0 right-0 p-5 bg-slate-950/90 border-t border-white/10 flex items-center justify-between">
                  <div>
                    <h4 className="text-white text-sm font-bold">Community Empowerment</h4>
                    <p className="text-white/60 text-xs mt-0.5">Grassroots Impact Across Tamil Nadu</p>
                  </div>
                  <div className="w-8 h-8 rounded-full bg-amber-400/10 flex items-center justify-center text-amber-400 shrink-0">
                    <Sparkles className="h-4 w-4" />
                  </div>
                </div>
              </div>
            </motion.div>

          </div>
        </div>
      </section>

      {/* ── LIVE MARQUEE IMPACT BANNER ── */}
      <MarqueeRibbon />

      {/* ── 2. WHO WE ARE (SPLIT LAYOUT) ── */}
      <section className="py-28 md:py-36 relative">
        <div className="absolute top-0 right-0 w-96 h-96 bg-amber-400/5 rounded-full blur-3xl pointer-events-none" />
        <div className="absolute bottom-0 left-0 w-96 h-96 bg-teal-400/5 rounded-full blur-3xl pointer-events-none" />

        <div className="w-full px-6 md:px-10 max-w-6xl mx-auto relative z-10">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            {/* Left Content */}
            <motion.div
              initial={{ opacity: 0, x: -40 }}
              whileInView={{ opacity: 1, x: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.7 }}
            >
              <SectionHeading subtitle="Who We Are" title={aboutData.who_we_are_title || "Uplifting Underserved Communities with Dignity"} align="left" />
              
              <p className="text-muted-foreground leading-relaxed text-lg mb-6 whitespace-pre-line">
                {aboutData.who_we_are_description || "Lumina Trust is a purpose-driven organization dedicated to uplifting underserved populations through sustainable and inclusive development initiatives. We work directly at the grassroots level to create meaningful change by enabling individuals and communities to achieve dignity, independence, and long-term growth."}
              </p>

              {/* Key Values List */}
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8 pt-6 border-t border-border/60">
                {(Array.isArray(aboutData.core_values) && aboutData.core_values.length > 0
                  ? aboutData.core_values.map((v) => typeof v === 'string' ? { label: v, desc: "Grassroots community initiative." } : { label: v.title || v.label, desc: v.description || v.desc })
                  : [
                      { label: "Integrity & Accountability", desc: "Honest, transparent operations." },
                      { label: "Inclusive Growth", desc: "Equal opportunities for all." },
                      { label: "Compassionate Action", desc: "Serving with empathy & care." },
                      { label: "Sustainable Impact", desc: "Long-term self-reliance." },
                    ]
                ).map((item, index) => (
                  <div key={index} className="flex items-start gap-3">
                    <div className="w-6 h-6 rounded-full bg-amber-400/20 text-amber-500 flex items-center justify-center shrink-0 mt-0.5">
                      <CheckCircle2 className="h-4 w-4" />
                    </div>
                    <div>
                      <h4 className="font-semibold text-sm text-foreground">{item.label}</h4>
                      {item.desc && <p className="text-xs text-muted-foreground">{item.desc}</p>}
                    </div>
                  </div>
                ))}
              </div>
            </motion.div>

            {/* Right Image Container with Floating Badge */}
            <motion.div
              initial={{ opacity: 0, x: 40 }}
              whileInView={{ opacity: 1, x: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.7 }}
              className="relative"
            >
              <div className="absolute -inset-6 bg-gradient-to-br from-amber-400/15 via-teal-400/10 to-cyan-400/15 rounded-3xl blur-2xl pointer-events-none" />
              
              <div className="relative rounded-3xl overflow-hidden shadow-ngo border border-border/50">
                <img 
                  src={aboutData.who_we_are_image_url || bookDistributionImg} 
                  alt="Lumina Trust Community Work" 
                  className="w-full h-[460px] object-cover"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent" />
              </div>

              {/* Floating Badge Overlay */}
              <motion.div
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ delay: 0.4 }}
                className="absolute -bottom-6 -left-6 glass-dark rounded-2xl p-5 z-20 border border-white/10 shadow-2xl flex items-center gap-4"
              >
                <div className="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-400 to-amber-500 flex items-center justify-center shadow-md">
                  <Award className="h-6 w-6 text-slate-950" />
                </div>
                <div>
                  <p className="text-white text-base font-bold">{aboutData.image_badge_text || "100% Non-Profit NGO"}</p>
                  <p className="text-white/60 text-xs font-medium">Grassroots Development Initiatives</p>
                </div>
              </motion.div>
            </motion.div>
          </div>
        </div>
      </section>

      {/* ── 3. MISSION & VISION (DISTINCT CARDS) ── */}
      <section className="py-24 bg-gradient-to-b from-slate-50 via-warm to-background dark:from-slate-950 dark:via-background dark:to-slate-950">
        <div className="w-full px-6 md:px-10 max-w-6xl mx-auto">
          <SectionHeading 
            subtitle="Our Purpose" 
            title="Mission & Vision" 
            description="Clear direction and core conviction driving every initiative at Lumina Trust." 
          />

          <div className="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">
            {/* Vision Card */}
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.6 }}
            >
              <GlowCard>
                <div className="bg-card rounded-3xl p-8 md:p-10 shadow-ngo border-t-4 border-amber-400 h-full flex flex-col justify-between relative overflow-hidden group hover:shadow-card-hover transition-shadow duration-500">
                  <div className="absolute top-0 right-0 w-32 h-32 bg-amber-400/10 rounded-full blur-2xl pointer-events-none" />
                  
                  <div>
                    <div className="w-14 h-14 rounded-2xl bg-amber-400/15 flex items-center justify-center mb-6 text-amber-500 shadow-sm group-hover:scale-110 transition-transform">
                      <Eye className="h-7 w-7" />
                    </div>

                    <span className="text-xs font-bold uppercase tracking-widest text-amber-500 mb-2 block">
                      Our Vision
                    </span>

                    <h3 className="font-heading text-2xl md:text-3xl text-foreground mb-4 leading-tight">
                      {aboutData.vision_title || "Empowered Communities Living with Dignity & Equality"}
                    </h3>

                    <p className="text-muted-foreground leading-relaxed text-base">
                      {aboutData.vision}
                    </p>
                  </div>

                  <ul className="mt-8 pt-6 border-t border-border/60 space-y-2.5">
                    {(aboutData.vision_points || [
                      "Self-reliant grassroots development",
                      "Equal access to education and training",
                      "Healthy, sustainable, and green environments"
                    ]).map((point, index) => (
                      <li key={index} className="flex items-center gap-2 text-sm text-foreground">
                        <ChevronRight className="h-4 w-4 text-amber-500 shrink-0" />
                        <span>{point}</span>
                      </li>
                    ))}
                  </ul>
                </div>
              </GlowCard>
            </motion.div>

            {/* Mission Card */}
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.6, delay: 0.2 }}
            >
              <GlowCard>
                <div className="bg-card rounded-3xl p-8 md:p-10 shadow-ngo border-t-4 border-teal-400 h-full flex flex-col justify-between relative overflow-hidden group hover:shadow-card-hover transition-shadow duration-500">
                  <div className="absolute top-0 right-0 w-32 h-32 bg-teal-400/10 rounded-full blur-2xl pointer-events-none" />
                  
                  <div>
                    <div className="w-14 h-14 rounded-2xl bg-teal-400/15 flex items-center justify-center mb-6 text-teal-500 shadow-sm group-hover:scale-110 transition-transform">
                      <Target className="h-7 w-7" />
                    </div>

                    <span className="text-xs font-bold uppercase tracking-widest text-teal-500 mb-2 block">
                      Our Mission
                    </span>

                    <h3 className="font-heading text-2xl md:text-3xl text-foreground mb-4 leading-tight">
                      {aboutData.mission_title || "Transforming Lives Through Education & Healthcare"}
                    </h3>

                    <p className="text-muted-foreground leading-relaxed text-base">
                      {aboutData.mission}
                    </p>
                  </div>

                  <ul className="mt-8 pt-6 border-t border-border/60 space-y-2.5">
                    {(aboutData.mission_points || [
                      "Free educational support & exam materials",
                      "Free medical check-up drives & health awareness",
                      "Vocational guidance & youth skill building"
                    ]).map((point, index) => (
                      <li key={index} className="flex items-center gap-2 text-sm text-foreground">
                        <ChevronRight className="h-4 w-4 text-teal-500 shrink-0" />
                        <span>{point}</span>
                      </li>
                    ))}
                  </ul>
                </div>
              </GlowCard>
            </motion.div>
          </div>
        </div>
      </section>

      {/* ── 4. OUR FOCUS / AREAS OF IMPACT ── */}
      <section className="py-28">
        <div className="w-full px-6 md:px-10 max-w-7xl mx-auto">
          <SectionHeading 
            subtitle={aboutData.impact_subtitle || "Areas of Impact"} 
            title={aboutData.impact_title || "Where We Make a Difference"} 
            description={aboutData.impact_description || "Our integrated programs address key pillars of community welfare for holistic social improvement."}
          />

          <motion.div 
            variants={staggerContainer} 
            initial="hidden" 
            whileInView="show" 
            viewport={{ once: true }} 
            className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-12"
          >
            {(Array.isArray(aboutData.impact_items) && aboutData.impact_items.length > 0
              ? aboutData.impact_items
              : [
                  { title: "Education & Literacy", description: "Distributing free books, notebooks, competitive exam kits, and conducting academic training for government school students." },
                  { title: "Health & Healthcare", description: "Organizing free medical camps, wellness awareness sessions, and honoring healthcare professionals for dedicated service." },
                  { title: "Environment & Ecology", description: "Leading plastic-free drives, beach cleanups, sparrow box distribution, and massive tree plantation initiatives." },
                  { title: "Skills & Livelihood", description: "Career guidance, youth skill training, and empowering women to achieve economic independence and dignity." }
                ]
            ).map((item, i) => {
              const icons = [
                <GraduationCap className="h-7 w-7 text-amber-500" />,
                <HeartPulse className="h-7 w-7 text-rose-500" />,
                <Trees className="h-7 w-7 text-emerald-500" />,
                <TrendingUp className="h-7 w-7 text-cyan-500" />
              ];
              const accents = ["border-amber-400/40 hover:border-amber-500", "border-rose-400/40 hover:border-rose-500", "border-emerald-400/40 hover:border-emerald-500", "border-cyan-400/40 hover:border-cyan-500"];
              const badgeBgs = ["bg-amber-500/10 text-amber-600 dark:text-amber-400", "bg-rose-500/10 text-rose-600 dark:text-rose-400", "bg-emerald-500/10 text-emerald-600 dark:text-emerald-400", "bg-cyan-500/10 text-cyan-600 dark:text-cyan-400"];

              const icon = icons[i % icons.length];
              const accent = accents[i % accents.length];
              const badgeBg = badgeBgs[i % badgeBgs.length];

              return (
                <motion.div key={i} variants={staggerItem}>
                  <motion.div
                    whileHover={{ y: -6 }}
                    transition={{ type: "spring", stiffness: 300 }}
                    className={`bg-card rounded-2xl p-7 shadow-ngo border ${accent} transition-all duration-300 h-full flex flex-col justify-between group`}
                  >
                    <div>
                      <div className={`w-14 h-14 rounded-2xl ${badgeBg} flex items-center justify-center mb-6 group-hover:scale-110 transition-transform`}>
                        {icon}
                      </div>
                      <h3 className="font-heading text-xl text-foreground mb-3 font-bold">{item.title}</h3>
                      <p className="text-muted-foreground text-sm leading-relaxed">{item.description || item.desc}</p>
                    </div>
                    <div className="mt-6 pt-4 border-t border-border/40 flex items-center justify-between">
                      <Link to="/projects" className="text-xs font-bold text-amber-500 hover:text-amber-600 uppercase tracking-wider inline-flex items-center gap-1">
                        Explore Projects <ArrowRight className="h-3.5 w-3.5" />
                      </Link>
                    </div>
                  </motion.div>
                </motion.div>
              );
            })}
          </motion.div>
        </div>
      </section>

      {/* ── 5. OUR APPROACH / HOW WE WORK ── */}
      <section className="py-28 bg-slate-900 text-white relative overflow-hidden">
        <FloatingParticles />
        <div className="absolute inset-0 bg-dot-grid opacity-20" />
        
        <div className="w-full px-6 md:px-10 max-w-6xl mx-auto relative z-10">
          <SectionHeading 
            subtitle={aboutData.process_subtitle || "Our Process"} 
            title={aboutData.process_title || "How We Work"} 
            description={aboutData.process_description || "Our systematic approach ensures every initiative reaches the right beneficiaries with maximum accountability."}
            light
          />

          <div className="grid grid-cols-1 md:grid-cols-4 gap-6 mt-12">
            {(Array.isArray(aboutData.process_steps) && aboutData.process_steps.length > 0
              ? aboutData.process_steps
              : [
                  { step: "01", title: "Needs Assessment", description: "We conduct grassroots surveys and interact directly with rural & urban communities to understand real gaps." },
                  { step: "02", title: "Program Planning", description: "We design tailored educational kits, healthcare camps, and skill workshops with actionable milestones." },
                  { step: "03", title: "Field Execution", description: "Our dedicated team and volunteers collaborate with schools, doctors, and local bodies to execute efficiently." },
                  { step: "04", title: "Impact & Growth", description: "We continuously monitor outcomes, gather beneficiary feedback, and ensure long-term community self-reliance." }
                ]
            ).map((item, index) => {
              const icons = [
                <Lightbulb className="h-6 w-6 text-amber-400" />,
                <Compass className="h-6 w-6 text-teal-400" />,
                <HandHeart className="h-6 w-6 text-cyan-400" />,
                <Shield className="h-6 w-6 text-emerald-400" />
              ];
              const icon = icons[index % icons.length];
              const stepNumber = item.step || String(index + 1).padStart(2, '0');

              return (
                <motion.div
                  key={index}
                  initial={{ opacity: 0, y: 30 }}
                  whileInView={{ opacity: 1, y: 0 }}
                  viewport={{ once: true }}
                  transition={{ duration: 0.5, delay: index * 0.1 }}
                  className="bg-slate-950/80 rounded-2xl p-7 border border-white/10 relative group hover:border-amber-400/50 transition-colors flex flex-col justify-between"
                >
                  <div>
                    <div className="flex items-center justify-between mb-6">
                      <span className="font-heading text-3xl font-bold text-amber-400/80">{stepNumber}</span>
                      <div className="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center">
                        {icon}
                      </div>
                    </div>
                    <h3 className="font-heading text-xl text-white mb-2">{item.title}</h3>
                    <p className="text-white/60 text-sm leading-relaxed">{item.description || item.desc}</p>
                  </div>
                </motion.div>
              );
            })}
          </div>

          {/* Core Quote Box */}
          <motion.div 
            initial={{ opacity: 0, scale: 0.95 }} 
            whileInView={{ opacity: 1, scale: 1 }} 
            viewport={{ once: true }} 
            transition={{ duration: 0.6 }} 
            className="mt-16 max-w-4xl mx-auto"
          >
            <div className="bg-gradient-to-r from-teal-500/10 via-amber-500/10 to-cyan-500/10 rounded-3xl p-8 md:p-10 border border-white/15 text-center backdrop-blur-md">
              <p className="text-xl md:text-2xl font-heading text-amber-300 leading-relaxed italic">
                "{aboutData.founder_message}"
              </p>
            </div>
          </motion.div>
        </div>
      </section>

      {/* ── 6. IMPACT / STATISTICS SECTION ── */}
      <section className="py-28 md:py-36 bg-gradient-dark relative overflow-hidden border-t border-b border-white/10">
        <FloatingParticles />
        <div className="absolute inset-0 bg-dot-grid opacity-30" />
        <div className="w-full px-6 md:px-10 max-w-6xl mx-auto relative z-10">
          <SectionHeading subtitle="Our Impact" title="Numbers That Reflect Our Commitment" light />
          <div className="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-12 mt-8">
            <AnimatedCounter end={stat1.num} suffix={stat1.suffix} label="People Helped" icon={<Users className="h-10 w-10 text-amber-400" />} />
            <AnimatedCounter end={stat2.num} suffix={stat2.suffix} label="Projects Done" icon={<Target className="h-10 w-10 text-teal-400" />} />
            <AnimatedCounter end={stat3.num} suffix={stat3.suffix} label="Active Volunteers" icon={<HandHeart className="h-10 w-10 text-rose-400" />} />
            <AnimatedCounter end={stat4.num} suffix={stat4.suffix} label="Communities Reached" icon={<Globe className="h-10 w-10 text-cyan-400" />} />
          </div>
        </div>
      </section>

      {/* ── 7. LEADERSHIP TEAM ── */}
      <section className="py-28 bg-warm">
        <div className="w-full px-6 md:px-10 max-w-6xl mx-auto">
          <SectionHeading 
            subtitle={aboutData.team_subtitle || "Leadership"} 
            title={aboutData.team_title || "Meet Our Team"} 
            description={aboutData.team_description || "Dedicated professionals driving positive grassroots change every day."} 
          />
          
          <motion.div 
            variants={staggerContainer} 
            initial="hidden" 
            whileInView="show" 
            viewport={{ once: true }} 
            className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6"
          >
            {(Array.isArray(aboutData.team_members) && aboutData.team_members.length > 0 ? aboutData.team_members : team).map((m, i) => {
              const gradients = [
                "from-amber-400 to-orange-500",
                "from-cyan-400 to-blue-600",
                "from-rose-400 to-pink-600",
                "from-emerald-400 to-teal-600"
              ];
              const gradient = m.gradient || gradients[i % gradients.length];
              const desc = m.desc || m.description || "";
              const initial = (m.name || "M").charAt(0).toUpperCase();

              return (
                <motion.div key={i} variants={staggerItem}>
                  <motion.div 
                    whileHover={{ y: -8 }} 
                    transition={{ type: "spring", stiffness: 300 }} 
                    className="bg-card rounded-2xl p-7 shadow-ngo text-center group hover:shadow-card-hover transition-shadow duration-500 h-full flex flex-col justify-between border border-border/40"
                  >
                    <div>
                      <div className={`w-20 h-20 rounded-full bg-gradient-to-br ${gradient} mx-auto mb-5 flex items-center justify-center text-slate-950 font-heading text-3xl font-bold shadow-lg group-hover:scale-105 transition-transform`}>
                        {initial}
                      </div>
                      <h4 className="font-heading text-xl text-foreground font-bold">{m.name}</h4>
                      <p className="text-xs font-semibold text-amber-500 uppercase tracking-wider mt-1">{m.role}</p>
                      <p className="text-muted-foreground text-xs mt-3 leading-relaxed">{desc}</p>
                    </div>
                  </motion.div>
                </motion.div>
              );
            })}
          </motion.div>
        </div>
      </section>

      {/* ── 8. CALL TO ACTION (CTA) ── */}
      <section className="py-24 md:py-32 bg-slate-950 relative overflow-hidden">
        <FloatingParticles />
        <div className="absolute inset-0 bg-dot-grid opacity-25" />
        <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none" />

        <div className="w-full px-6 md:px-10 max-w-4xl mx-auto text-center relative z-10">
          <div className="bg-slate-900/90 backdrop-blur-xl border border-white/10 rounded-3xl p-8 md:p-14 shadow-2xl">
            <SectionHeading
              subtitle="Get Involved"
              title="Be a Part of the Transformation"
              description="Partner with us, volunteer your skills, or support our grassroots programs to build stronger communities together."
              light
            />

            <motion.div 
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              className="flex flex-wrap justify-center gap-4 mt-8"
            >
              <motion.div whileHover={{ scale: 1.05 }} whileTap={{ scale: 0.95 }}>
                <Link 
                  to="/donate" 
                  className="inline-flex items-center gap-2 bg-gradient-to-r from-amber-400 to-amber-500 text-amber-950 px-9 py-4 rounded-full font-bold text-sm tracking-wide shadow-gold hover:shadow-lg transition-all"
                >
                  Donate Today <ArrowRight className="h-4 w-4" />
                </Link>
              </motion.div>

              <motion.div whileHover={{ scale: 1.05 }} whileTap={{ scale: 0.95 }}>
                <Link 
                  to="/volunteer" 
                  className="inline-flex items-center gap-2 border-2 border-white/30 text-white px-9 py-4 rounded-full font-bold text-sm tracking-wide hover:bg-white/10 transition-all backdrop-blur-sm"
                >
                  Volunteer with Us
                </Link>
              </motion.div>
            </motion.div>
          </div>
        </div>
      </section>
    </div>
  );
};

export default About;
