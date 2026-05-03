import { Link } from "react-router-dom";
import { motion, useScroll, useTransform } from "framer-motion";
import { Users, HandHeart, Target, ArrowRight, Send, ChevronDown, Sparkles, TrendingUp, BookOpen } from "lucide-react";
import heroBg from "@/assets/hero-bg.jpg";
import causeEducation from "@/assets/cause-education.jpg";
import causeWater from "@/assets/cause-water.jpg";
import causeHealth from "@/assets/cause-health.jpg";
import causeEnvironment from "@/assets/cause-environment.jpg";
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
            {[heroBg, causeEducation, causeWater, causeHealth, causeEnvironment, heroBg,
              causeHealth, causeWater, causeEducation, causeEnvironment, heroBg, causeHealth,
              causeEnvironment, heroBg, causeWater, causeEducation, causeHealth, causeWater,
              heroBg, causeEducation, causeEnvironment, causeHealth, causeWater, heroBg
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
      <section className="py-28 bg-warm">
        <div className="w-full px-6 md:px-10 max-w-7xl mx-auto">
          <SectionHeading subtitle="What We Do" title="Our Activities" description="Committed to serving humanity through charitable activities designed to make a positive impact." />
          <motion.div variants={staggerContainer} initial="hidden" whileInView="show" viewport={{ once: true }} className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {[
              { icon: <BookOpen className="h-7 w-7" />, title: "Education & Training", desc: "Skill development and capacity building programs to empower the next generation.", gradient: "from-amber-400 to-orange-500" },
              { icon: <Target className="h-7 w-7" />, title: "Livelihood Support", desc: "Employment and entrepreneurship initiatives to ensure sustainable incomes.", gradient: "from-cyan-400 to-blue-600" },
              { icon: <HandHeart className="h-7 w-7" />, title: "Health & Awareness", desc: "Community health and wellness programs to ensure a healthier tomorrow.", gradient: "from-emerald-400 to-teal-600" },
              { icon: <Users className="h-7 w-7" />, title: "Community Development", desc: "Strengthening grassroots institutions and networks to foster lasting change.", gradient: "from-rose-400 to-pink-500" },
            ].map((item, i) => (
              <motion.div key={i} variants={staggerItem}>
                <motion.div whileHover={{ y: -8 }} transition={{ type: "spring", stiffness: 300 }} className="bg-card rounded-2xl p-7 shadow-ngo h-full flex flex-col hover:shadow-card-hover transition-shadow duration-500">
                  <div className={`inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br ${item.gradient} text-white mb-5 shadow-lg`}>
                    {item.icon}
                  </div>
                  <h3 className="font-heading text-xl text-foreground mb-2 leading-tight">{item.title}</h3>
                  <p className="text-muted-foreground leading-relaxed text-sm">{item.desc}</p>
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
            <ProjectCard image={causeEducation} title="Education for All" category="Education" description="Providing quality education to underprivileged children across rural India." progress={75} raised="3,75,000" goal="₹5,00,000" />
            <ProjectCard image={causeWater} title="Clean Water" category="Water" description="Building wells and purification systems in drought-affected villages." progress={60} raised="6,00,000" goal="₹10,00,000" />
            <ProjectCard image={causeHealth} title="Healthcare Access" category="Health" description="Mobile health camps bringing medical care to remote communities." progress={85} raised="4,25,000" goal="₹5,00,000" />
            <ProjectCard image={causeEnvironment} title="Green Tomorrow" category="Environment" description="Planting trees and promoting sustainable farming practices." progress={45} raised="2,25,000" goal="₹5,00,000" />
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

      {/* ── NEWSLETTER ── */}
      <section className="py-28 md:py-36 bg-gradient-dark relative overflow-hidden">
        <FloatingParticles />
        <div className="absolute inset-0 bg-dot-grid opacity-25" />
        <div className="w-full px-6 md:px-10 max-w-3xl mx-auto text-center relative z-10">
          <SectionHeading subtitle="Get Involved" title="Be a part of the change" description="Partner with us, volunteer, or support our initiatives to build stronger communities together." light />
          <motion.form
            onSubmit={handleNewsletter}
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            className="flex flex-col sm:flex-row gap-3 mt-10"
          >
            <input
              type="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              placeholder="Enter your email address"
              className="flex-1 px-6 py-4 rounded-full bg-white/8 border border-white/15 text-white placeholder:text-white/35 focus:outline-none focus:border-amber-400 transition-all text-sm backdrop-blur-sm"
              required
            />
            <motion.button
              type="submit"
              disabled={isSubmitting}
              whileHover={{ scale: 1.05 }}
              whileTap={{ scale: 0.95 }}
              className={`bg-gradient-to-r from-amber-400 to-amber-500 text-amber-950 px-8 py-4 rounded-full font-bold text-sm transition-all flex items-center justify-center gap-2 whitespace-nowrap ${isSubmitting ? "opacity-70 cursor-not-allowed" : "hover:shadow-gold"}`}
            >
              {isSubmitting ? "Subscribing..." : <>Subscribe <Send className="h-4 w-4" /></>}
            </motion.button>
          </motion.form>
        </div>
      </section>
    </div>
  );
};

export default Home;
