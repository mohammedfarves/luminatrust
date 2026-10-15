import { useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import { 
  Heart, 
  Users, 
  BookOpen, 
  Award, 
  Sparkles, 
  CheckCircle2, 
  Clock, 
  MapPin, 
  GraduationCap, 
  Stethoscope, 
  Trees, 
  Camera, 
  PackageCheck, 
  ArrowRight, 
  Send, 
  ChevronDown, 
  MessageSquare, 
  Check, 
  Star, 
  HelpCircle,
  ExternalLink,
  PhoneCall,
  Mail
} from "lucide-react";
import SectionHeading from "@/components/SectionHeading";
import HeroBackground from "@/components/HeroBackground";
import MarqueeRibbon from "@/components/MarqueeRibbon";
import AnimatedCounter from "@/components/AnimatedCounter";
import { staggerContainer, staggerItem, GlowCard } from "@/components/AnimationEffects";
import { useSiteSettings } from "@/context/SiteSettingsContext";

// ── BENEFITS DATA ──
const benefits = [
  {
    icon: <Award className="h-6 w-6" />,
    title: "Official Certification",
    badge: "Verified Credential",
    desc: "Receive authenticated certificate of appreciation, service hours record, and personalized recommendation letters for academic credit, college portfolios, or career advancement.",
    gradient: "from-amber-400 to-orange-500",
    bgLight: "bg-amber-500/10 text-amber-600 dark:text-amber-400",
  },
  {
    icon: <Heart className="h-6 w-6" />,
    title: "Tangible Grassroots Impact",
    badge: "Direct Change",
    desc: "Experience the joy of putting textbooks into eager hands, supporting free rural medical checkups, planting native groves, and directly uplifting underprivileged families.",
    gradient: "from-rose-400 to-pink-600",
    bgLight: "bg-rose-500/10 text-rose-600 dark:text-rose-400",
  },
  {
    icon: <GraduationCap className="h-6 w-6" />,
    title: "Leadership & Skill Building",
    badge: "Career Growth",
    desc: "Gain hands-on expertise in grassroots project management, public speaking, field crisis response, community mobilization, and multi-stakeholder collaboration.",
    gradient: "from-cyan-400 to-blue-600",
    bgLight: "bg-cyan-500/10 text-cyan-600 dark:text-cyan-400",
  },
  {
    icon: <Users className="h-6 w-6" />,
    title: "Vibrant Changemaker Network",
    badge: "Community",
    desc: "Connect with mission-driven doctors, environmentalists, university educators, corporate volunteers, and passionate youth dedicated to long-term social equity.",
    gradient: "from-emerald-400 to-teal-600",
    bgLight: "bg-emerald-500/10 text-emerald-600 dark:text-emerald-400",
  },
  {
    icon: <Clock className="h-6 w-6" />,
    title: "Flexible Hybrid Commitment",
    badge: "Work-Life Balance",
    desc: "Choose commitments that fit your life: high-energy weekend drives, monthly medical outreach, or remote digital contributions from the comfort of your home.",
    gradient: "from-purple-400 to-indigo-600",
    bgLight: "bg-purple-500/10 text-purple-600 dark:text-purple-400",
  },
  {
    icon: <Sparkles className="h-6 w-6" />,
    title: "Mentorship & Recognition",
    badge: "Appreciation",
    desc: "Work side-by-side with senior community mentors, receive annual volunteer recognition awards, and lead your own grassroots initiatives under Lumina's banner.",
    gradient: "from-yellow-400 to-amber-600",
    bgLight: "bg-yellow-500/10 text-yellow-600 dark:text-yellow-400",
  },
];

// ── VOLUNTEER TRACKS / ROLES ──
const volunteerTracks = [
  {
    id: "education",
    title: "Education & Student Mentorship",
    shortTitle: "Education & Mentorship",
    icon: <BookOpen className="h-6 w-6 text-amber-500" />,
    tag: "Highest Need",
    tagColor: "bg-amber-100 text-amber-800 dark:bg-amber-950/40 dark:text-amber-300",
    commitment: "2 – 4 hrs / Weekend",
    location: "Rural & Govt Schools",
    desc: "Provide academic coaching in math, science, and English, conduct career guidance workshops, and distribute free books and exam kits to students.",
    tasks: [
      "Weekend tutoring for 6th to 12th standard students",
      "Career counseling & entrance exam preparation",
      "Storytelling, arts & value education workshops",
      "Learning materials & notebook distribution drives"
    ]
  },
  {
    id: "healthcare",
    title: "Healthcare & Medical Camps",
    shortTitle: "Healthcare & Medical Camps",
    icon: <Stethoscope className="h-6 w-6 text-rose-500" />,
    tag: "Life-Saving",
    tagColor: "bg-rose-100 text-rose-800 dark:bg-rose-950/40 dark:text-rose-300",
    commitment: "Half-day / Bi-weekly Camps",
    location: "Community Centers",
    desc: "Assist qualified doctors and nurses during free medical, dental, and eye check-up camps, manage patient registrations, and distribute free medicines.",
    tasks: [
      "Patient queue management & registration coordination",
      "Assisting doctors with basic vitals & screening records",
      "Public health, hygiene & nutrition awareness campaigns",
      "Blood donation camp organizing & volunteer support"
    ]
  },
  {
    id: "environment",
    title: "Eco Drives & Sparrow Conservation",
    shortTitle: "Environment & Green Drives",
    icon: <Trees className="h-6 w-6 text-emerald-500" />,
    tag: "Eco Action",
    tagColor: "bg-emerald-100 text-emerald-800 dark:bg-emerald-950/40 dark:text-emerald-300",
    commitment: "3 hrs / Saturday Morning",
    location: "Coastlines & Parks",
    desc: "Lead native tree sapling plantations, construct and distribute wooden sparrow nest boxes, and execute coastal plastic-free cleanup campaigns.",
    tasks: [
      "Tree sapling plantations & maintenance monitoring",
      "Distribution & installation of sparrow bird feeders",
      "Coastal cleanup & plastic eradication rallies",
      "School environmental workshops & green pledges"
    ]
  },
  {
    id: "digital",
    title: "Media, Content & Digital Outreach",
    shortTitle: "Media & Digital Outreach",
    icon: <Camera className="h-6 w-6 text-cyan-500" />,
    tag: "Remote Friendly",
    tagColor: "bg-cyan-100 text-cyan-800 dark:bg-cyan-950/40 dark:text-cyan-300",
    commitment: "Flexible / 2 – 5 hrs weekly",
    location: "Work from Home / Remote",
    desc: "Amplify our grassroots impact through photography, video editing, social media stories, poster design, and beneficiary case study writing.",
    tasks: [
      "Field photography & reel/video documentation",
      "Social media post creation (Canva, Photoshop)",
      "Impact story writing & newsletter composition",
      "Web updates, data management & donor reports"
    ]
  },
  {
    id: "field",
    title: "Relief Packaging & Field Logistics",
    shortTitle: "Relief & Logistics Support",
    icon: <PackageCheck className="h-6 w-6 text-purple-500" />,
    tag: "Emergency & Drives",
    tagColor: "bg-purple-100 text-purple-800 dark:bg-purple-950/40 dark:text-purple-300",
    commitment: "Event-based as needed",
    location: "Distribution Hubs",
    desc: "Help assemble dry ration kits, clothing packages, disaster relief materials, and manage event setups for large-scale community distributions.",
    tasks: [
      "Sorting & packing dry ration and grocery parcels",
      "Disaster relief assembly & priority distribution",
      "Stage, sound & logistic setup for public welfare events",
      "Door-to-door welfare survey & elder assistance"
    ]
  }
];

// ── HOW IT WORKS STEPS ──
const steps = [
  {
    step: "01",
    title: "Connect with Our Team",
    desc: "Reach out via WhatsApp, phone, or email to express your interest in volunteering for the causes you care about.",
  },
  {
    step: "02",
    title: "Friendly Orientation",
    desc: "Our community coordinator connects with you on WhatsApp or a brief 15-minute call to align on upcoming drives.",
  },
  {
    step: "03",
    title: "Join Your First Drive",
    desc: "Step onto the field with an experienced mentor volunteer, receive your volunteer kit, and start making an impact.",
  },
  {
    step: "04",
    title: "Grow, Lead & Inspire",
    desc: "Receive official verified certification, lead your own neighborhood initiatives, and earn recognized accolades.",
  },
];

// ── TESTIMONIALS ──
const testimonials = [
  {
    name: "Karthik Rajagopalan",
    role: "Software Engineer & Weekend Educator",
    quote: "Spending Saturday mornings teaching mathematics to bright rural kids transformed my perspective. Lumina's ground team is transparent, organized, and truly puts children first.",
    avatar: "https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80",
    rating: 5,
    tag: "2 Years Volunteer"
  },
  {
    name: "Dr. Priyadharshini M.",
    role: "Resident Doctor & Medical Camp Lead",
    quote: "The free health checkup camps organized by Lumina Trust reach families who genuinely lack access to basic clinics. Volunteering here is medical service in its purest, most noble form.",
    avatar: "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=150&q=80",
    rating: 5,
    tag: "Medical Camps"
  },
  {
    name: "Aakash Subramanian",
    role: "College Student (NSS Volunteer)",
    quote: "I joined for the Sparrow Conservation and Tree Plantation drive. The camaraderie of the team is contagious, and the official internship certificate helped me immensely with university credits!",
    avatar: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&q=80",
    rating: 5,
    tag: "Eco Warrior"
  }
];

// ── FAQS ──
const faqs = [
  {
    q: "Do I need any previous volunteering experience?",
    a: "Not at all! Passion, empathy, and willingness to learn are all that is required. For every program (whether teaching, medical support, or eco drives), you will be paired with an experienced lead volunteer who guides you step-by-step."
  },
  {
    q: "Will I receive an official certificate of volunteering?",
    a: "Yes! Every volunteer receives a verified Certificate of Appreciation from Lumina Trust detailing the completed hours and specific initiatives supported. We also provide official recommendation letters and internship verification for college students."
  },
  {
    q: "Can I volunteer if I work a demanding full-time job?",
    a: "Absolutely. More than 60% of our active volunteers are working professionals and college students. Most of our community drives take place on Saturday or Sunday mornings (typically 2 to 3 hours). We also have remote digital roles in design, writing, and outreach."
  },
  {
    q: "What is the minimum age to volunteer?",
    a: "Individuals aged 15 and above are warmly welcome to participate. High school students under 18 simply require a basic parental approval letter."
  },
  {
    q: "Can college students complete mandatory social internships here?",
    a: "Yes! We regularly partner with colleges, universities, NSS, and NCC units to fulfill mandatory 30-hour or 60-hour social community service and CSR internship requirements."
  }
];

const Volunteer = () => {
  const settings = useSiteSettings();
  const [openFaq, setOpenFaq] = useState(null);

  const toggleFaq = (index) => {
    setOpenFaq(openFaq === index ? null : index);
  };

  const cleanPhone = (settings?.whatsapp_number || settings?.phone || "+919894777349").replace(/[^0-9]/g, "");

  return (
    <div className="overflow-hidden bg-background text-foreground transition-colors">
      
      {/* ── 1. HERO SECTION ── */}
      <section className="relative pt-32 pb-20 sm:pt-40 sm:pb-28 md:py-48 overflow-hidden bg-slate-950 text-white">
        <HeroBackground />
        
        {/* Ambient Glows */}
        <div className="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-amber-500/15 rounded-full blur-[130px] pointer-events-none" />
        <div className="absolute bottom-10 right-10 w-[350px] h-[350px] bg-emerald-500/10 rounded-full blur-[100px] pointer-events-none" />

        <div className="site-container text-center relative z-10">
          <motion.div 
            initial={{ opacity: 0, y: 30 }} 
            animate={{ opacity: 1, y: 0 }} 
            transition={{ duration: 0.7 }}
          >
            {/* Pill Badge */}
            <span className="inline-flex items-center gap-2 bg-gradient-to-r from-amber-400/20 to-emerald-400/20 border border-amber-400/30 rounded-full px-4 sm:px-6 py-2 text-amber-300 font-extrabold text-xs sm:text-sm uppercase tracking-[0.2em] mb-4 sm:mb-6 backdrop-blur-md shadow-lg">
              <Sparkles className="w-4 h-4 text-amber-400 animate-pulse" />
              Join 500+ Grassroots Changemakers
            </span>

            {/* Main Title */}
            <h1 className="font-heading text-3xl sm:text-5xl md:text-6xl lg:text-7xl text-white mt-2 sm:mt-4 leading-[1.1] max-w-4xl mx-auto">
              Empower Communities, <br className="hidden sm:inline" />
              Elevate Lives – <span className="bg-gradient-to-r from-amber-300 via-amber-400 to-yellow-500 bg-clip-text text-transparent">Be The Spark</span>
            </h1>

            {/* Subtitle */}
            <p className="text-white/75 mt-5 sm:mt-7 max-w-2xl mx-auto text-sm sm:text-base md:text-lg leading-relaxed font-light">
              Your dedication, energy, and empathy can change the trajectory of underserved children, vulnerable families, and fragile local ecosystems. Join Lumina Trust today.
            </p>

            {/* CTA Buttons */}
            <div className="mt-8 sm:mt-10 flex flex-wrap items-center justify-center gap-4">
              <a
                href="#get-involved"
                className="px-7 sm:px-9 py-3.5 sm:py-4 rounded-full bg-gradient-to-r from-amber-400 to-amber-500 text-slate-950 font-black text-sm sm:text-base shadow-xl shadow-amber-400/20 hover:shadow-amber-400/30 flex items-center gap-2.5 transition-all hover:scale-105"
              >
                <span>Get Involved</span>
                <ArrowRight className="w-4 h-4" />
              </a>

              <a
                href="#volunteer-tracks"
                className="px-6 sm:px-8 py-3.5 sm:py-4 rounded-full bg-white/10 hover:bg-white/15 border border-white/20 text-white font-bold text-sm sm:text-base backdrop-blur-md transition-all flex items-center gap-2"
              >
                <span>Explore Tracks</span>
                <ChevronDown className="w-4 h-4 text-amber-400" />
              </a>
            </div>

            {/* Live Impact Counters Ribbon */}
            <div className="mt-14 sm:mt-20 pt-8 sm:pt-10 border-t border-white/10 grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8 max-w-4xl mx-auto">
              <AnimatedCounter end={500} suffix="+" label="Active Volunteers" icon={<Users className="w-5 h-5 text-amber-400" />} />
              <AnimatedCounter end={10000} suffix="+" label="Students Mentored" icon={<BookOpen className="w-5 h-5 text-emerald-400" />} />
              <AnimatedCounter end={150} suffix="+" label="Events & Drives" icon={<Award className="w-5 h-5 text-cyan-400" />} />
              <AnimatedCounter end={100} suffix="%" label="Grassroots Dedicated" icon={<Heart className="w-5 h-5 text-rose-400" />} />
            </div>
          </motion.div>
        </div>
      </section>

      {/* ── 2. LIVE MARQUEE IMPACT BANNER ── */}
      <MarqueeRibbon />

      {/* ── 3. WHY VOLUNTEER (6 INTERACTIVE BENEFIT CARDS) ── */}
      <section className="py-16 sm:py-24 md:py-32 bg-slate-50/50 dark:bg-slate-900/30 border-b border-border/40">
        <div className="site-container">
          <SectionHeading 
            subtitle="Why Join Us" 
            title="Benefits of Volunteering with Lumina Trust" 
            description="We respect your time and generosity. Here is how volunteering with Lumina Trust will enrich your personal and professional journey."
          />

          <motion.div 
            variants={staggerContainer} 
            initial="hidden" 
            whileInView="show" 
            viewport={{ once: true, margin: "-50px" }} 
            className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8"
          >
            {benefits.map((b, i) => (
              <motion.div key={i} variants={staggerItem}>
                <GlowCard className="h-full">
                  <div className="bg-card rounded-3xl p-6 sm:p-8 border border-border/60 shadow-sm hover:shadow-xl transition-all duration-300 h-full flex flex-col justify-between group">
                    <div>
                      <div className="flex items-center justify-between mb-5">
                        <div className={`inline-flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-gradient-to-br ${b.gradient} text-white shadow-md shadow-amber-500/10 group-hover:scale-110 transition-transform`}>
                          {b.icon}
                        </div>
                        <span className={`text-[11px] font-bold px-3 py-1 rounded-full ${b.bgLight}`}>
                          {b.badge}
                        </span>
                      </div>

                      <h3 className="font-heading text-lg sm:text-xl text-foreground font-bold mb-2.5 group-hover:text-amber-500 transition-colors">
                        {b.title}
                      </h3>
                      <p className="text-xs sm:text-sm text-muted-foreground leading-relaxed">
                        {b.desc}
                      </p>
                    </div>

                    <div className="pt-5 mt-5 border-t border-border/50 flex items-center text-xs font-bold text-amber-500 gap-1.5 opacity-80 group-hover:opacity-100 transition-opacity">
                      <span>Certified Experience</span>
                      <Check className="w-3.5 h-3.5" />
                    </div>
                  </div>
                </GlowCard>
              </motion.div>
            ))}
          </motion.div>
        </div>
      </section>

      {/* ── 4. CHOOSE YOUR VOLUNTEER TRACK (5 INTERACTIVE ROLE CARDS) ── */}
      <section id="volunteer-tracks" className="py-16 sm:py-24 md:py-32">
        <div className="site-container">
          <SectionHeading 
            subtitle="Volunteer Opportunities" 
            title="Choose Your Field of Impact" 
            description="Find the domain that matches your skills, passion, and availability. Connect directly with our team to join upcoming field initiatives."
          />

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            {volunteerTracks.map((track, i) => (
              <motion.div
                key={track.id}
                initial={{ opacity: 0, y: 30 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ duration: 0.5, delay: i * 0.08 }}
                className="flex flex-col justify-between bg-card rounded-3xl p-6 sm:p-7 border border-border/80 shadow-sm hover:shadow-xl hover:border-amber-400/60 transition-all duration-300 relative group"
              >
                <div>
                  {/* Header */}
                  <div className="flex items-center justify-between mb-4">
                    <div className="w-12 h-12 rounded-2xl bg-amber-400/10 border border-amber-400/20 flex items-center justify-center shrink-0">
                      {track.icon}
                    </div>
                    <span className={`text-[10px] sm:text-xs font-extrabold uppercase px-2.5 py-1 rounded-full ${track.tagColor}`}>
                      {track.tag}
                    </span>
                  </div>

                  <h3 className="font-heading text-lg sm:text-xl font-bold text-foreground mb-2">
                    {track.title}
                  </h3>

                  <p className="text-xs sm:text-sm text-muted-foreground leading-relaxed mb-4">
                    {track.desc}
                  </p>

                  {/* Commitment & Location Chips */}
                  <div className="space-y-2 mb-5">
                    <div className="flex items-center gap-2 text-xs font-semibold text-slate-700 dark:text-slate-300 bg-muted/50 px-3 py-1.5 rounded-xl">
                      <Clock className="w-3.5 h-3.5 text-amber-500 shrink-0" />
                      <span>{track.commitment}</span>
                    </div>
                    <div className="flex items-center gap-2 text-xs font-semibold text-slate-700 dark:text-slate-300 bg-muted/50 px-3 py-1.5 rounded-xl">
                      <MapPin className="w-3.5 h-3.5 text-emerald-500 shrink-0" />
                      <span>{track.location}</span>
                    </div>
                  </div>

                  {/* Key Tasks List */}
                  <div className="space-y-2 pt-2 border-t border-border/50">
                    <span className="text-[11px] font-extrabold uppercase tracking-wider text-muted-foreground block mb-1">
                      Key Activities:
                    </span>
                    {track.tasks.map((task, tIdx) => (
                      <div key={tIdx} className="flex items-start gap-2 text-xs text-foreground/90">
                        <CheckCircle2 className="w-3.5 h-3.5 text-amber-500 shrink-0 mt-0.5" />
                        <span>{task}</span>
                      </div>
                    ))}
                  </div>
                </div>

                {/* Direct Action Link to WhatsApp */}
                <div className="pt-6 mt-6 border-t border-border/60">
                  <a
                    href={`https://wa.me/${cleanPhone}?text=${encodeURIComponent(`Hi Lumina Trust, I am interested in volunteering for "${track.title}". How can I get started?`)}`}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="w-full py-2.5 px-4 rounded-xl text-xs font-bold flex items-center justify-center gap-2 bg-muted hover:bg-amber-400 hover:text-slate-950 text-foreground transition-all group-hover:bg-amber-400 group-hover:text-slate-950 shadow-sm"
                  >
                    <span>Volunteer for this Track</span>
                    <ArrowRight className="w-3.5 h-3.5" />
                  </a>
                </div>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* ── 5. HOW IT WORKS JOURNEY (4-STEP TIMELINE) ── */}
      <section className="py-16 sm:py-24 md:py-32 bg-slate-900 text-white relative overflow-hidden">
        <div className="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(245,158,11,0.08),transparent_50%)]" />

        <div className="site-container relative z-10">
          <SectionHeading 
            subtitle="Simple Onboarding" 
            title="Your Journey as a Lumina Volunteer" 
            description="We ensure every volunteer has a seamless, fulfilling, and supportive transition from connecting with us to leading projects."
            light={true}
          />

          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 mt-10">
            {steps.map((st, i) => (
              <motion.div
                key={i}
                initial={{ opacity: 0, y: 25 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ duration: 0.5, delay: i * 0.12 }}
                className="bg-white/5 border border-white/10 rounded-3xl p-6 sm:p-7 backdrop-blur-sm hover:bg-white/10 hover:border-amber-400/40 transition-all duration-300 relative group"
              >
                <div className="flex items-center justify-between mb-4">
                  <span className="text-3xl sm:text-4xl font-heading font-black text-amber-400/80 group-hover:text-amber-400 transition-colors">
                    {st.step}
                  </span>
                  <div className="w-8 h-8 rounded-full bg-amber-400/10 flex items-center justify-center text-amber-400 text-xs font-bold">
                    ✓
                  </div>
                </div>

                <h3 className="font-heading text-lg font-bold text-white mb-2">
                  {st.title}
                </h3>
                <p className="text-xs sm:text-sm text-white/70 leading-relaxed font-light">
                  {st.desc}
                </p>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* ── 6. VOLUNTEER STORIES / TESTIMONIALS ── */}
      <section className="py-16 sm:py-24 md:py-32 bg-slate-50/50 dark:bg-slate-900/30">
        <div className="site-container">
          <SectionHeading 
            subtitle="Real Experiences" 
            title="Voices from the Grassroots" 
            description="Hear firsthand how our fellow volunteers found connection, joy, and purpose by dedicating a few hours with Lumina Trust."
          />

          <div className="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
            {testimonials.map((t, i) => (
              <motion.div
                key={i}
                initial={{ opacity: 0, y: 25 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ duration: 0.5, delay: i * 0.1 }}
                className="bg-card rounded-3xl p-6 sm:p-7 border border-border shadow-sm hover:shadow-lg transition-all flex flex-col justify-between"
              >
                <div>
                  {/* Star Rating */}
                  <div className="flex items-center gap-1 text-amber-400 mb-4">
                    {Array.from({ length: t.rating }).map((_, rIdx) => (
                      <Star key={rIdx} className="w-4 h-4 fill-amber-400" />
                    ))}
                    <span className="ml-2 text-[10px] font-extrabold uppercase px-2 py-0.5 rounded-full bg-amber-400/10 text-amber-600 dark:text-amber-400">
                      {t.tag}
                    </span>
                  </div>

                  <p className="text-xs sm:text-sm text-foreground/85 leading-relaxed italic mb-6">
                    "{t.quote}"
                  </p>
                </div>

                <div className="flex items-center gap-3 pt-4 border-t border-border/60">
                  <img
                    src={t.avatar}
                    alt={t.name}
                    className="w-11 h-11 rounded-full object-cover border-2 border-amber-400/50"
                  />
                  <div>
                    <h4 className="font-heading font-bold text-sm text-foreground">{t.name}</h4>
                    <p className="text-[11px] text-muted-foreground">{t.role}</p>
                  </div>
                </div>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* ── 7. GET INVOLVED & DIRECT CONNECT SECTION (NO FORM) ── */}
      <section id="get-involved" className="py-16 sm:py-24 md:py-32 scroll-mt-24">
        <div className="site-container-narrow">
          
          <div className="bg-gradient-to-br from-slate-900 via-slate-900 to-slate-950 text-white rounded-3xl border border-white/10 shadow-2xl p-8 sm:p-12 md:p-16 relative overflow-hidden text-center">
            {/* Ambient Accent Lights */}
            <div className="absolute top-0 right-0 w-80 h-80 bg-amber-400/10 rounded-full blur-3xl pointer-events-none" />
            <div className="absolute bottom-0 left-0 w-80 h-80 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none" />

            <div className="max-w-3xl mx-auto relative z-10">
              <span className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-400/20 text-amber-300 font-extrabold text-xs uppercase tracking-widest mb-4 border border-amber-400/30">
                <Heart className="w-3.5 h-3.5 fill-amber-400" />
                Join the Movement
              </span>

              <h2 className="font-heading text-2xl sm:text-4xl md:text-5xl font-black text-white leading-tight">
                Ready to Make a Direct Grassroots Impact?
              </h2>

              <p className="text-white/70 text-xs sm:text-base md:text-lg mt-4 max-w-2xl mx-auto leading-relaxed font-light">
                Whether you want to mentor students, support medical camps, plant trees, or help digitally from home—connecting with our volunteer coordinator takes just a quick message or call.
              </p>

              {/* 3 Direct Quick Action Cards */}
              <div className="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mt-10 text-left">
                
                {/* Card 1: WhatsApp */}
                <a
                  href={`https://wa.me/${cleanPhone}?text=${encodeURIComponent("Hi Lumina Trust team! I would like to join as a volunteer. Please share details on upcoming drives.")}`}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="p-6 rounded-2xl bg-white/5 border border-white/10 hover:border-emerald-400/50 hover:bg-emerald-500/10 transition-all duration-300 group flex flex-col justify-between"
                >
                  <div>
                    <div className="w-12 h-12 rounded-xl bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center text-emerald-400 mb-4 group-hover:scale-110 transition-transform">
                      <MessageSquare className="w-6 h-6" />
                    </div>
                    <h4 className="font-heading font-bold text-base text-white mb-1">WhatsApp Chat</h4>
                    <p className="text-xs text-white/60">Fastest response. Connect with our community lead instantly.</p>
                  </div>
                  <div className="mt-5 text-xs font-bold text-emerald-400 flex items-center gap-1.5">
                    <span>Chat on WhatsApp</span>
                    <ExternalLink className="w-3.5 h-3.5" />
                  </div>
                </a>

                {/* Card 2: Phone Call */}
                <a
                  href={`tel:${settings?.phone || "+919894777349"}`}
                  className="p-6 rounded-2xl bg-white/5 border border-white/10 hover:border-amber-400/50 hover:bg-amber-500/10 transition-all duration-300 group flex flex-col justify-between"
                >
                  <div>
                    <div className="w-12 h-12 rounded-xl bg-amber-500/20 border border-amber-500/30 flex items-center justify-center text-amber-400 mb-4 group-hover:scale-110 transition-transform">
                      <PhoneCall className="w-6 h-6" />
                    </div>
                    <h4 className="font-heading font-bold text-base text-white mb-1">Direct Call</h4>
                    <p className="text-xs text-white/60">Speak directly with our trust office ({settings?.working_hours || "Mon - Sat: 9 AM - 6 PM"}).</p>
                  </div>
                  <div className="mt-5 text-xs font-bold text-amber-400 flex items-center gap-1.5">
                    <span>{settings?.phone || "+91 98947 77349"}</span>
                    <ArrowRight className="w-3.5 h-3.5" />
                  </div>
                </a>

                {/* Card 3: Email */}
                <a
                  href={`mailto:${settings?.email || "support@luminatrust.org"}?subject=${encodeURIComponent("Volunteering Inquiry - Lumina Trust")}`}
                  className="p-6 rounded-2xl bg-white/5 border border-white/10 hover:border-cyan-400/50 hover:bg-cyan-500/10 transition-all duration-300 group flex flex-col justify-between"
                >
                  <div>
                    <div className="w-12 h-12 rounded-xl bg-cyan-500/20 border border-cyan-500/30 flex items-center justify-center text-cyan-400 mb-4 group-hover:scale-110 transition-transform">
                      <Mail className="w-6 h-6" />
                    </div>
                    <h4 className="font-heading font-bold text-base text-white mb-1">Email Coordinator</h4>
                    <p className="text-xs text-white/60">For college NSS, CSR partnerships & official service verification.</p>
                  </div>
                  <div className="mt-5 text-xs font-bold text-cyan-400 flex items-center gap-1.5">
                    <span>{settings?.email || "support@luminatrust.org"}</span>
                    <ArrowRight className="w-3.5 h-3.5" />
                  </div>
                </a>

              </div>

            </div>

          </div>

        </div>
      </section>

      {/* ── 8. FAQS SECTION (ANIMATED ACCORDION) ── */}
      <section className="py-16 sm:py-24 md:py-28 bg-slate-50/50 dark:bg-slate-900/30 border-t border-border/40">
        <div className="w-full px-4 sm:px-6 md:px-10 max-w-4xl mx-auto">
          <SectionHeading 
            subtitle="Common Queries" 
            title="Frequently Asked Questions" 
            description="Everything you need to know about joining our grassroots volunteering community."
          />

          <div className="space-y-4">
            {faqs.map((faq, idx) => {
              const isOpen = openFaq === idx;
              return (
                <div
                  key={idx}
                  className="bg-card rounded-2xl border border-border shadow-sm overflow-hidden transition-all"
                >
                  <button
                    type="button"
                    onClick={() => toggleFaq(idx)}
                    className="w-full p-5 sm:p-6 text-left flex items-center justify-between gap-4 focus:outline-none"
                  >
                    <span className="font-heading font-bold text-sm sm:text-base text-foreground flex items-center gap-3">
                      <HelpCircle className="w-4 h-4 text-amber-500 shrink-0" />
                      {faq.q}
                    </span>
                    <motion.div
                      animate={{ rotate: isOpen ? 180 : 0 }}
                      transition={{ duration: 0.2 }}
                      className="shrink-0 text-muted-foreground"
                    >
                      <ChevronDown className="w-5 h-5" />
                    </motion.div>
                  </button>

                  <AnimatePresence>
                    {isOpen && (
                      <motion.div
                        initial={{ height: 0, opacity: 0 }}
                        animate={{ height: "auto", opacity: 1 }}
                        exit={{ height: 0, opacity: 0 }}
                        transition={{ duration: 0.25 }}
                        className="overflow-hidden"
                      >
                        <div className="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-muted-foreground leading-relaxed border-t border-border/40 pt-4">
                          {faq.a}
                        </div>
                      </motion.div>
                    )}
                  </AnimatePresence>
                </div>
              );
            })}
          </div>

          {/* Quick Contact Banner */}
          <div className="mt-12 p-6 rounded-2xl bg-gradient-to-r from-amber-400/10 via-emerald-400/10 to-cyan-400/10 border border-amber-400/20 text-center flex flex-col sm:flex-row items-center justify-between gap-4">
            <div className="text-center sm:text-left">
              <h4 className="font-bold text-sm text-foreground">Need help or want to partner as an institution?</h4>
              <p className="text-xs text-muted-foreground">Call us directly during office hours ({settings?.working_hours || "Mon - Sat: 9 AM - 6 PM"})</p>
            </div>
            <a
              href={`tel:${settings?.phone || "+919894777349"}`}
              className="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-foreground text-background font-bold text-xs hover:opacity-90 transition-all shadow-sm"
            >
              <PhoneCall className="w-3.5 h-3.5" />
              <span>{settings?.phone || "+91 98947 77349"}</span>
            </a>
          </div>

        </div>
      </section>

    </div>
  );
};

export default Volunteer;

