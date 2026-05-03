import { motion } from "framer-motion";
import { Heart, Users, Globe, BookOpen, Target } from "lucide-react";
import SectionHeading from "@/components/SectionHeading";
import { FloatingParticles, staggerContainer, staggerItem, GlowCard } from "@/components/AnimationEffects";
import { useState } from "react";
import { toast } from "sonner";
const benefits = [
  { icon: <Heart className="h-6 w-6" />, title: "Make a Real Impact", desc: "Make a real impact in people's lives.", gradient: "from-rose-400 to-pink-600" },
  { icon: <Globe className="h-6 w-6" />, title: "Gain Field Experience", desc: "Gain meaningful field experience.", gradient: "from-amber-400 to-orange-500" },
  { icon: <BookOpen className="h-6 w-6" />, title: "Develop New Skills", desc: "Develop new skills and leadership qualities.", gradient: "from-cyan-400 to-blue-600" },
  { icon: <Users className="h-6 w-6" />, title: "Join Our Team", desc: "Be part of a passionate and purpose-driven team.", gradient: "from-emerald-400 to-teal-600" },
];

const inputCls = "w-full px-4 py-3.5 rounded-xl border border-border bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-amber-400/50 focus:border-amber-400 transition-all";

const Volunteer = () => {
  const [data, setData] = useState({
    name: "", age: "", dob: "", gender: "", phone: "", email: "", register_type: "",
    organization: "", bicycle: "", volunteering: "", role: "", reason: "",
    regular_use: "", pledge: "", consent: false
  });
  const [isSubmitting, setIsSubmitting] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault();
    setIsSubmitting(true);

    try {
      const formData = new FormData();
      formData.append("name", data.name);
      formData.append("age", data.age);
      formData.append("dob", data.dob);
      formData.append("gender", data.gender);
      formData.append("phone", data.phone);
      formData.append("email", data.email);
      formData.append("register_type", data.register_type);
      formData.append("organization", data.organization);
      formData.append("bicycle", data.bicycle);
      formData.append("volunteering", data.volunteering);
      formData.append("role", data.role);
      formData.append("reason", data.reason);
      formData.append("regular_use", data.regular_use);
      formData.append("pledge", data.pledge);
      formData.append("consent", data.consent);

      // 🔥 IMPORTANT: no-cors required
      await fetch("https://script.google.com/macros/s/AKfycbwj1R9YcNXzxB0uMa3m8A5_Cdr4zsbiqwQN3EI_4DaQep-sOYET7mvZPAOckwxFYg2XCw/exec", {
        method: "POST",
        body: formData,
        mode: "no-cors"
      });

      // ✅ Always assume success (no-cors doesn't return response)
      toast.success("Submitted successfully");

      // Reset form
      setData({
        name: "", age: "", dob: "", gender: "", phone: "", email: "", register_type: "",
        organization: "", bicycle: "", volunteering: "", role: "", reason: "",
        regular_use: "", pledge: "", consent: false
      });

    } catch (error) {
      // ❌ Don't show error (CORS blocks response)
      console.log("Fetch error (ignored):", error);
    } finally {
      setIsSubmitting(false);
    }
  };

  const handleChange = (e) => {
    const value = e.target.type === 'checkbox' ? e.target.checked : e.target.value;
    setData({ ...data, [e.target.name]: value });
  };

  return (
    <div className="overflow-hidden">
      {/* Hero — emerald-to-navy */}
      <section className="relative py-44 md:py-52 overflow-hidden" style={{ background: "linear-gradient(135deg, hsl(160 55% 15%) 0%, hsl(185 55% 12%) 50%, hsl(215 45% 8%) 100%)" }}>
        <FloatingParticles />
        <div className="absolute inset-0 bg-dot-grid opacity-20" />
        <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[400px] bg-emerald-600/15 rounded-full blur-3xl" />
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

      {/* Form */}
      <section className="py-28">
        <div className="w-full px-6 md:px-10 max-w-4xl mx-auto">
          <SectionHeading subtitle="Register" title="Volunteer Registration" description="Fill in the form below and we'll get back to you within 48 hours." />
          <motion.form onSubmit={handleSubmit} initial={{ opacity: 0, y: 30 }} whileInView={{ opacity: 1, y: 0 }} viewport={{ once: true }} className="space-y-8 bg-card p-8 md:p-10 rounded-2xl shadow-ngo border-t-4 border-amber-400">
            
            {/* Personal Information */}
            <div className="space-y-5">
              <h3 className="text-xl font-heading text-foreground border-b border-border pb-2">Personal Information</h3>
              <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                  <label className="block text-sm font-semibold text-foreground mb-2">Full Name / முழுப்பெயர் *</label>
                  <input type="text" name="name" value={data.name} onChange={handleChange} required className={inputCls} />
                </div>
                <div>
                  <label className="block text-sm font-semibold text-foreground mb-2">Age / வயது *</label>
                  <input type="number" name="age" value={data.age} onChange={handleChange} required className={inputCls} />
                </div>
                <div>
                  <label className="block text-sm font-semibold text-foreground mb-2">Date of Birth *</label>
                  <input type="date" name="dob" value={data.dob} onChange={handleChange} required className={inputCls} />
                </div>
                <div>
                  <label className="block text-sm font-semibold text-foreground mb-2">Gender / பாலினம் *</label>
                  <select name="gender" value={data.gender} onChange={handleChange} required className={inputCls}>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                  </select>
                </div>
                <div>
                  <label className="block text-sm font-semibold text-foreground mb-2">Contact Number / தொடர்பு எண் *</label>
                  <input type="tel" name="phone" value={data.phone} onChange={handleChange} required className={inputCls} />
                </div>
                <div>
                  <label className="block text-sm font-semibold text-foreground mb-2">Email Address / மின்னஞ்சல் முகவரி *</label>
                  <input type="email" name="email" value={data.email} onChange={handleChange} required className={inputCls} />
                </div>
              </div>
            </div>

            {/* Registration Details */}
            <div className="space-y-5">
              <h3 className="text-xl font-heading text-foreground border-b border-border pb-2">Registration Details</h3>
              <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                  <label className="block text-sm font-semibold text-foreground mb-2">You are registering as *</label>
                  <select name="register_type" value={data.register_type} onChange={handleChange} required className={inputCls}>
                    <option value="">Select Type</option>
                    <option value="Individual">Individual</option>
                    <option value="Student">Student</option>
                    <option value="Volunteer">Volunteer</option>
                    <option value="Organization">Organization</option>
                  </select>
                </div>
                <div>
                  <label className="block text-sm font-semibold text-foreground mb-2">Organization or Institution Name</label>
                  <input type="text" name="organization" value={data.organization} onChange={handleChange} className={inputCls} placeholder="Optional" />
                </div>
                <div>
                  <label className="block text-sm font-semibold text-foreground mb-2">Will you bring your own bicycle? *</label>
                  <select name="bicycle" value={data.bicycle} onChange={handleChange} required className={inputCls}>
                    <option value="">Select Option</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>
                <div>
                  <label className="block text-sm font-semibold text-foreground mb-2">Are you interested in volunteering? *</label>
                  <select name="volunteering" value={data.volunteering} onChange={handleChange} required className={inputCls}>
                    <option value="">Select Option</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>
              </div>
            </div>

            {/* Additional Info */}
            <div className="space-y-5">
              <h3 className="text-xl font-heading text-foreground border-b border-border pb-2">Additional Information</h3>
              <div>
                <label className="block text-sm font-semibold text-foreground mb-2">If Yes, Preferred role</label>
                <input type="text" name="role" value={data.role} onChange={handleChange} className={inputCls} placeholder="E.g., Event Coordination, Route Management" />
              </div>
              <div>
                <label className="block text-sm font-semibold text-foreground mb-2">Why do you want to participate?</label>
                <textarea name="reason" value={data.reason} onChange={handleChange} rows={3} className={`${inputCls} resize-none`} placeholder="Tell us your motivation..." />
              </div>
            </div>

            {/* Declarations */}
            <div className="space-y-5 bg-muted/30 p-6 rounded-xl border border-border">
              <h3 className="text-xl font-heading text-foreground mb-2">Declarations</h3>
              <div className="grid grid-cols-1 md:grid-cols-2 gap-5 mb-4">
                <div>
                  <label className="block text-sm font-semibold text-foreground mb-2">Do you use a bicycle regularly? *</label>
                  <select name="regular_use" value={data.regular_use} onChange={handleChange} required className={inputCls}>
                    <option value="">Select Option</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>
                <div>
                  <label className="block text-sm font-semibold text-foreground mb-2">Would you pledge to use a bicycle? *</label>
                  <select name="pledge" value={data.pledge} onChange={handleChange} required className={inputCls}>
                    <option value="">Select Option</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>
              </div>

              <div className="flex items-start gap-3 bg-card p-4 rounded-lg border border-border shadow-sm">
                <input type="checkbox" id="consent" name="consent" checked={data.consent} onChange={handleChange} required className="mt-1 w-5 h-5 text-amber-500 border-border rounded focus:ring-amber-400" />
                <label htmlFor="consent" className="text-sm text-foreground leading-relaxed">
                  <span className="font-semibold block mb-1">Consent & Declaration *</span>
                  I agree to the terms and conditions and confirm that the information provided is accurate. I understand my role and responsibilities.
                </label>
              </div>
            </div>

            <motion.button type="submit" disabled={isSubmitting} whileHover={{ scale: 1.02 }} whileTap={{ scale: 0.98 }}
              className={`w-full bg-gradient-to-r from-amber-400 to-amber-500 text-amber-950 py-4 rounded-full font-bold text-lg transition-all flex items-center justify-center gap-2 mt-8 ${isSubmitting ? "opacity-70 cursor-not-allowed" : "hover:shadow-gold"}`}>
              {isSubmitting ? "Submitting Registration..." : <><Heart className="h-5 w-5 fill-amber-950" /> Submit Registration</>}
            </motion.button>
          </motion.form>
        </div>
      </section>
    </div>
  );
};

export default Volunteer;
