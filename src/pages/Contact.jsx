import { motion } from "framer-motion";
import { Mail, Phone, MapPin, Send } from "lucide-react";
import SectionHeading from "@/components/SectionHeading";
import { FloatingParticles, staggerContainer, staggerItem, GlowCard } from "@/components/AnimationEffects";
import { useState } from "react";
import { toast } from "sonner";

const inputCls = "w-full px-4 py-3.5 rounded-xl border border-border bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-amber-400/50 focus:border-amber-400 transition-all";

const Contact = () => {
  const [form, setForm] = useState({ name: "", email: "", subject: "", message: "" });
  const [isSubmitting, setIsSubmitting] = useState(false);

  const handleSubmit = async (e) => { 
    e.preventDefault(); 
    setIsSubmitting(true);
    try {
      const response = await fetch("https://api.web3forms.com/submit", {
        method: "POST",
        headers: { "Content-Type": "application/json", Accept: "application/json" },
        body: JSON.stringify({
          access_key: "50c9f574-f407-44d7-a510-ab85422ed81c",
          subject: "New Contact Form Submission - Lumina Trust",
          ...form
        }),
      });
      const result = await response.json();
      if (result.success) {
        toast.success("Message sent! We'll get back to you soon."); 
        setForm({ name: "", email: "", subject: "", message: "" }); 
      } else {
        toast.error(result.message || "Failed to send message. Please try again.");
      }
    } catch (error) {
      toast.error("Something went wrong. Please try again.");
    } finally {
      setIsSubmitting(false);
    }
  };

  const handleChange = (e) => setForm({ ...form, [e.target.name]: e.target.value });

  return (
    <div className="overflow-hidden">
      {/* Hero */}
      <section className="relative py-44 md:py-52 overflow-hidden" style={{ background: "linear-gradient(135deg, hsl(200 60% 16%) 0%, hsl(215 50% 12%) 50%, hsl(215 45% 8%) 100%)" }}>
        <FloatingParticles />
        <div className="absolute inset-0 bg-dot-grid opacity-20" />
        <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[400px] bg-cyan-600/15 rounded-full blur-3xl" />
        <div className="w-full px-6 md:px-10 text-center relative z-10">
          <motion.div initial={{ opacity: 0, y: 30 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.7 }}>
            <span className="inline-flex items-center gap-2 glass rounded-full px-5 py-2 text-cyan-300 font-bold text-xs uppercase tracking-[0.2em] mb-6">Get in Touch</span>
            <h1 className="font-heading text-4xl md:text-6xl lg:text-7xl text-white mt-4 leading-[1.1]">
              We'd Love to <span className="text-amber-400">Hear From You</span>
            </h1>
            <motion.p initial={{ opacity: 0 }} animate={{ opacity: 1 }} transition={{ delay: 0.3 }} className="text-white/60 mt-6 max-w-2xl mx-auto text-lg">
              Have a question, want to partner, or looking to volunteer? Reach out to us, and our team will get back to you as soon as possible.
            </motion.p>
          </motion.div>
        </div>
      </section>

      <section className="py-28">
        <div className="w-full px-6 md:px-10 max-w-6xl mx-auto">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-16">
            {/* Left: info cards */}
            <motion.div initial={{ opacity: 0, x: -40 }} whileInView={{ opacity: 1, x: 0 }} viewport={{ once: true }} transition={{ duration: 0.7 }}>
              <SectionHeading subtitle="Reach Out" title="We're Here to Help" align="left" />
              <motion.div variants={staggerContainer} initial="hidden" whileInView="show" viewport={{ once: true }} className="space-y-4 mt-8">
                {[
                  { icon: <MapPin className="h-5 w-5 text-amber-500" />, label: "Office Address", value: "Lumina Trust, Nagapattinam", bg: "bg-amber-50 dark:bg-amber-950/20" },
                  { icon: <Phone className="h-5 w-5 text-cyan-500" />, label: "Phone Number", value: "+91 98947 77349", bg: "bg-cyan-50 dark:bg-cyan-950/20" },
                  { icon: <Mail className="h-5 w-5 text-emerald-500" />, label: "Email Address", value: "support@luminatrust.org", bg: "bg-emerald-50 dark:bg-emerald-950/20" },
                ].map((c, i) => (
                  <motion.div key={i} variants={staggerItem}>
                    <GlowCard>
                      <motion.div whileHover={{ x: 5 }} className="flex gap-4 items-center bg-card p-5 rounded-2xl shadow-ngo hover:shadow-card-hover transition-shadow duration-500">
                        <div className={`w-12 h-12 rounded-xl ${c.bg} flex items-center justify-center shrink-0`}>{c.icon}</div>
                        <div>
                          <p className="font-bold text-foreground text-sm">{c.label}</p>
                          <p className="text-muted-foreground text-sm mt-0.5">{c.value}</p>
                        </div>
                      </motion.div>
                    </GlowCard>
                  </motion.div>
                ))}
              </motion.div>
              <motion.div initial={{ opacity: 0, y: 20 }} whileInView={{ opacity: 1, y: 0 }} viewport={{ once: true }} transition={{ delay: 0.3 }} className="mt-8 rounded-2xl overflow-hidden shadow-ngo">
               <iframe
  src="https://www.google.com/maps?q=Nagapattinam,Tamil%20Nadu&output=embed"
  width="100%"
  height="220"
  style={{ border: 0 }}
  allowFullScreen
  loading="lazy"
  title="Nagapattinam Location"
/>
              </motion.div>
            </motion.div>

            {/* Right: form */}
            <motion.div initial={{ opacity: 0, x: 40 }} whileInView={{ opacity: 1, x: 0 }} viewport={{ once: true }} transition={{ duration: 0.7 }}>
              <div className="bg-card rounded-2xl p-8 md:p-10 shadow-ngo relative overflow-hidden">
                <div className="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-amber-400 via-amber-500 to-orange-500" />
                <h3 className="font-heading text-3xl text-foreground mb-8">Send Us a Message</h3>
                <form onSubmit={handleSubmit} className="space-y-5">
                  {[
                    { name: "name", label: "Full Name", type: "text", placeholder: "Your name" },
                    { name: "email", label: "Email", type: "email", placeholder: "your@email.com" },
                    { name: "subject", label: "Subject", type: "text", placeholder: "How can we help?" },
                  ].map((f) => (
                    <div key={f.name}>
                      <label className="block text-sm font-semibold text-foreground mb-2">{f.label}</label>
                      <input type={f.type} name={f.name} value={form[f.name]} onChange={handleChange} placeholder={f.placeholder} required className={inputCls} />
                    </div>
                  ))}
                  <div>
                    <label className="block text-sm font-semibold text-foreground mb-2">Message</label>
                    <textarea name="message" value={form.message} onChange={handleChange} placeholder="Your message..." rows={5} required className={`${inputCls} resize-none`} />
                  </div>
                  <motion.button type="submit" disabled={isSubmitting} whileHover={{ scale: 1.02 }} whileTap={{ scale: 0.98 }}
                    className={`w-full bg-gradient-to-r from-amber-400 to-amber-500 text-amber-950 py-4 rounded-full font-bold text-sm transition-all flex items-center justify-center gap-2 ${isSubmitting ? "opacity-70 cursor-not-allowed" : "hover:shadow-gold"}`}>
                    {isSubmitting ? "Sending..." : <>Send Message <Send className="h-4 w-4" /></>}
                  </motion.button>
                </form>
              </div>
            </motion.div>
          </div>
        </div>
      </section>
    </div>
  );
};

export default Contact;
