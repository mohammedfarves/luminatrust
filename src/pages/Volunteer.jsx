import { motion } from "framer-motion";
import { Heart, Users, Globe, BookOpen, Target } from "lucide-react";
import SectionHeading from "@/components/SectionHeading";
import HeroBackground from "@/components/HeroBackground";
import { staggerContainer, staggerItem, GlowCard } from "@/components/AnimationEffects";

const benefits = [
  { icon: <Heart className="h-6 w-6" />, title: "Make a Real Impact", desc: "Make a real impact in people's lives.", gradient: "from-rose-400 to-pink-600" },
  { icon: <Globe className="h-6 w-6" />, title: "Gain Field Experience", desc: "Gain meaningful field experience.", gradient: "from-amber-400 to-orange-500" },
  { icon: <BookOpen className="h-6 w-6" />, title: "Develop New Skills", desc: "Develop new skills and leadership qualities.", gradient: "from-cyan-400 to-blue-600" },
  { icon: <Users className="h-6 w-6" />, title: "Join Our Team", desc: "Be part of a passionate and purpose-driven team.", gradient: "from-emerald-400 to-teal-600" },
];

const Volunteer = () => {
  return (
    <div className="overflow-hidden">
      {/* Hero */}
      <section className="relative py-44 md:py-52 overflow-hidden bg-slate-950">
        <HeroBackground />
        <div className="w-full px-6 md:px-10 text-center relative z-10">
          <motion.div initial={{ opacity: 0, y: 30 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.7 }}>
            <span className="inline-flex items-center gap-2 glass rounded-full px-5 py-2 text-emerald-300 font-bold text-xs uppercase tracking-[0.2em] mb-6">Join Us</span>
            <h1 className="font-heading text-4xl md:text-6xl lg:text-7xl text-white mt-4 leading-[1.1]">
              Volunteer With Us – <span className="text-amber-400">Be the Change</span>
            </h1>
            <motion.p initial={{ opacity: 0 }} animate={{ opacity: 1 }} transition={{ delay: 0.3 }} className="text-white/60 mt-6 max-w-2xl mx-auto text-lg italic">
              "Volunteering with Lumina Trust has been a life-changing experience. I was able to contribute while learning and growing personally."
            </motion.p>
          </motion.div>
        </div>
      </section>

      {/* Benefits */}
      <section className="py-28 bg-warm">
        <div className="w-full px-6 md:px-10 max-w-6xl mx-auto">
          <SectionHeading subtitle="Why Volunteer" title="Benefits of Joining Us" />
          <motion.div variants={staggerContainer} initial="hidden" whileInView="show" viewport={{ once: true }} className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {benefits.map((b, i) => (
              <motion.div key={i} variants={staggerItem}>
                <GlowCard>
                  <motion.div whileHover={{ y: -8 }} className="bg-card rounded-2xl p-7 shadow-ngo text-center h-full hover:shadow-card-hover transition-all duration-500">
                    <div className={`inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br ${b.gradient} text-white mb-5 shadow-lg`}>{b.icon}</div>
                    <h4 className="font-heading text-xl text-foreground mb-2">{b.title}</h4>
                    <p className="text-sm text-muted-foreground leading-relaxed">{b.desc}</p>
                  </motion.div>
                </GlowCard>
              </motion.div>
            ))}
          </motion.div>
        </div>
      </section>

      {/* Volunteer Opportunities & Who Can Apply */}
      <section className="py-28">
        <div className="w-full px-6 md:px-10 max-w-6xl mx-auto">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-16">
            <motion.div initial={{ opacity: 0, x: -30 }} whileInView={{ opacity: 1, x: 0 }} viewport={{ once: true }}>
              <h2 className="font-heading text-3xl text-foreground mb-6">Volunteer Opportunities</h2>
              <ul className="space-y-4">
                {[
                  { title: "Education Support", desc: "Teach and mentor students" },
                  { title: "Skill Training", desc: "Assist in training programs" },
                  { title: "Community Outreach", desc: "Participate in awareness campaigns" },
                  { title: "Event Support", desc: "Help organize workshops and events" },
                  { title: "Digital & Admin Support", desc: "Content creation, data entry, social media" }
                ].map((item, i) => (
                  <li key={i} className="flex gap-4 p-4 bg-card rounded-xl border border-border shadow-sm hover:shadow-md transition-all">
                    <div className="w-10 h-10 rounded-full bg-amber-400/20 flex items-center justify-center shrink-0">
                      <Target className="h-5 w-5 text-amber-500" />
                    </div>
                    <div>
                      <h4 className="font-heading text-lg text-foreground">{item.title}</h4>
                      <p className="text-sm text-muted-foreground">{item.desc}</p>
                    </div>
                  </li>
                ))}
              </ul>
            </motion.div>

            <motion.div initial={{ opacity: 0, x: 30 }} whileInView={{ opacity: 1, x: 0 }} viewport={{ once: true }}>
              <h2 className="font-heading text-3xl text-foreground mb-6">Who Can Apply?</h2>
              <div className="bg-gradient-to-br from-amber-400/10 to-orange-500/10 p-8 rounded-2xl border border-amber-400/20 h-full flex flex-col justify-center">
                <ul className="space-y-6">
                  <li className="flex items-center gap-4">
                    <div className="w-12 h-12 rounded-full bg-amber-400 flex items-center justify-center shadow-lg shrink-0">
                      <Users className="h-6 w-6 text-amber-950" />
                    </div>
                    <span className="text-foreground font-medium text-lg">Students, professionals, and community members</span>
                  </li>
                  <li className="flex items-center gap-4">
                    <div className="w-12 h-12 rounded-full bg-amber-400 flex items-center justify-center shadow-lg shrink-0">
                      <Heart className="h-6 w-6 text-amber-950" />
                    </div>
                    <span className="text-foreground font-medium text-lg">Individuals passionate about social change</span>
                  </li>
                  <li className="flex items-center gap-4">
                    <div className="w-12 h-12 rounded-full bg-amber-400 flex items-center justify-center shadow-lg shrink-0">
                      <BookOpen className="h-6 w-6 text-amber-950" />
                    </div>
                    <span className="text-foreground font-medium text-lg">No prior experience required (training will be provided)</span>
                  </li>
                </ul>
              </div>
            </motion.div>
          </div>
        </div>
      </section>
    </div>
  );
};

export default Volunteer;
