import { motion, AnimatePresence } from "framer-motion";
import { Heart, BookOpen, Users, Check, Sparkles, Upload, QrCode, Building2 } from "lucide-react";
import SectionHeading from "@/components/SectionHeading";
import { FloatingParticles, GlowCard } from "@/components/AnimationEffects";
import { useState } from "react";
import { toast } from "sonner";
import emailjs from '@emailjs/browser';
import paymentQr from "@/assets/paymentqr/payment-qr.jpeg";

const tiers = [
  { amount: "₹500", value: "500", title: "Learning Materials", desc: "Supports learning materials for a child", icon: <BookOpen className="h-6 w-6" />, gradient: "from-rose-400 to-pink-500" },
  { amount: "₹1,000", value: "1000", title: "Skill Training", desc: "Provides skill training for youth", icon: <Users className="h-6 w-6" />, gradient: "from-amber-400 to-orange-500", featured: true },
  { amount: "₹2,500", value: "2500", title: "Livelihood Support", desc: "Supports livelihood opportunities for a family", icon: <Heart className="h-6 w-6" />, gradient: "from-emerald-400 to-teal-500" },
];

const inputCls = "w-full px-4 py-3.5 rounded-xl border border-border bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-amber-400/50 focus:border-amber-400 transition-all";

const toBase64 = (file) => new Promise((resolve, reject) => {
  const reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onload = () => resolve(reader.result);
  reader.onerror = error => reject(error);
});

const Donate = () => {
  const [selectedTier, setSelectedTier] = useState(null);
  const [form, setForm] = useState({ 
    name: "", 
    email: "", 
    phone: "", 
    amount: "", 
    payment_method: "", 
    transaction_id: "",
    message: "" 
  });
  const [screenshot, setScreenshot] = useState(null);
  const [isSubmitting, setIsSubmitting] = useState(false);

  const handleTierSelect = (tier) => { setSelectedTier(tier.value); setForm({ ...form, amount: tier.value }); };
  
  const handleSubmit = async (e) => { 
    e.preventDefault(); 
    if (!screenshot) {
      toast.error("Please upload a payment screenshot.");
      return;
    }
    setIsSubmitting(true);
    
    try {
      const base64 = await toBase64(screenshot);
      const templateParams = {
        ...form,
        attachment: base64
      };
      
      // 🔥 Note: You need to replace these with your actual EmailJS credentials
      await emailjs.send(
        'service_id', // YOUR_SERVICE_ID
        'template_id', // YOUR_TEMPLATE_ID
        templateParams,
        'public_key' // YOUR_PUBLIC_KEY
      );
      
      toast.success("Thank you! Your donation details have been submitted. 💛");
      setForm({ name: "", email: "", phone: "", amount: "", payment_method: "", transaction_id: "", message: "" }); 
      setScreenshot(null);
      setSelectedTier(null);
    } catch (error) {
      toast.error("Failed to send. Please check your EmailJS configuration.");
      console.error("EmailJS Error:", error);
    } finally {
      setIsSubmitting(false);
    }
  };
  
  const handleChange = (e) => setForm({ ...form, [e.target.name]: e.target.value });

  return (
    <div className="overflow-hidden">
      <section className="relative py-44 md:py-52 overflow-hidden" style={{ background: "linear-gradient(135deg, hsl(36 90% 22%) 0%, hsl(28 80% 18%) 50%, hsl(215 45% 10%) 100%)" }}>
        <FloatingParticles />
        <div className="absolute inset-0 bg-dot-grid opacity-20" />
        <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[400px] bg-amber-500/15 rounded-full blur-3xl" />
        <div className="w-full px-6 md:px-10 text-center relative z-10">
          <motion.div initial={{ opacity: 0, y: 30 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.7 }}>
            <motion.div initial={{ scale: 0 }} animate={{ scale: 1 }} transition={{ delay: 0.2, type: "spring" }} className="inline-flex items-center gap-2 glass rounded-full px-5 py-2 mb-6">
              <Sparkles className="h-3.5 w-3.5 text-amber-400" />
              <span className="text-amber-300 font-bold text-xs uppercase tracking-[0.2em]">Support Us</span>
            </motion.div>
            <h1 className="font-heading text-4xl md:text-6xl lg:text-7xl text-white mt-4 leading-[1.1]">
              Donate <span className="text-amber-400">Today</span>
            </h1>
            <motion.p initial={{ opacity: 0 }} animate={{ opacity: 1 }} transition={{ delay: 0.4 }} className="text-white/60 mt-6 max-w-2xl mx-auto text-lg">
              Be the reason someone smiles today. Donate now and create lasting impact.
            </motion.p>
          </motion.div>
        </div>
      </section>

      <section className="py-28 bg-warm">
        <div className="w-full px-6 md:px-10 max-w-5xl mx-auto">
          <SectionHeading subtitle="Why Your Donation Matters" title="Your Impact" description="With your contribution, we are able to: Educate and empower underserved communities, Create employment and skill opportunities, and Improve health and awareness at grassroots level." />
          <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
            {tiers.map((t, i) => (
              <motion.div key={i} initial={{ opacity: 0, y: 30 }} whileInView={{ opacity: 1, y: 0 }} viewport={{ once: true }} transition={{ delay: i * 0.15 }}>
                <GlowCard>
                  <motion.button onClick={() => handleTierSelect(t)} whileHover={{ y: -5 }} whileTap={{ scale: 0.98 }}
                    className={`bg-card rounded-2xl p-10 shadow-ngo text-center w-full relative overflow-hidden transition-all duration-300 ${selectedTier === t.value ? "ring-2 ring-amber-400 shadow-gold" : "hover:shadow-card-hover"} ${t.featured ? "border-2 border-amber-200" : ""}`}>
                    {t.featured && <div className="absolute top-4 left-1/2 -translate-x-1/2 bg-amber-400 text-amber-950 text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full whitespace-nowrap">Most Popular</div>}
                    <AnimatePresence>
                      {selectedTier === t.value && (
                        <motion.div initial={{ scale: 0 }} animate={{ scale: 1 }} exit={{ scale: 0 }} className="absolute top-4 right-4 bg-amber-400 rounded-full p-1">
                          <Check className="h-4 w-4 text-amber-950" />
                        </motion.div>
                      )}
                    </AnimatePresence>
                    <div className={`inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br ${t.gradient} text-white mb-5 shadow-lg mt-6`}>{t.icon}</div>
                    <div className="font-heading text-4xl text-foreground mb-2">{t.amount}</div>
                    <h4 className="font-heading text-xl text-foreground mb-3">{t.title}</h4>
                    <p className="text-sm text-muted-foreground leading-relaxed">{t.desc}</p>
                  </motion.button>
                </GlowCard>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      <section className="py-28">
        <div className="w-full px-6 md:px-10 max-w-4xl mx-auto">
          <SectionHeading subtitle="Donate" title="Donation Form" description="Please fill in your details and complete the payment below." />
          <motion.form onSubmit={handleSubmit} initial={{ opacity: 0, y: 30 }} whileInView={{ opacity: 1, y: 0 }} viewport={{ once: true }} className="space-y-6 bg-card p-8 md:p-10 rounded-2xl shadow-ngo border-t-4 border-amber-400">
            <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
              <div>
                <label className="block text-sm font-semibold text-foreground mb-2">Full Name *</label>
                <input type="text" name="name" value={form.name} onChange={handleChange} placeholder="Your name" required className={inputCls} />
              </div>
              <div>
                <label className="block text-sm font-semibold text-foreground mb-2">Email Address *</label>
                <input type="email" name="email" value={form.email} onChange={handleChange} placeholder="your@email.com" required className={inputCls} />
              </div>
              <div>
                <label className="block text-sm font-semibold text-foreground mb-2">Phone Number *</label>
                <input type="tel" name="phone" value={form.phone} onChange={handleChange} placeholder="+91 98765 43210" required className={inputCls} />
              </div>
              <div>
                <label className="block text-sm font-semibold text-foreground mb-2">Donation Amount (₹) *</label>
                <input type="number" name="amount" value={form.amount} onChange={handleChange} placeholder="Enter amount" min="10" required className={inputCls} />
              </div>
            </div>

            <div>
              <label className="block text-sm font-semibold text-foreground mb-2">Notes / Message</label>
              <textarea name="message" value={form.message} onChange={handleChange} placeholder="Anything else you'd like to tell us?" rows={3} className={`${inputCls} resize-none`} />
            </div>

            <div className="pt-4 border-t border-border">
              <h3 className="text-xl font-heading text-foreground mb-5 flex items-center gap-2">
                <QrCode className="h-5 w-5 text-amber-500" />
                Payment Method
              </h3>
              
              <div className="mb-6">
                <label className="block text-sm font-semibold text-foreground mb-2">Select Payment Method *</label>
                <select name="payment_method" value={form.payment_method} onChange={handleChange} required className={inputCls}>
                  <option value="">Select Method</option>
                  <option value="UPI">UPI</option>
                  <option value="Bank Transfer">Bank Transfer</option>
                </select>
              </div>

              <AnimatePresence mode="wait">
                {form.payment_method === "UPI" && (
                  <motion.div key="upi" initial={{ opacity: 0, y: 10 }} animate={{ opacity: 1, y: 0 }} exit={{ opacity: 0, y: -10 }} className="space-y-6 p-6 bg-muted/30 rounded-2xl border border-border">
                    <div className="flex flex-col items-center text-center space-y-4">
                      <div className="p-3 bg-white rounded-2xl shadow-xl border border-amber-100">
                        <img src={paymentQr} alt="UPI QR Code" className="w-48 h-48 object-contain" />
                      </div>
                      <div>
                        <p className="text-lg font-bold text-foreground">Scan and pay using UPI</p>
                        <p className="text-sm text-muted-foreground mt-1">Scan the QR code above with any UPI app</p>
                      </div>
                    </div>
                    
                    <div>
                      <label className="block text-sm font-semibold text-foreground mb-2 flex items-center gap-2">
                        <Upload className="h-4 w-4 text-amber-500" />
                        Upload UPI Payment Screenshot *
                      </label>
                      <input type="file" accept="image/*" onChange={(e) => setScreenshot(e.target.files[0])} required className="w-full text-sm text-muted-foreground file:mr-4 file:py-2.5 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-amber-400 file:text-amber-950 hover:file:bg-amber-500 transition-all cursor-pointer" />
                    </div>
                  </motion.div>
                )}

                {form.payment_method === "Bank Transfer" && (
                  <motion.div key="bank" initial={{ opacity: 0, y: 10 }} animate={{ opacity: 1, y: 0 }} exit={{ opacity: 0, y: -10 }} className="space-y-6">
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <div className="p-5 bg-card rounded-xl border border-border shadow-sm space-y-3">
                        <div className="flex items-center gap-2 text-amber-600 font-bold text-xs uppercase tracking-wider mb-1">
                          <Building2 className="h-3.5 w-3.5" />
                          Bank Details
                        </div>
                        <div className="space-y-2 text-sm">
                          <p className="flex justify-between border-b border-border/50 pb-1"><span className="text-muted-foreground">Account Holder:</span> <span className="font-semibold">JM CONSULTANCY SERVICE</span></p>
                          <p className="flex justify-between border-b border-border/50 pb-1"><span className="text-muted-foreground">Account Number:</span> <span className="font-semibold">510909010337909</span></p>
                          <p className="flex justify-between border-b border-border/50 pb-1"><span className="text-muted-foreground">IFSC Code:</span> <span className="font-semibold">CIUB0000006</span></p>
                        </div>
                      </div>
                      <div className="p-5 bg-card rounded-xl border border-border shadow-sm space-y-3">
                        <div className="h-4" /> {/* Spacer */}
                        <div className="space-y-2 text-sm">
                          <p className="flex justify-between border-b border-border/50 pb-1"><span className="text-muted-foreground">Bank:</span> <span className="font-semibold">CITY UNION BANK</span></p>
                          <p className="flex justify-between border-b border-border/50 pb-1"><span className="text-muted-foreground">Branch:</span> <span className="font-semibold">NAGAPATTINAM</span></p>
                          <p className="flex justify-between border-b border-border/50 pb-1"><span className="text-muted-foreground">Account Type:</span> <span className="font-semibold">CURRENT ACCOUNT</span></p>
                        </div>
                      </div>
                    </div>

                    <div className="space-y-4 p-6 bg-muted/30 rounded-2xl border border-border">
                      <div>
                        <label className="block text-sm font-semibold text-foreground mb-2">Transaction ID / Reference Number *</label>
                        <input type="text" name="transaction_id" value={form.transaction_id} onChange={handleChange} required className={inputCls} placeholder="Enter your transaction ID" />
                      </div>
                      <div>
                        <label className="block text-sm font-semibold text-foreground mb-2 flex items-center gap-2">
                          <Upload className="h-4 w-4 text-amber-500" />
                          Upload Bank Screenshot *
                        </label>
                        <input type="file" accept="image/*" onChange={(e) => setScreenshot(e.target.files[0])} required className="w-full text-sm text-muted-foreground file:mr-4 file:py-2.5 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-amber-400 file:text-amber-950 hover:file:bg-amber-500 transition-all cursor-pointer" />
                      </div>
                    </div>
                  </motion.div>
                )}
              </AnimatePresence>
            </div>

            <motion.button type="submit" disabled={isSubmitting} whileHover={{ scale: 1.02 }} whileTap={{ scale: 0.98 }}
              className={`w-full bg-gradient-to-r from-amber-400 to-amber-500 text-amber-950 py-4 rounded-full font-bold text-lg transition-all flex items-center justify-center gap-2 mt-4 ${isSubmitting ? "opacity-70 cursor-not-allowed" : "hover:shadow-gold"}`}>
              {isSubmitting ? "Processing Submission..." : <><Heart className="h-5 w-5 fill-amber-950" /> Complete Donation</>}
            </motion.button>
          </motion.form>
        </div>
      </section>
    </div>
  );
};

export default Donate;
