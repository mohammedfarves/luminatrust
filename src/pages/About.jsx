import { motion } from "framer-motion";
import { FloatingParticles, staggerContainer, staggerItem, GlowCard } from "@/components/AnimationEffects";
import SectionHeading from "@/components/SectionHeading";
import { Users, Target, Shield, Sparkles } from "lucide-react";

const team = [
  { name: "Ananya Kapoor", role: "Founder & CEO", gradient: "from-amber-400 to-orange-500" },
  { name: "Vikram Mehta", role: "Director of Operations", gradient: "from-cyan-400 to-blue-600" },
  { name: "Dr. Lakshmi Rao", role: "Head of Healthcare", gradient: "from-rose-400 to-pink-600" },
  { name: "Arjun Singh", role: "Community Director", gradient: "from-emerald-400 to-teal-600" },
];

const About = () => (
  <div className="overflow-hidden">
    {/* ── HERO ── */}
    <section className="relative py-44 md:py-52 overflow-hidden" style={{ background: "linear-gradient(135deg, hsl(185 60% 18%) 0%, hsl(215 50% 14%) 50%, hsl(215 45% 8%) 100%)" }}>
      <FloatingParticles />
      <div className="absolute inset-0 bg-dot-grid opacity-20" />
      <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[400px] bg-teal-600/15 rounded-full blur-3xl" />
      <div className="w-full px-6 md:px-10 text-center relative z-10">
        <motion.div initial={{ opacity: 0, y: 30 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.7 }}>
          <span className="inline-flex items-center gap-2 glass rounded-full px-5 py-2 text-xs font-bold uppercase tracking-[0.2em] text-teal-300 mb-6">
            About Us
          </span>
          <h1 className="font-heading text-4xl md:text-6xl lg:text-7xl text-white mt-4 leading-[1.1]">
            About Us – <span className="text-amber-400">Lumina Trust</span>
          </h1>
        </motion.div>
      </div>
    </section>

    {/* ── NEW CONTENT DESIGN ── */}
    <section className="py-28 relative">
      {/* Decorative background blur */}
      <div className="absolute top-0 right-0 w-96 h-96 bg-amber-400/5 rounded-full blur-3xl pointer-events-none" />
      <div className="absolute bottom-0 left-0 w-96 h-96 bg-teal-400/5 rounded-full blur-3xl pointer-events-none" />

      <div className="w-full px-6 md:px-10 max-w-6xl mx-auto relative z-10">
        {/* Intro */}
        <motion.div initial={{ opacity: 0, y: 30 }} whileInView={{ opacity: 1, y: 0 }} viewport={{ once: true }} transition={{ duration: 0.7 }} className="max-w-4xl mx-auto text-center mb-20">
          <div className="inline-flex items-center justify-center w-16 h-16 rounded-full bg-amber-400/10 mb-8">
            <Sparkles className="h-8 w-8 text-amber-500" />
          </div>
          <p className="text-3xl md:text-4xl text-foreground font-heading leading-tight mb-6">
            Lumina Trust is a purpose-driven organization committed to empowering communities and creating sustainable opportunities for a better future.
          </p>
          <p className="text-muted-foreground text-lg md:text-xl leading-relaxed max-w-3xl mx-auto">
            Founded on the belief that every individual deserves access to education, skills, and dignity, we strive to build inclusive and self-reliant societies.
          </p>
        </motion.div>

        {/* Feature Cards Grid */}
        <motion.div variants={staggerContainer} initial="hidden" whileInView="show" viewport={{ once: true }} className="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
          {[
            {
              icon: <Users className="h-8 w-8 text-cyan-500" />,
              title: "Our Strength",
              text: "Lumina Trust is strengthened by a dedicated group of professionals who have come together with a shared vision to support and uplift communities. Their collective expertise, experience, and commitment drive our initiatives and ensure meaningful, lasting impact.",
              border: "border-t-4 border-cyan-400",
              bgIcon: "bg-cyan-500/10"
            },
            {
              icon: <Target className="h-8 w-8 text-amber-500" />,
              title: "Our Focus",
              text: "We focus on education, skill development, livelihood enhancement, and community welfare programs. By collaborating with institutions, government bodies, and industry partners, we bridge the gap between potential and opportunity.",
              border: "border-t-4 border-amber-400",
              bgIcon: "bg-amber-500/10"
            },
            {
              icon: <Shield className="h-8 w-8 text-teal-500" />,
              title: "Our Approach",
              text: "Our efforts are centered on empowering underserved communities through quality training, career guidance, and social support systems. With a strong foundation of transparency, integrity, and social responsibility, Lumina Trust works at the grassroots level to bring real and sustainable change.",
              border: "border-t-4 border-teal-400",
              bgIcon: "bg-teal-500/10"
            }
          ].map((item, i) => (
            <motion.div key={i} variants={staggerItem} className="h-full">
              <GlowCard>
                <div className={`bg-card rounded-2xl p-8 shadow-ngo h-full flex flex-col hover:shadow-card-hover transition-shadow duration-500 ${item.border}`}>
                  <div className={`${item.bgIcon} w-16 h-16 rounded-2xl flex items-center justify-center mb-6`}>
                    {item.icon}
                  </div>
                  <h3 className="font-heading text-2xl text-foreground mb-4">{item.title}</h3>
                  <p className="text-muted-foreground leading-relaxed flex-grow text-[15px]">{item.text}</p>
                </div>
              </GlowCard>
            </motion.div>
          ))}
        </motion.div>

        {/* Outro */}
        <motion.div initial={{ opacity: 0, scale: 0.95 }} whileInView={{ opacity: 1, scale: 1 }} viewport={{ once: true }} transition={{ duration: 0.6 }} className="max-w-4xl mx-auto">
          <div className="bg-gradient-to-br from-teal-600/10 to-amber-500/10 rounded-3xl p-10 md:p-14 border border-teal-500/20 text-center relative overflow-hidden shadow-lg">
            <div className="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-teal-400 via-cyan-400 to-amber-400" />
            <p className="text-2xl md:text-3xl font-heading text-teal-800 dark:text-teal-300 leading-relaxed italic">
              "Together, we aim to illuminate lives and build a brighter, more equitable future for all."
            </p>
          </div>
        </motion.div>
      </div>
    </section>

    {/* ── TEAM ── */}
    <section className="py-28 bg-warm">
      <div className="w-full px-6 md:px-10 max-w-6xl mx-auto">
        <SectionHeading subtitle="Leadership" title="Meet Our Team" description="Dedicated professionals driving positive change every day." />
        <motion.div variants={staggerContainer} initial="hidden" whileInView="show" viewport={{ once: true }} className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          {team.map((m, i) => (
            <motion.div key={i} variants={staggerItem}>
              <motion.div whileHover={{ y: -10 }} transition={{ type: "spring", stiffness: 300 }} className="bg-card rounded-2xl p-8 shadow-ngo text-center group hover:shadow-card-hover transition-shadow duration-500">
                <div className={`w-20 h-20 rounded-full bg-gradient-to-br ${m.gradient} mx-auto mb-5 flex items-center justify-center text-white font-heading text-3xl shadow-lg`}>
                  {m.name.charAt(0)}
                </div>
                <h4 className="font-heading text-xl text-foreground">{m.name}</h4>
                <p className="text-sm text-muted-foreground mt-1">{m.role}</p>
              </motion.div>
            </motion.div>
          ))}
        </motion.div>
      </div>
    </section>
  </div>
);

export default About;
