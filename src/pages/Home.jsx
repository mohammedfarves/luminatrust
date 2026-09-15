import { Link } from "react-router-dom";
import { motion, useScroll, useTransform } from "framer-motion";
import { Users, HandHeart, Target, ArrowRight, Send, ChevronDown, Sparkles, TrendingUp, BookOpen, Mail } from "lucide-react";
import heroBg from "@/assets/hero-bg.jpg";
import bookDistributionImg from "@/assets/activits/Book given to students/b2.png";
import beachCleanImg from "@/assets/activits/nagore beach clean/WhatsApp Image 2026-09-01 at 1.55.01 PM.jpeg";
import doctorsDayImg from "@/assets/activits/DOCTERS ADY/WhatsApp Image 2026-09-01 at 2.01.14 PM.jpeg";
import treePlantationImg from "@/assets/activits/tree plantaion/t1.png";
import AnimatedCounter from "@/components/AnimatedCounter";
import SectionHeading from "@/components/SectionHeading";
import ProjectCard from "@/components/ProjectCard";
import Testimonial from "@/components/Testimonial";
import { FloatingParticles, staggerContainer, staggerItem } from "@/components/AnimationEffects";
import { useState, useRef } from "react";
import { toast } from "sonner";

const Home = () => {
  const [email, setEmail] = useState("");
  const [isSubmitting, setIsSubmitting] = useState(false);
  const heroRef = useRef(null);
  const { scrollYProgress } = useScroll({ target: heroRef, offset: ["start start", "end start"] });
  const heroY = useTransform(scrollYProgress, [0, 1], [0, 200]);
  const heroOpacity = useTransform(scrollYProgress, [0, 0.8], [1, 0]);
  const heroScale = useTransform(scrollYProgress, [0, 1], [1, 1.08]);

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
        toast.success("Thank you for subscribing!");
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
    <div className="overflow-hidden">
      {/* ── HERO ── */}
      <section ref={heroRef} className="relative min-h-screen flex items-center justify-center">
        <motion.div className="absolute inset-0 overflow-hidden" style={{ scale: heroScale }}>
          <div className="absolute inset-0 grid grid-cols-4 md:grid-cols-6 gap-1 opacity-50">
            {[heroBg, bookDistributionImg, beachCleanImg, doctorsDayImg, treePlantationImg, heroBg,
              doctorsDayImg, beachCleanImg, bookDistributionImg, treePlantationImg, heroBg, doctorsDayImg,
              treePlantationImg, heroBg, beachCleanImg, bookDistributionImg, doctorsDayImg, beachCleanImg,
              heroBg, bookDistributionImg, treePlantationImg, doctorsDayImg, beachCleanImg, heroBg
            ].map((img, i) => (
              <div key={i} className="aspect-square overflow-hidden">
                <img src={img} alt="" className="w-full h-full object-cover" loading="lazy" />
              </div>
            ))}
          </div>
          <div className="absolute inset-0 bg-gradient-hero" />
          {/* Amber bottom glow */}
          <div className="absolute bottom-0 left-0 right-0 h-48 bg-gradient-to-t from-amber-950/30 to-transparent" />
        </motion.div>
        <FloatingParticles />

        <motion.div style={{ opacity: heroOpacity, y: heroY }} className="relative z-10 text-center px-6 max-w-5xl pt-20">
          {/* Trust badge */}
          <motion.div
            initial={{ opacity: 0, scale: 0.8 }}
            animate={{ opacity: 1, scale: 1 }}
            transition={{ duration: 0.5, delay: 0.1 }}
            className="inline-flex items-center gap-2 glass rounded-full px-5 py-2 mb-8"
          >
            <Sparkles className="h-3.5 w-3.5 text-amber-400" />
            <span className="text-white/80 text-xs font-semibold tracking-widest uppercase">Lumina Trust</span>
          </motion.div>

          <motion.h1
            initial={{ opacity: 0, y: 50 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8, delay: 0.2 }}
            className="font-heading text-4xl md:text-5xl lg:text-6xl xl:text-7xl text-white leading-[1.1]"
          >
            Empowering <span className="text-amber-400">Communities</span>
            <br />
            for a <span className="text-amber-400">Better Future</span>
          </motion.h1>

          <motion.p
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6, delay: 0.6 }}
            className="text-white/65 text-base md:text-lg mt-7 max-w-2xl mx-auto leading-relaxed"
          >
            Lumina Trust is a community-focused organization dedicated to uplifting underserved populations through sustainable and inclusive development initiatives.
          </motion.p>

          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6, delay: 0.9 }}
            className="flex flex-wrap justify-center gap-4 mt-10"
          >
            <motion.div whileHover={{ scale: 1.05 }} whileTap={{ scale: 0.95 }}>
              <Link to="/donate" className="inline-flex items-center gap-2 bg-gradient-to-r from-amber-400 to-amber-500 text-amber-950 px-10 py-4 rounded-full font-bold text-sm tracking-wide shadow-gold hover:shadow-lg transition-all">
                Donate Today <ArrowRight className="h-4 w-4" />
              </Link>
            </motion.div>
            <motion.div whileHover={{ scale: 1.05 }} whileTap={{ scale: 0.95 }}>
              <Link to="/volunteer" className="inline-flex items-center gap-2 border-2 border-white/30 text-white px-10 py-4 rounded-full font-bold text-sm tracking-wide hover:bg-white/10 transition-all backdrop-blur-sm">
                Volunteer with Us
              </Link>
            </motion.div>
          </motion.div>
        </motion.div>

        <motion.div
          initial={{ opacity: 0 }} animate={{ opacity: 1 }} transition={{ delay: 2 }}
          className="absolute bottom-10 left-1/2 -translate-x-1/2 z-10"
        >
          <motion.div animate={{ y: [0, 10, 0] }} transition={{ duration: 1.5, repeat: Infinity }} className="text-white/30">
            <ChevronDown className="h-6 w-6" />
          </motion.div>
        </motion.div>
      </section>

      {/* ── ABOUT STRIP ── */}
      <section className="py-28 md:py-36">
        <div className="w-full px-6 md:px-10 max-w-6xl mx-auto">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <motion.div initial={{ opacity: 0, x: -40 }} whileInView={{ opacity: 1, x: 0 }} viewport={{ once: true }} transition={{ duration: 0.7 }}>
              <SectionHeading subtitle="Who We Are" title="Uplifting Underserved Populations" align="left" />
              <p className="text-muted-foreground leading-relaxed text-lg mb-6">
                Lumina Trust is a community-focused organization dedicated to uplifting underserved populations through sustainable and inclusive development initiatives. We work at the grassroots level to create meaningful change by enabling individuals and communities to achieve dignity, independence, and long-term growth.
              </p>
              
              <h3 className="font-heading text-2xl text-foreground mb-2 mt-4">Our Vision</h3>
              <p className="text-muted-foreground leading-relaxed text-lg mb-6">
                Empowered communities living with dignity, equality, and opportunity.
              </p>

              <h3 className="font-heading text-2xl text-foreground mb-2 mt-4">Our Mission</h3>
              <p className="text-muted-foreground leading-relaxed text-lg mb-6">
                To transform lives by providing access to education, skill development, health awareness, and sustainable livelihood opportunities.
              </p>

              <h3 className="font-heading text-2xl text-foreground mb-2 mt-4">Our Core Values</h3>
              <ul className="text-muted-foreground leading-relaxed text-lg list-disc list-inside space-y-1">
                <li><span className="font-semibold">Integrity</span> – We act with honesty and accountability</li>
                <li><span className="font-semibold">Inclusiveness</span> – We ensure equal opportunities for all</li>
                <li><span className="font-semibold">Compassion</span> – We serve with empathy and care</li>
                <li><span className="font-semibold">Empowerment</span> – We enable self-reliance and growth</li>
                <li><span className="font-semibold">Sustainability</span> – We focus on long-term impact</li>
                <li><span className="font-semibold">Collaboration</span> – We believe in partnerships for change</li>
              </ul>

              <motion.div whileHover={{ scale: 1.05 }} className="mt-8">
                <Link to="/about" className="inline-flex items-center gap-2 text-sm font-bold text-amber-500 hover:text-amber-600 transition-colors uppercase tracking-wider">
                  Learn More <ArrowRight className="h-4 w-4" />
                </Link>
              </motion.div>
            </motion.div>
            <motion.div initial={{ opacity: 0, x: 40 }} whileInView={{ opacity: 1, x: 0 }} viewport={{ once: true }} transition={{ duration: 0.7 }} className="relative">
              <div className="absolute -inset-6 bg-gradient-to-br from-amber-400/10 to-cyan-400/10 rounded-3xl blur-2xl" />
              <img src={heroBg} alt="Our work" className="rounded-3xl w-full relative z-10 shadow-ngo" loading="lazy" />
              {/* Floating card on image */}
              <motion.div
                initial={{ opacity: 0, y: 20 }} whileInView={{ opacity: 1, y: 0 }} viewport={{ once: true }} transition={{ delay: 0.4 }}
                className="absolute -bottom-6 -left-6 glass-dark rounded-2xl px-5 py-4 z-20 border border-white/10"
              >
                <div className="flex items-center gap-3">
                  <div className="w-10 h-10 rounded-full bg-amber-400/20 flex items-center justify-center">
                    <TrendingUp className="h-5 w-5 text-amber-400" />
                  </div>
                  <div>
                    <p className="text-white text-sm font-bold">150+ Projects</p>
                    <p className="text-white/50 text-xs">Successfully Completed</p>
                  </div>
                </div>
              </motion.div>
            </motion.div>
          </div>
        </div>
      </section>

      {/* ── ACTIVITIES ── */}
      <section className="py-28 bg-gradient-to-b from-slate-50 via-warm to-background dark:from-slate-950 dark:via-background dark:to-slate-950">
        <div className="w-full px-6 md:px-10 max-w-7xl mx-auto">
          <SectionHeading
            subtitle="What We Do"
            title="Our Activities"
            description="Committed to serving humanity through charitable activities designed to make a positive impact."
          />

          <motion.div
            variants={staggerContainer}
            initial="hidden"
            whileInView="show"
            viewport={{ once: true }}
            className="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12"
          >
            {[
              {
                icon: <BookOpen className="h-6 w-6 text-amber-500" />,
                tag: "Education Pillar",
                title: "Education & Student Training",
                desc: "Providing free books, competitive exam training, and skill-building workshops for government school students across Tamil Nadu.",
                image: bookDistributionImg,
                accentColor: "border-amber-500/25 hover:border-amber-500/50",
                badgeBg: "bg-amber-500/10 text-amber-700 dark:text-amber-300 border border-amber-500/20",
                link: "/projects"
              },
              {
                icon: <Target className="h-6 w-6 text-cyan-500" />,
                tag: "Livelihood & Skill",
                title: "Livelihood & Career Support",
                desc: "Empowering youth and women with career guidance, vocational skills, and entrepreneurship opportunities for sustainable income.",
                image: beachCleanImg,
                accentColor: "border-cyan-500/25 hover:border-cyan-500/50",
                badgeBg: "bg-cyan-500/10 text-cyan-700 dark:text-cyan-300 border border-cyan-500/20",
                link: "/projects"
              },
              {
                icon: <HandHeart className="h-6 w-6 text-emerald-500" />,
                tag: "Health Care",
                title: "Health Camps & Hero Recognition",
                desc: "Organizing free community medical camps, health awareness drives, and honoring dedicated doctors and healthcare professionals.",
                image: doctorsDayImg,
                accentColor: "border-emerald-500/25 hover:border-emerald-500/50",
                badgeBg: "bg-emerald-500/10 text-emerald-700 dark:text-emerald-300 border border-emerald-500/20",
                link: "/projects"
              },
              {
                icon: <Users className="h-6 w-6 text-rose-500" />,
                tag: "Environment & Community",
                title: "Environmental & Community Drives",
                desc: "Leading plastic-free campaigns, beach cleanups, sparrow conservation, and tree plantation drives to protect local ecosystems.",
                image: treePlantationImg,
                accentColor: "border-rose-500/25 hover:border-rose-500/50",
                badgeBg: "bg-rose-500/10 text-rose-700 dark:text-rose-300 border border-rose-500/20",
                link: "/projects"
              },
            ].map((item, i) => (
              <motion.div key={i} variants={staggerItem}>
                <motion.div
                  whileHover={{ y: -6 }}
                  transition={{ type: "spring", stiffness: 250 }}
                  className={`group relative bg-card/90 backdrop-blur-md rounded-3xl overflow-hidden border ${item.accentColor} shadow-ngo hover:shadow-2xl transition-all duration-500 flex flex-col sm:flex-row h-full`}
                >
                  {/* Image Side */}
                  <div className="sm:w-2/5 relative h-52 sm:h-auto overflow-hidden shrink-0">
                    <img
                      src={item.image}
                      alt={item.title}
                      className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    />
                    <div className="absolute inset-0 bg-gradient-to-t sm:bg-gradient-to-r from-black/60 via-black/20 to-transparent" />
                    <span className={`absolute top-4 left-4 inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider backdrop-blur-md ${item.badgeBg}`}>
                      {item.tag}
                    </span>
                  </div>

                  {/* Content Side */}
                  <div className="sm:w-3/5 p-6 sm:p-7 flex flex-col justify-between flex-1">
                    <div>
                      <div className="w-11 h-11 rounded-2xl bg-muted/80 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform shadow-sm">
                        {item.icon}
                      </div>
                      <h3 className="font-heading text-xl font-bold text-foreground mb-2 leading-tight group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                        {item.title}
                      </h3>
                      <p className="text-muted-foreground leading-relaxed text-sm">
                        {item.desc}
                      </p>
                    </div>

                    <div className="mt-6 pt-4 border-t border-border/50 flex items-center justify-between">
                      <Link
                        to={item.link}
                        className="inline-flex items-center gap-2 text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 transition-colors uppercase tracking-wider group/link"
                      >
                        <span>Explore Initiative</span>
                        <ArrowRight className="h-3.5 w-3.5 transition-transform group-hover/link:translate-x-1" />
                      </Link>
                    </div>
                  </div>
                </motion.div>
              </motion.div>
            ))}
          </motion.div>
        </div>
      </section>

      {/* ── IMPACT COUNTERS ── */}
      <section className="py-28 md:py-36 bg-gradient-dark relative overflow-hidden">
        <FloatingParticles />
        <div className="absolute inset-0 bg-dot-grid opacity-30" />
        <div className="w-full px-6 md:px-10 max-w-6xl mx-auto relative z-10">
          <SectionHeading subtitle="Our Impact" title="Numbers That Speak" light />
          <div className="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-12 mt-8">
            <AnimatedCounter end={1000} suffix="+" label="People Helped" icon={<Users className="h-10 w-10" />} />
            <AnimatedCounter end={50} suffix="+" label="Active Volunteers" icon={<HandHeart className="h-10 w-10" />} />
            <AnimatedCounter end={10} suffix="+" label="Projects Done" icon={<Target className="h-10 w-10" />} />
            <AnimatedCounter end={10} suffix="+" label="Communities" icon={<Users className="h-10 w-10" />} />
          </div>
        </div>
      </section>

      {/* ── FEATURED PROJECTS ── */}
      <section className="py-28">
        <div className="w-full px-6 md:px-10 max-w-7xl mx-auto">
          <SectionHeading subtitle="Our Approach" title="Community Development" description="We work closely with communities, government bodies, and partners to design and implement impactful programs that address real needs and create sustainable solutions." />
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <ProjectCard id="book-distribution" image={bookDistributionImg} title="Book Distribution for Students" category="Education" description="Providing free books, notebooks, and essential study materials to school students in need." progress={75} raised="3,75,000" goal="₹5,00,000" date="23 Jul 2025" location="Nagapattinam" />
            <ProjectCard id="beach-cleanup" image={beachCleanImg} title="Clean Water for Better Tomorrow" category="Water" description="Installing and maintaining clean water facilities to ensure safe drinking water for rural areas." progress={60} raised="6,00,000" goal="₹10,00,000" date="10 Apr 2025" location="Nagapattinam" />
            <ProjectCard id="doctors-day" image={doctorsDayImg} title="Free Health Check-up Camp" category="Health" description="Providing basic health check-ups and medical support to underprivileged communities." progress={85} raised="4,25,000" goal="₹5,00,000" date="15 May 2025" location="Nagapattinam" />
            <ProjectCard id="world-environment-day" image={treePlantationImg} title="Tree Plantation Drive" category="Environment" description="Greener today, healthier tomorrow. Join us in planting trees for a cleaner and safer planet." progress={90} raised="4,50,000" goal="₹5,00,000" date="05 Mar 2025" location="Nagapattinam" />
          </div>
          <div className="text-center mt-12">
            <Link to="/projects" className="inline-flex items-center gap-2 border-2 border-amber-400 text-amber-600 px-8 py-3.5 rounded-full font-bold text-sm hover:bg-amber-400 hover:text-amber-950 transition-all">
              View All Projects <ArrowRight className="h-4 w-4" />
            </Link>
          </div>
        </div>
      </section>

      {/* ── TESTIMONIALS ── */}
      <section className="py-28 bg-warm">
        <div className="w-full px-6 md:px-10 max-w-6xl mx-auto">
          <SectionHeading subtitle="Testimonials" title="Stories of Change" />
          <motion.div variants={staggerContainer} initial="hidden" whileInView="show" viewport={{ once: true }} className="grid grid-cols-1 md:grid-cols-3 gap-6">
            {[
              { quote: "Lumina Trust changed our village. My children now have access to quality education and clean drinking water.", name: "Priya Sharma", role: "Community Beneficiary" },
              { quote: "Volunteering with Lumina Trust has been the most rewarding experience. The impact we create together is incredible.", name: "Rahul Verma", role: "Volunteer" },
              { quote: "Their transparency and dedication to real, lasting impact sets them apart from other organizations.", name: "Dr. Anita Desai", role: "Partner NGO Director" },
            ].map((t, i) => (
              <motion.div key={i} variants={staggerItem}>
                <Testimonial {...t} index={i} />
              </motion.div>
            ))}
          </motion.div>
        </div>
      </section>

      {/* ── NEWSLETTER / GET INVOLVED ── */}
      <section className="py-24 md:py-32 bg-gradient-dark relative overflow-hidden">
        <FloatingParticles />
        <div className="absolute inset-0 bg-dot-grid opacity-25" />

        {/* Ambient Glow */}
        <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none" />

        <div className="w-full px-6 md:px-10 max-w-4xl mx-auto text-center relative z-10">
          <div className="bg-slate-900/80 backdrop-blur-xl border border-white/10 rounded-3xl p-8 md:p-12 shadow-2xl">
            <SectionHeading
              subtitle="Get Involved"
              title="Be a part of the change"
              description="Partner with us, volunteer, or support our initiatives to build stronger communities together."
              light
            />

            <motion.form
              onSubmit={handleNewsletter}
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              className="flex flex-col sm:flex-row gap-3 mt-8 max-w-2xl mx-auto"
            >
              <div className="relative flex-1">
                <Mail className="absolute left-5 top-1/2 -translate-y-1/2 h-5 w-5 text-amber-400/80 pointer-events-none" />
                <input
                  type="email"
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
                  placeholder="Enter your email address"
                  className="w-full pl-13 pr-6 py-4 rounded-full bg-slate-950/90 border border-white/20 text-white placeholder:text-white/40 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-400/20 transition-all text-sm shadow-inner"
                  required
                />
              </div>

              <motion.button
                type="submit"
                disabled={isSubmitting}
                whileHover={{ scale: 1.03 }}
                whileTap={{ scale: 0.97 }}
                className={`bg-gradient-to-r from-amber-400 to-amber-500 text-amber-950 px-9 py-4 rounded-full font-bold text-sm transition-all flex items-center justify-center gap-2 whitespace-nowrap shadow-gold ${
                  isSubmitting ? "opacity-70 cursor-not-allowed" : "hover:shadow-xl hover:brightness-110"
                }`}
              >
                {isSubmitting ? "Subscribing..." : <>Subscribe <Send className="h-4 w-4" /></>}
              </motion.button>
            </motion.form>
          </div>
        </div>
      </section>
    </div>
  );
};

export default Home;
