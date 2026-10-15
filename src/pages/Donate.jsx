import { motion, AnimatePresence } from "framer-motion";
import { 
  Heart, 
  BookOpen, 
  Users, 
  Check, 
  Sparkles, 
  Upload, 
  QrCode, 
  Building2, 
  ShieldCheck, 
  Lock, 
  Receipt, 
  Copy, 
  CheckCheck, 
  FileText, 
  ChevronDown, 
  PieChart, 
  Trees, 
  HelpCircle, 
  HeartHandshake, 
  X, 
  ArrowRight,
  TrendingUp,
  FileCheck2,
  CheckCircle2
} from "lucide-react";
import SectionHeading from "@/components/SectionHeading";
import HeroBackground from "@/components/HeroBackground";
import MarqueeRibbon from "@/components/MarqueeRibbon";
import { GlowCard } from "@/components/AnimationEffects";
import { useState, useEffect } from "react";
import { toast } from "sonner";
import paymentQr from "@/assets/paymentqr/payment-qr.jpeg";
import { API_BASE_URL, API_ENDPOINTS } from "@/config/api";

const tierIcons = [<BookOpen className="h-6 w-6" />, <Users className="h-6 w-6" />, <Heart className="h-6 w-6" />, <Trees className="h-6 w-6" />];
const tierGradients = ["from-rose-400 to-pink-500", "from-amber-400 to-orange-500", "from-emerald-400 to-teal-500", "from-cyan-400 to-blue-500"];

const defaultTiers = [
  { 
    amount: "₹500", 
    value: "500", 
    title: "Student Learning Kit", 
    desc: "Provides books, notebooks, and essential school kit for a deserving student.", 
    impact: "1 Child Educated",
    featured: false 
  },
  { 
    amount: "₹1,000", 
    value: "1000", 
    title: "Youth Skill & Exam Prep", 
    desc: "Sponsors competitive exam materials & digital career skills coaching.", 
    impact: "Youth Career Boost",
    featured: true 
  },
  { 
    amount: "₹2,500", 
    value: "2500", 
    title: "Family Health & Nutrition", 
    desc: "Supports free medical screening, wellness kits, and health camps in rural areas.", 
    impact: "Whole Family Wellness",
    featured: false 
  },
  { 
    amount: "₹5,000", 
    value: "5000", 
    title: "Green Habitat & Community Drive", 
    desc: "Funds 10 indigenous sapling plantation, tree guards, and sparrow conservation boxes.", 
    impact: "10 Trees & Ecosystem",
    featured: false 
  },
];

const defaultQuickAmounts = ["500", "1000", "2500", "5000", "10000"];

const trustBadges = [
  { icon: ShieldCheck, title: "100% Tax Deductible", desc: "Registered NGO with 80G eligibility" },
  { icon: Lock, title: "Bank-Grade Security", desc: "Direct verified trust account & UPI" },
  { icon: Receipt, title: "Instant Receipt", desc: "Proof sent to your email & WhatsApp" },
  { icon: HeartHandshake, title: "Zero Middlemen", desc: "100% directly reaches grassroots beneficiaries" },
];

const defaultFaqs = [
  {
    q: "How will my donation be utilized?",
    a: "Every rupee you donate is deployed transparently into on-the-ground programs: distributing free books and study kits to rural students, organizing free medical checkups, and planting trees across Tamil Nadu. We allocate 85%+ directly to active field operations."
  },
  {
    q: "Can I make a donation via Google Pay, PhonePe, or Paytm?",
    a: "Yes! Simply select the 'UPI / QR Code' payment method on the form below, scan our verified Lumina Trust QR code using any UPI app (GPay, PhonePe, Paytm, BHIM, or mobile banking), and upload your transaction screenshot."
  },
  {
    q: "How will I receive confirmation and receipt?",
    a: "Once you upload your transaction details and screenshot, our verification team validates the transaction and issues an acknowledgment receipt directly to your registered email address."
  },
  {
    q: "Can I donate directly through Net Banking / NEFT / IMPS?",
    a: "Yes! Select the 'Bank Transfer' option to view our official Bank of India Current Account details. You can easily transfer funds and submit the Transaction / UTR reference number."
  },
  {
    q: "Can I dedicate my donation in memory or celebration of someone?",
    a: "Absolutely. You can mention birthdays, anniversaries, or commemorative notes in the 'Notes / Message' field in the donation form, and our team will dedicate that day's distribution in their honor."
  }
];

const inputCls = "w-full px-4 py-3.5 rounded-xl border border-border bg-background text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-amber-400/50 focus:border-amber-400 transition-all text-sm";

const toBase64 = (file) => new Promise((resolve, reject) => {
  const reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onload = () => resolve(reader.result);
  reader.onerror = error => reject(error);
});

const Donate = () => {
  const [donateData, setDonateData] = useState(null);

  useEffect(() => {
    fetch(API_ENDPOINTS.DONATE)
      .then((res) => {
        if (!res.ok) throw new Error("Failed to load donate page data");
        return res.json();
      })
      .then((data) => {
        if (data && typeof data === "object") {
          setDonateData(data);
        }
      })
      .catch((err) => {
        console.log("Using fallback donate data:", err);
      });
  }, []);

  const tiers = (donateData?.tiers && Array.isArray(donateData.tiers) && donateData.tiers.length > 0)
    ? donateData.tiers
    : defaultTiers;

  const quickAmounts = donateData?.quick_amounts
    ? donateData.quick_amounts.split(',').map(s => s.trim()).filter(Boolean)
    : defaultQuickAmounts;

  const faqs = (donateData?.faqs && Array.isArray(donateData.faqs) && donateData.faqs.length > 0)
    ? donateData.faqs
    : defaultFaqs;

  const isUpiEnabled = donateData ? donateData.enable_upi !== false : true;
  const isBankEnabled = donateData ? donateData.enable_bank_transfer !== false : true;

  const upiId = donateData?.upi_id || "luminatrust@boi";
  const upiName = donateData?.upi_name || "LUMINA TRUST";
  const bankHolder = donateData?.bank_account_holder || "LUMINA TRUST";
  const bankNumber = donateData?.bank_account_number || "813210210000050";
  const bankIfsc = donateData?.bank_ifsc || "BKID0008132";
  const bankName = donateData?.bank_name || "BANK OF INDIA";
  const bankBranch = donateData?.bank_branch || "NAGAPATTINAM";
  const bankAccountType = donateData?.bank_account_type || "CURRENT ACCOUNT";

  const qrCodeImage = donateData?.upi_qr_code_url || (donateData?.upi_qr_code ? `${API_BASE_URL}/storage/${donateData.upi_qr_code}` : paymentQr);

  const [selectedTier, setSelectedTier] = useState("1000");
  const [donationFrequency, setDonationFrequency] = useState("one-time"); // 'one-time' | 'monthly'
  const [activeFaq, setActiveFaq] = useState(null);
  const [copiedKey, setCopiedKey] = useState(null);
  const [submittedData, setSubmittedData] = useState(null);

  const [form, setForm] = useState({ 
    name: "", 
    email: "", 
    phone: "", 
    amount: "1000", 
    payment_method: isUpiEnabled ? "UPI" : "Bank Transfer", 
    transaction_id: "",
    message: "" 
  });
  const [screenshot, setScreenshot] = useState(null);
  const [isSubmitting, setIsSubmitting] = useState(false);

  useEffect(() => {
    if (!isUpiEnabled && form.payment_method === "UPI" && isBankEnabled) {
      setForm(prev => ({ ...prev, payment_method: "Bank Transfer" }));
    } else if (!isBankEnabled && form.payment_method === "Bank Transfer" && isUpiEnabled) {
      setForm(prev => ({ ...prev, payment_method: "UPI" }));
    }
  }, [isUpiEnabled, isBankEnabled]);

  const handleTierSelect = (tier) => { 
    setSelectedTier(tier.value); 
    setForm(prev => ({ ...prev, amount: tier.value })); 
  };

  const handleQuickAmount = (val) => {
    setSelectedTier(val);
    setForm(prev => ({ ...prev, amount: val }));
  };

  const copyToClipboard = (text, key) => {
    navigator.clipboard.writeText(text);
    setCopiedKey(key);
    toast.success(`${key} copied to clipboard!`);
    setTimeout(() => setCopiedKey(null), 2000);
  };
  
  const handleSubmit = async (e) => { 
    e.preventDefault(); 
    if (!screenshot) {
      toast.error("Please upload a payment screenshot.");
      return;
    }
    setIsSubmitting(true);
    
    try {
      const formData = new FormData();
      formData.append("name", form.name);
      formData.append("email", form.email);
      formData.append("phone", form.phone);
      formData.append("amount", form.amount);
      formData.append("payment_method", form.payment_method);
      formData.append("transaction_id", form.transaction_id);
      formData.append("message", form.message);
      formData.append("frequency", donationFrequency);
      formData.append("screenshot", screenshot);

      const response = await fetch(API_ENDPOINTS.DONATIONS, {
        method: "POST",
        body: formData,
      });

      const result = await response.json();

      if (response.ok && (result.success || result.donation)) {
        toast.success(result.message || "Thank you! Your donation details have been submitted. 💛");
        setSubmittedData({ ...form, frequency: donationFrequency });
        setForm({ name: "", email: "", phone: "", amount: "1000", payment_method: "UPI", transaction_id: "", message: "" }); 
        setScreenshot(null);
        setSelectedTier(null);
      } else {
        toast.error(result.message || "Failed to submit donation. Please try again.");
      }
    } catch (error) {
      toast.error("Failed to connect to donation server. Please try again later.");
      console.error("Donation Error:", error);
    } finally {
      setIsSubmitting(false);
    }
  };
  
  const handleChange = (e) => setForm({ ...form, [e.target.name]: e.target.value });

  return (
    <div className="overflow-hidden">
      {/* ── 1. EXACT ORIGINAL HEADER / HERO (UNCHANGED) ── */}
      <section className="relative pt-32 pb-16 sm:pt-40 sm:pb-24 md:py-48 overflow-hidden bg-slate-950">
        <HeroBackground />
        <div className="site-container text-center relative z-10">
          <motion.div initial={{ opacity: 0, y: 30 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.7 }}>
            <motion.div initial={{ scale: 0 }} animate={{ scale: 1 }} transition={{ delay: 0.2, type: "spring" }} className="inline-flex items-center gap-2 glass rounded-full px-4 sm:px-5 py-1.5 sm:py-2 mb-4 sm:mb-6">
              <Sparkles className="h-3.5 w-3.5 text-amber-400" />
              <span className="text-amber-300 font-bold text-xs uppercase tracking-[0.2em]">{donateData?.hero_badge || "Support Us"}</span>
            </motion.div>
            <h1 className="font-heading text-3xl sm:text-5xl md:text-6xl lg:text-7xl text-white mt-2 sm:mt-4 leading-[1.1]">
              {donateData?.hero_title ? (
                <span>{donateData.hero_title}</span>
              ) : (
                <>Donate <span className="text-amber-400">Today</span></>
              )}
            </h1>
            <motion.p initial={{ opacity: 0 }} animate={{ opacity: 1 }} transition={{ delay: 0.4 }} className="text-white/60 mt-4 sm:mt-6 max-w-2xl mx-auto text-sm sm:text-lg">
              {donateData?.hero_description || "Be the reason someone smiles today. Donate now and create lasting impact."}
            </motion.p>
          </motion.div>
        </div>
      </section>

      {/* ── LIVE MARQUEE IMPACT BANNER ── */}
      <MarqueeRibbon />

      {/* ── 2. TRUST & ASSURANCE STRIP ── */}
      <section className="bg-slate-900 border-y border-white/10 py-8 relative">
        <div className="site-container">
          <div className="grid grid-cols-2 lg:grid-cols-4 gap-5 md:gap-8">
            {trustBadges.map((badge, idx) => {
              const Icon = badge.icon;
              return (
                <motion.div 
                  key={idx}
                  initial={{ opacity: 0, y: 15 }}
                  whileInView={{ opacity: 1, y: 0 }}
                  viewport={{ once: true }}
                  transition={{ delay: idx * 0.1 }}
                  className="flex items-center gap-3 sm:gap-4 p-3 sm:p-4 rounded-2xl bg-white/5 border border-white/10"
                >
                  <div className="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-amber-400/15 border border-amber-400/30 flex items-center justify-center text-amber-400 shrink-0">
                    <Icon className="h-5 w-5 sm:h-6 sm:w-6" />
                  </div>
                  <div>
                    <h4 className="text-xs sm:text-sm font-bold text-white leading-tight">{badge.title}</h4>
                    <p className="text-[10px] sm:text-xs text-white/60 mt-0.5 leading-tight">{idx === 0 && donateData?.tax_exemption_note ? donateData.tax_exemption_note : badge.desc}</p>
                  </div>
                </motion.div>
              );
            })}
          </div>
        </div>
      </section>

      {/* ── 3. INTERACTIVE IMPACT TIERS & FREQUENCY TOGGLE ── */}
      <section className="py-14 sm:py-20 md:py-28 bg-warm">
        <div className="site-container">
          <SectionHeading 
            subtitle="Why Your Donation Matters" 
            title="Choose Your Giving Impact" 
            description="Every contribution fuels concrete grassroots actions: educational kits, skill workshops, free medical camps, and environmental greening." 
          />

          {/* Animated Frequency Switcher */}
          <div className="flex justify-center mb-10">
            <div className="bg-card p-1.5 rounded-full border border-border shadow-sm flex items-center gap-1 relative">
              <button
                type="button"
                onClick={() => setDonationFrequency("one-time")}
                className={`px-5 sm:px-7 py-2 rounded-full text-xs sm:text-sm font-bold transition-all relative z-10 ${donationFrequency === "one-time" ? "text-amber-950 font-extrabold" : "text-muted-foreground hover:text-foreground"}`}
              >
                {donationFrequency === "one-time" && (
                  <motion.div
                    layoutId="freqPill"
                    className="absolute inset-0 bg-amber-400 rounded-full shadow-md -z-10"
                    transition={{ type: "spring", stiffness: 400, damping: 30 }}
                  />
                )}
                One-Time Gift
              </button>

              <button
                type="button"
                onClick={() => setDonationFrequency("monthly")}
                className={`px-5 sm:px-7 py-2 rounded-full text-xs sm:text-sm font-bold transition-all relative z-10 flex items-center gap-1.5 ${donationFrequency === "monthly" ? "text-amber-950 font-extrabold" : "text-muted-foreground hover:text-foreground"}`}
              >
                {donationFrequency === "monthly" && (
                  <motion.div
                    layoutId="freqPill"
                    className="absolute inset-0 bg-amber-400 rounded-full shadow-md -z-10"
                    transition={{ type: "spring", stiffness: 400, damping: 30 }}
                  />
                )}
                <span>Monthly Changemaker</span>
                <span className="bg-emerald-700 text-white text-[9px] px-2 py-0.5 rounded-full uppercase tracking-wider font-extrabold">Popular</span>
              </button>
            </div>
          </div>

          {/* 4 Cards Grid */}
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">
            {tiers.map((t, i) => {
              const tierVal = String(t.value || t.amount || '').replace(/[^0-9]/g, '') || "500";
              const isSelected = selectedTier === tierVal;
              return (
                <motion.div 
                  key={i} 
                  initial={{ opacity: 0, y: 25 }} 
                  whileInView={{ opacity: 1, y: 0 }} 
                  viewport={{ once: true }} 
                  transition={{ delay: i * 0.1 }}
                >
                  <GlowCard>
                    <motion.button 
                      onClick={() => handleTierSelect({ ...t, value: tierVal })} 
                      whileHover={{ y: -6, scale: 1.01 }} 
                      whileTap={{ scale: 0.98 }}
                      className={`bg-card rounded-2xl p-5 sm:p-6 shadow-ngo text-center w-full relative overflow-hidden transition-all duration-300 h-full flex flex-col justify-between border ${isSelected ? "ring-2 ring-amber-400 border-amber-400 shadow-gold" : "border-border/60 hover:shadow-card-hover"} ${t.featured ? "ring-1 ring-amber-300/60" : ""}`}
                    >
                      {t.featured && (
                        <div className="absolute top-3 left-1/2 -translate-x-1/2 bg-amber-400 text-amber-950 text-[10px] font-extrabold uppercase tracking-widest px-3 py-0.5 rounded-full whitespace-nowrap shadow-xs">
                          Most Chosen
                        </div>
                      )}
                      
                      <AnimatePresence>
                        {isSelected && (
                          <motion.div 
                            initial={{ scale: 0 }} 
                            animate={{ scale: 1 }} 
                            exit={{ scale: 0 }} 
                            className="absolute top-3 right-3 bg-amber-400 rounded-full p-1 shadow-sm"
                          >
                            <Check className="h-3.5 w-3.5 text-amber-950 stroke-[3]" />
                          </motion.div>
                        )}
                      </AnimatePresence>

                      <div>
                        <div className={`inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-gradient-to-br ${t.gradient || tierGradients[i % tierGradients.length]} text-white mb-3 shadow-md mt-4`}>
                          {t.icon || tierIcons[i % tierIcons.length]}
                        </div>
                        <div className="font-heading text-3xl font-extrabold text-foreground mb-1">
                          {t.amount}
                          {donationFrequency === "monthly" && <span className="text-xs font-normal text-muted-foreground">/mo</span>}
                        </div>
                        <h4 className="font-heading text-base font-bold text-foreground mb-2">{t.title}</h4>
                        <p className="text-xs text-muted-foreground leading-relaxed mb-4">{t.desc}</p>
                      </div>

                      <div className="pt-3 border-t border-border/60 w-full">
                        <span className="inline-flex items-center gap-1.5 text-[11px] font-bold text-emerald-600 dark:text-emerald-400">
                          <CheckCircle2 className="h-3 w-3" />
                          {t.impact}
                        </span>
                      </div>
                    </motion.button>
                  </GlowCard>
                </motion.div>
              );
            })}
          </div>

          {/* Quick Amount Selector Chips */}
          <div className="mt-8 pt-6 border-t border-border/60 flex flex-wrap items-center justify-center gap-2 sm:gap-3 text-center">
            <span className="text-xs font-semibold text-muted-foreground mr-1">Quick Amount:</span>
            {quickAmounts.map((amt) => (
              <button
                key={amt}
                type="button"
                onClick={() => handleQuickAmount(amt)}
                className={`px-3.5 sm:px-4 py-1.5 rounded-full text-xs font-bold transition-all ${selectedTier === amt ? "bg-amber-400 text-amber-950 shadow-sm" : "bg-card border border-border text-foreground hover:bg-muted"}`}
              >
                ₹{Number(amt).toLocaleString()}
              </button>
            ))}
          </div>
        </div>
      </section>

      {/* ── 4. ANIMATED DONATION FORM SECTION ── */}
      <section className="py-14 sm:py-20 md:py-28 relative">
        <div className="site-container-narrow">
          <SectionHeading 
            subtitle="Complete Your Contribution" 
            title="Safe & Simple Donation Form" 
            description="Fill in your details below and complete your donation using your preferred payment method." 
          />

          <motion.form 
            onSubmit={handleSubmit} 
            initial={{ opacity: 0, y: 30 }} 
            whileInView={{ opacity: 1, y: 0 }} 
            viewport={{ once: true }} 
            className="space-y-7 bg-card p-5 sm:p-8 md:p-10 rounded-3xl shadow-ngo border-t-4 border-amber-400 relative overflow-hidden"
          >
            {/* Header Accent Pill */}
            <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-5 border-b border-border/60">
              <div>
                <span className="text-xs font-bold uppercase tracking-wider text-amber-500">Step 1 of 2</span>
                <h3 className="font-heading text-xl sm:text-2xl font-bold text-foreground">Donor Information</h3>
              </div>
              <div className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 text-xs font-bold w-max">
                <Lock className="h-3 w-3" /> 256-Bit SSL Encrypted
              </div>
            </div>

            {/* Donor Fields Grid */}
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">
              <motion.div whileFocus={{ scale: 1.01 }}>
                <label className="block text-xs font-bold uppercase tracking-wider text-foreground mb-2">
                  Full Name *
                </label>
                <input 
                  type="text" 
                  name="name" 
                  value={form.name} 
                  onChange={handleChange} 
                  placeholder="e.g. Ramesh Kumar" 
                  required 
                  className={inputCls} 
                />
              </motion.div>

              <motion.div whileFocus={{ scale: 1.01 }}>
                <label className="block text-xs font-bold uppercase tracking-wider text-foreground mb-2">
                  Email Address *
                </label>
                <input 
                  type="email" 
                  name="email" 
                  value={form.email} 
                  onChange={handleChange} 
                  placeholder="ramesh@example.com" 
                  required 
                  className={inputCls} 
                />
              </motion.div>

              <motion.div whileFocus={{ scale: 1.01 }}>
                <label className="block text-xs font-bold uppercase tracking-wider text-foreground mb-2">
                  WhatsApp / Phone Number *
                </label>
                <input 
                  type="tel" 
                  name="phone" 
                  value={form.phone} 
                  onChange={handleChange} 
                  placeholder="+91 98765 43210" 
                  required 
                  className={inputCls} 
                />
              </motion.div>

              <motion.div whileFocus={{ scale: 1.01 }}>
                <label className="block text-xs font-bold uppercase tracking-wider text-foreground mb-2 flex items-center justify-between">
                  <span>Donation Amount (₹) *</span>
                  <span className="text-amber-500 normal-case font-semibold text-[11px]">{donationFrequency === "monthly" ? "Monthly" : "One-Time"}</span>
                </label>
                <div className="relative">
                  <span className="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground font-bold">₹</span>
                  <input 
                    type="number" 
                    name="amount" 
                    value={form.amount} 
                    onChange={handleChange} 
                    placeholder="Enter custom amount" 
                    min="10" 
                    required 
                    className={`${inputCls} pl-8 font-bold text-base`} 
                  />
                </div>
              </motion.div>
            </div>

            <div>
              <label className="block text-xs font-bold uppercase tracking-wider text-foreground mb-2">
                Dedication / Personal Message (Optional)
              </label>
              <textarea 
                name="message" 
                value={form.message} 
                onChange={handleChange} 
                placeholder="In honor of someone, birthday wishes, or encouragement for students..." 
                rows={2} 
                className={`${inputCls} resize-none`} 
              />
            </div>

            {/* STEP 2: PAYMENT METHOD */}
            <div className="pt-6 border-t border-border/80">
              <div className="flex items-center justify-between mb-4">
                <div>
                  <span className="text-xs font-bold uppercase tracking-wider text-amber-500">Step 2 of 2</span>
                  <h3 className="font-heading text-xl sm:text-2xl font-bold text-foreground">Select Payment Mode</h3>
                </div>
              </div>

              {/* Interactive Animated Payment Cards */}
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-3.5 mb-6">
                {isUpiEnabled && (
                  <button
                    type="button"
                    onClick={() => setForm(prev => ({ ...prev, payment_method: "UPI" }))}
                    className={`p-4 rounded-2xl border text-left flex items-center gap-3.5 transition-all relative overflow-hidden ${form.payment_method === "UPI" ? "border-amber-400 bg-amber-400/10 ring-2 ring-amber-400/50 shadow-sm" : "border-border bg-muted/20 hover:border-amber-300"}`}
                  >
                    <div className={`w-10 h-10 rounded-xl flex items-center justify-center shrink-0 ${form.payment_method === "UPI" ? "bg-amber-400 text-amber-950 font-bold" : "bg-muted text-foreground"}`}>
                      <QrCode className="h-5 w-5" />
                    </div>
                    <div className="flex-1">
                      <p className="text-sm font-bold text-foreground">Scan UPI & Pay</p>
                      <p className="text-xs text-muted-foreground">GPay, PhonePe, Paytm, BHIM</p>
                    </div>
                    {form.payment_method === "UPI" && (
                      <div className="w-5 h-5 rounded-full bg-amber-400 flex items-center justify-center text-amber-950">
                        <Check className="h-3.5 w-3.5 stroke-[3]" />
                      </div>
                    )}
                  </button>
                )}

                {isBankEnabled && (
                  <button
                    type="button"
                    onClick={() => setForm(prev => ({ ...prev, payment_method: "Bank Transfer" }))}
                    className={`p-4 rounded-2xl border text-left flex items-center gap-3.5 transition-all relative overflow-hidden ${form.payment_method === "Bank Transfer" ? "border-amber-400 bg-amber-400/10 ring-2 ring-amber-400/50 shadow-sm" : "border-border bg-muted/20 hover:border-amber-300"}`}
                  >
                    <div className={`w-10 h-10 rounded-xl flex items-center justify-center shrink-0 ${form.payment_method === "Bank Transfer" ? "bg-amber-400 text-amber-950 font-bold" : "bg-muted text-foreground"}`}>
                      <Building2 className="h-5 w-5" />
                    </div>
                    <div className="flex-1">
                      <p className="text-sm font-bold text-foreground">Direct Bank Transfer</p>
                      <p className="text-xs text-muted-foreground">NEFT, RTGS, IMPS Account</p>
                    </div>
                    {form.payment_method === "Bank Transfer" && (
                      <div className="w-5 h-5 rounded-full bg-amber-400 flex items-center justify-center text-amber-950">
                        <Check className="h-3.5 w-3.5 stroke-[3]" />
                      </div>
                    )}
                  </button>
                )}
              </div>

              {/* Payment Detail Section with Smooth Transitions */}
              <AnimatePresence mode="wait">
                {isUpiEnabled && form.payment_method === "UPI" && (
                  <motion.div 
                    key="upi" 
                    initial={{ opacity: 0, y: 15 }} 
                    animate={{ opacity: 1, y: 0 }} 
                    exit={{ opacity: 0, y: -15 }} 
                    transition={{ duration: 0.3 }}
                    className="space-y-6 p-4 sm:p-6 bg-slate-50 dark:bg-slate-900/60 rounded-2xl border border-border"
                  >
                    <div className="flex flex-col sm:flex-row items-center gap-6">
                      <div className="p-3 bg-white rounded-2xl shadow-xl border border-amber-200 shrink-0 relative group">
                        <img 
                          src={qrCodeImage} 
                          alt="UPI QR Code" 
                          onError={(e) => { e.currentTarget.src = paymentQr; }}
                          className="w-40 h-40 sm:w-48 sm:h-48 object-contain" 
                        />
                        <span className="absolute bottom-1 left-1/2 -translate-x-1/2 bg-amber-400 text-amber-950 text-[9px] font-extrabold uppercase px-2 py-0.5 rounded-full whitespace-nowrap">
                          Verified Trust QR
                        </span>
                      </div>

                      <div className="space-y-3 text-center sm:text-left flex-1 w-full">
                        <div className="inline-flex items-center gap-2 bg-amber-400/20 text-amber-700 dark:text-amber-300 px-3 py-1 rounded-full text-xs font-bold">
                          <Sparkles className="h-3 w-3" /> Scan with Any UPI App
                        </div>
                        <h4 className="text-lg font-bold text-foreground">{upiName} UPI Payment</h4>
                        <p className="text-xs text-muted-foreground leading-relaxed">
                          Open Google Pay, PhonePe, Paytm or your bank app, scan this QR code, enter ₹{form.amount || "0"}, and make payment.
                        </p>
                        
                        <div className="space-y-2">
                          <div className="p-2.5 rounded-xl bg-card border border-border text-xs flex items-center justify-between gap-2">
                            <span className="text-muted-foreground">UPI ID / VPA:</span>
                            <div className="flex items-center gap-1.5 font-bold font-mono text-emerald-600 dark:text-emerald-400">
                              <span>{upiId}</span>
                              <button 
                                type="button" 
                                onClick={() => copyToClipboard(upiId, "UPI ID")}
                                className="text-amber-500 hover:text-amber-600 p-1"
                                title="Copy UPI ID"
                              >
                                {copiedKey === "UPI ID" ? <CheckCheck className="h-3.5 w-3.5 text-emerald-500" /> : <Copy className="h-3.5 w-3.5" />}
                              </button>
                            </div>
                          </div>

                          <div className="p-2.5 rounded-xl bg-card border border-border text-xs flex items-center justify-between gap-2">
                            <span className="text-muted-foreground">Beneficiary Name:</span>
                            <span className="font-bold text-foreground">{upiName}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    {/* File Upload with Animated Dropzone */}
                    <div className="pt-4 border-t border-border/60">
                      <label className="block text-xs font-bold uppercase tracking-wider text-foreground mb-2 flex items-center justify-between">
                        <span className="flex items-center gap-2">
                          <Upload className="h-4 w-4 text-amber-500" />
                          Upload Payment Screenshot / Receipt *
                        </span>
                        {screenshot && <span className="text-emerald-500 font-semibold normal-case text-xs flex items-center gap-1"><Check className="h-3 w-3" /> File Attached</span>}
                      </label>

                      <div className="relative border-2 border-dashed border-amber-400/40 hover:border-amber-400 rounded-2xl p-4 sm:p-6 text-center bg-card/60 transition-colors cursor-pointer">
                        <input 
                          type="file" 
                          accept="image/*" 
                          onChange={(e) => setScreenshot(e.target.files[0])} 
                          required 
                          className="absolute inset-0 opacity-0 cursor-pointer w-full h-full"
                        />
                        <div className="flex flex-col items-center justify-center space-y-2 pointer-events-none">
                          <div className="w-10 h-10 rounded-full bg-amber-400/15 flex items-center justify-center text-amber-500">
                            <Upload className="h-5 w-5" />
                          </div>
                          {screenshot ? (
                            <div>
                              <p className="text-sm font-bold text-foreground">{screenshot.name}</p>
                              <p className="text-xs text-muted-foreground">{(screenshot.size / 1024).toFixed(1)} KB – Click to change file</p>
                            </div>
                          ) : (
                            <div>
                              <p className="text-sm font-semibold text-foreground">Click or Drag screenshot here to upload</p>
                              <p className="text-xs text-muted-foreground mt-0.5">Supports JPG, PNG, WEBP from your device</p>
                            </div>
                          )}
                        </div>
                      </div>
                    </div>
                  </motion.div>
                )}

                {isBankEnabled && form.payment_method === "Bank Transfer" && (
                  <motion.div 
                    key="bank" 
                    initial={{ opacity: 0, y: 15 }} 
                    animate={{ opacity: 1, y: 0 }} 
                    exit={{ opacity: 0, y: -15 }} 
                    transition={{ duration: 0.3 }}
                    className="space-y-6"
                  >
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                      {/* Card 1 */}
                      <div className="p-4 sm:p-5 bg-card rounded-2xl border border-border shadow-xs space-y-3">
                        <div className="flex items-center justify-between">
                          <span className="flex items-center gap-2 text-amber-600 dark:text-amber-400 font-bold text-xs uppercase tracking-wider">
                            <Building2 className="h-4 w-4" /> Account Details
                          </span>
                          <span className="text-[10px] bg-amber-400/20 text-amber-800 dark:text-amber-300 font-bold px-2 py-0.5 rounded-full">Primary</span>
                        </div>
                        
                        <div className="space-y-2.5 text-xs sm:text-sm">
                          <div className="flex items-center justify-between border-b border-border/50 pb-2">
                            <span className="text-muted-foreground">Account Holder:</span>
                            <div className="flex items-center gap-1.5 font-bold">
                              <span>{bankHolder}</span>
                              <button 
                                type="button" 
                                onClick={() => copyToClipboard(bankHolder, "Account Holder")}
                                className="text-amber-500 hover:text-amber-600 p-1"
                                title="Copy"
                              >
                                {copiedKey === "Account Holder" ? <CheckCheck className="h-3.5 w-3.5 text-emerald-500" /> : <Copy className="h-3.5 w-3.5" />}
                              </button>
                            </div>
                          </div>

                          <div className="flex items-center justify-between border-b border-border/50 pb-2">
                            <span className="text-muted-foreground">Account Number:</span>
                            <div className="flex items-center gap-1.5 font-bold font-mono text-emerald-600 dark:text-emerald-400">
                              <span>{bankNumber}</span>
                              <button 
                                type="button" 
                                onClick={() => copyToClipboard(bankNumber, "Account Number")}
                                className="text-amber-500 hover:text-amber-600 p-1"
                                title="Copy"
                              >
                                {copiedKey === "Account Number" ? <CheckCheck className="h-3.5 w-3.5 text-emerald-500" /> : <Copy className="h-3.5 w-3.5" />}
                              </button>
                            </div>
                          </div>

                          <div className="flex items-center justify-between">
                            <span className="text-muted-foreground">IFSC Code:</span>
                            <div className="flex items-center gap-1.5 font-bold font-mono text-amber-600 dark:text-amber-400">
                              <span>{bankIfsc}</span>
                              <button 
                                type="button" 
                                onClick={() => copyToClipboard(bankIfsc, "IFSC Code")}
                                className="text-amber-500 hover:text-amber-600 p-1"
                                title="Copy"
                              >
                                {copiedKey === "IFSC Code" ? <CheckCheck className="h-3.5 w-3.5 text-emerald-500" /> : <Copy className="h-3.5 w-3.5" />}
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>

                      {/* Card 2 */}
                      <div className="p-4 sm:p-5 bg-card rounded-2xl border border-border shadow-xs space-y-3">
                        <div className="flex items-center justify-between">
                          <span className="flex items-center gap-2 text-cyan-600 dark:text-cyan-400 font-bold text-xs uppercase tracking-wider">
                            <Building2 className="h-4 w-4" /> Bank Branch
                          </span>
                          <span className="text-[10px] bg-cyan-400/20 text-cyan-800 dark:text-cyan-300 font-bold px-2 py-0.5 rounded-full">{bankBranch}</span>
                        </div>

                        <div className="space-y-2.5 text-xs sm:text-sm">
                          <div className="flex items-center justify-between border-b border-border/50 pb-2">
                            <span className="text-muted-foreground">Bank Name:</span>
                            <span className="font-semibold text-foreground">{bankName}</span>
                          </div>
                          <div className="flex items-center justify-between border-b border-border/50 pb-2">
                            <span className="text-muted-foreground">Branch:</span>
                            <span className="font-semibold text-foreground">{bankBranch}</span>
                          </div>
                          <div className="flex items-center justify-between">
                            <span className="text-muted-foreground">Account Type:</span>
                            <span className="font-semibold text-foreground">{bankAccountType}</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    {/* UTR Input & Screenshot */}
                    <div className="space-y-4 p-4 sm:p-6 bg-slate-50 dark:bg-slate-900/60 rounded-2xl border border-border">
                      <div>
                        <label className="block text-xs font-bold uppercase tracking-wider text-foreground mb-2">
                          Bank UTR / Transaction ID / Reference Number *
                        </label>
                        <input 
                          type="text" 
                          name="transaction_id" 
                          value={form.transaction_id} 
                          onChange={handleChange} 
                          required 
                          className={inputCls} 
                          placeholder="e.g. 12-digit UTR number or bank ref" 
                        />
                      </div>

                      <div>
                        <label className="block text-xs font-bold uppercase tracking-wider text-foreground mb-2 flex items-center justify-between">
                          <span className="flex items-center gap-2">
                            <Upload className="h-4 w-4 text-amber-500" />
                            Upload Transfer Receipt / Screenshot *
                          </span>
                          {screenshot && <span className="text-emerald-500 font-semibold normal-case text-xs flex items-center gap-1"><Check className="h-3 w-3" /> File Attached</span>}
                        </label>
                        
                        <div className="relative border-2 border-dashed border-amber-400/40 hover:border-amber-400 rounded-2xl p-4 sm:p-6 text-center bg-card/60 transition-colors cursor-pointer">
                          <input 
                            type="file" 
                            accept="image/*" 
                            onChange={(e) => setScreenshot(e.target.files[0])} 
                            required 
                            className="absolute inset-0 opacity-0 cursor-pointer w-full h-full"
                          />
                          <div className="flex flex-col items-center justify-center space-y-2 pointer-events-none">
                            <div className="w-10 h-10 rounded-full bg-amber-400/15 flex items-center justify-center text-amber-500">
                              <Upload className="h-5 w-5" />
                            </div>
                            {screenshot ? (
                              <div>
                                <p className="text-sm font-bold text-foreground">{screenshot.name}</p>
                                <p className="text-xs text-muted-foreground">{(screenshot.size / 1024).toFixed(1)} KB – Click to change file</p>
                              </div>
                            ) : (
                              <div>
                                <p className="text-sm font-semibold text-foreground">Click or Drag receipt here to upload</p>
                                <p className="text-xs text-muted-foreground mt-0.5">Supports JPG, PNG, WEBP from your device</p>
                              </div>
                            )}
                          </div>
                        </div>
                      </div>
                    </div>
                  </motion.div>
                )}
              </AnimatePresence>
            </div>

            {/* Submit Button with Dynamic Label & Animated Pulses */}
            <motion.button 
              type="submit" 
              disabled={isSubmitting} 
              whileHover={{ scale: 1.01 }} 
              whileTap={{ scale: 0.99 }}
              className={`w-full bg-gradient-to-r from-amber-400 via-amber-500 to-amber-400 bg-[length:200%_auto] text-amber-950 py-4 sm:py-4.5 rounded-full font-extrabold text-base sm:text-lg transition-all flex items-center justify-center gap-2 mt-6 shadow-gold hover:shadow-xl cursor-pointer ${isSubmitting ? "opacity-75 cursor-not-allowed" : ""}`}
            >
              {isSubmitting ? (
                <div className="flex items-center gap-2">
                  <div className="w-5 h-5 border-2 border-amber-950 border-t-transparent rounded-full animate-spin" />
                  <span>Submitting Securely...</span>
                </div>
              ) : (
                <>
                  <motion.div animate={{ scale: [1, 1.25, 1] }} transition={{ repeat: Infinity, duration: 1.8 }}>
                    <Heart className="h-5 w-5 fill-amber-950" />
                  </motion.div>
                  <span>
                    Complete {donationFrequency === "monthly" ? "Monthly" : ""} Donation of ₹{Number(form.amount || 0).toLocaleString()}
                  </span>
                </>
              )}
            </motion.button>
          </motion.form>
        </div>
      </section>

      {/* ── 5. WHERE YOUR DONATION GOES (TRANSPARENCY BREAKDOWN) ── */}
      <section className="py-14 sm:py-20 md:py-24 bg-slate-900 text-white relative overflow-hidden">
        <div className="site-container relative z-10">
          <SectionHeading 
            subtitle="Transparency Promise" 
            title="Where Your Money Goes" 
            description="We honor every contribution with complete financial integrity, rigorous quarterly audits, and maximum grassroots allocation."
            light
          />

          <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
            <div className="p-6 rounded-2xl bg-slate-950/80 border border-white/10 space-y-3">
              <div className="flex items-center justify-between">
                <span className="text-3xl font-heading font-extrabold text-amber-400">85%</span>
                <BookOpen className="h-6 w-6 text-amber-400" />
              </div>
              <h4 className="text-base font-bold text-white">Direct Grassroots Causes</h4>
              <p className="text-xs text-white/60 leading-relaxed">
                Free books distribution, competitive exam kits, school repairs, sparrow boxes, and tree saplings.
              </p>
              <div className="h-2 w-full bg-white/10 rounded-full overflow-hidden">
                <div className="h-full bg-amber-400 rounded-full" style={{ width: "85%" }} />
              </div>
            </div>

            <div className="p-6 rounded-2xl bg-slate-950/80 border border-white/10 space-y-3">
              <div className="flex items-center justify-between">
                <span className="text-3xl font-heading font-extrabold text-emerald-400">10%</span>
                <Heart className="h-6 w-6 text-emerald-400" />
              </div>
              <h4 className="text-base font-bold text-white">Health & Emergency Relief</h4>
              <p className="text-xs text-white/60 leading-relaxed">
                Free health screening camps, doctor kits, disaster aid, and community emergency support drives.
              </p>
              <div className="h-2 w-full bg-white/10 rounded-full overflow-hidden">
                <div className="h-full bg-emerald-400 rounded-full" style={{ width: "10%" }} />
              </div>
            </div>

            <div className="p-6 rounded-2xl bg-slate-950/80 border border-white/10 space-y-3">
              <div className="flex items-center justify-between">
                <span className="text-3xl font-heading font-extrabold text-cyan-400">5%</span>
                <ShieldCheck className="h-6 w-6 text-cyan-400" />
              </div>
              <h4 className="text-base font-bold text-white">Audits & Governance</h4>
              <p className="text-xs text-white/60 leading-relaxed">
                Legal compliance, financial audits, communication, and volunteer coordination.
              </p>
              <div className="h-2 w-full bg-white/10 rounded-full overflow-hidden">
                <div className="h-full bg-cyan-400 rounded-full" style={{ width: "5%" }} />
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* ── 6. DONATION FREQUENTLY ASKED QUESTIONS (ACCORDION) ── */}
      <section className="py-14 sm:py-20 md:py-24 bg-warm">
        <div className="w-full px-4 sm:px-6 md:px-10 max-w-4xl mx-auto">
          <SectionHeading 
            subtitle="Clear Answers" 
            title="Frequently Asked Questions" 
            description="Have questions about making a donation? Here are answers to commonly asked questions." 
          />

          <div className="space-y-3.5 mt-8">
            {faqs.map((faq, index) => {
              const isOpen = activeFaq === index;
              return (
                <div 
                  key={index}
                  className="rounded-2xl border border-border bg-card overflow-hidden shadow-xs transition-colors"
                >
                  <button
                    type="button"
                    onClick={() => setActiveFaq(isOpen ? null : index)}
                    className="w-full p-4 sm:p-5 text-left flex items-center justify-between gap-4 font-heading font-bold text-sm sm:text-base text-foreground"
                  >
                    <span className="flex items-center gap-2.5">
                      <HelpCircle className="h-4 w-4 text-amber-500 shrink-0" />
                      {faq.q}
                    </span>
                    <motion.div animate={{ rotate: isOpen ? 180 : 0 }} transition={{ duration: 0.2 }}>
                      <ChevronDown className="h-4 w-4 text-muted-foreground shrink-0" />
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
                        <div className="px-4 pb-4 sm:px-5 sm:pb-5 pt-1 text-xs sm:text-sm text-muted-foreground leading-relaxed border-t border-border/40">
                          {faq.a}
                        </div>
                      </motion.div>
                    )}
                  </AnimatePresence>
                </div>
              );
            })}
          </div>
        </div>
      </section>

      {/* ── 7. SUCCESS SUBMISSION MODAL ── */}
      <AnimatePresence>
        {submittedData && (
          <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md"
            onClick={() => setSubmittedData(null)}
          >
            <motion.div
              initial={{ scale: 0.9, y: 20 }}
              animate={{ scale: 1, y: 0 }}
              exit={{ scale: 0.9, y: 20 }}
              onClick={(e) => e.stopPropagation()}
              className="bg-card border border-amber-400/40 rounded-3xl p-6 sm:p-8 max-w-md w-full text-center shadow-2xl relative"
            >
              <button 
                onClick={() => setSubmittedData(null)}
                className="absolute top-4 right-4 text-muted-foreground hover:text-foreground p-1 rounded-full"
              >
                <X className="h-5 w-5" />
              </button>

              <div className="w-16 h-16 rounded-full bg-emerald-400/20 text-emerald-500 mx-auto mb-4 flex items-center justify-center">
                <CheckCircle2 className="h-8 w-8 stroke-[2.5]" />
              </div>

              <h3 className="font-heading text-2xl font-bold text-foreground">Thank You, {submittedData.name}!</h3>
              <p className="text-xs sm:text-sm text-muted-foreground mt-2 leading-relaxed">
                Your donation submission of <strong className="text-amber-500 font-extrabold">₹{Number(submittedData.amount).toLocaleString()}</strong> has been safely recorded.
              </p>

              <div className="mt-5 p-4 rounded-xl bg-muted/40 text-xs text-left space-y-1.5 border border-border">
                <p className="flex justify-between"><span className="text-muted-foreground">Mode:</span> <span className="font-bold">{submittedData.payment_method}</span></p>
                <p className="flex justify-between"><span className="text-muted-foreground">Registered Email:</span> <span className="font-bold">{submittedData.email}</span></p>
                <p className="flex justify-between"><span className="text-muted-foreground">Phone:</span> <span className="font-bold">{submittedData.phone}</span></p>
              </div>

              <button
                type="button"
                onClick={() => setSubmittedData(null)}
                className="w-full mt-6 bg-gradient-to-r from-amber-400 to-amber-500 text-amber-950 font-bold py-3 rounded-full text-sm shadow-gold hover:shadow-lg transition-all"
              >
                Close & Return
              </button>
            </motion.div>
          </motion.div>
        )}
      </AnimatePresence>

    </div>
  );
};

export default Donate;
