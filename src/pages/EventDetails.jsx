import { useParams, Link } from "react-router-dom";
import { motion, AnimatePresence } from "framer-motion";
import { useState, useEffect } from "react";
import {
  Calendar,
  Clock,
  MapPin,
  Users,
  CheckCircle,
  ArrowRight,
  Heart,
  Leaf,
  Sparkles,
  Globe,
  TrendingUp,
  X,
  ChevronLeft,
  ChevronRight
} from "lucide-react";
import HeroBackground from "@/components/HeroBackground";
import { eventsData } from "@/data/eventsData";

const categoryColors = {
  Upcoming: "bg-amber-400 text-amber-950",
  Education: "bg-sky-300 text-sky-950",
  Health: "bg-emerald-300 text-emerald-950",
  Water: "bg-purple-300 text-purple-950",
  Environment: "bg-emerald-400 text-emerald-950",
  Completed: "bg-teal-300 text-teal-950",
};

const EventDetails = () => {
  const { id } = useParams();
  const [selectedPhoto, setSelectedPhoto] = useState(null);

  // Find static event by ID or fallback to first event
  const staticFallback = eventsData.find((e) => e.id === id) || eventsData[0];
  const [event, setEvent] = useState(staticFallback);

  useEffect(() => {
    if (!id) return;
    const match = eventsData.find((e) => e.id === id);
    if (match) {
      setEvent(match);
    }
    fetch(`http://localhost:8000/api/activities/${id}`)
      .then((res) => res.json())
      .then((data) => {
        if (data && data.title) {
          setEvent({
            ...data,
            image: data.image && !data.image.includes("unsplash.com") ? data.image : match?.image || data.image || staticFallback.image,
            galleryImages: match?.galleryImages && match.galleryImages.length > 0 ? match.galleryImages : data.galleryImages || [data.image],
            fullDescription: Array.isArray(data.fullDescription) && data.fullDescription.length > 0
              ? data.fullDescription
              : match?.fullDescription || [data.description || staticFallback.shortDescription],
            objectives: data.objectives && data.objectives.length > 0 ? data.objectives : match?.objectives || [],
            highlights: data.highlights && data.highlights.length > 0 ? data.highlights : match?.highlights || [],
            quote: data.quote || match?.quote || "",
          });
        }
      })
      .catch((err) => console.log("Using static event fallback:", err));
  }, [id]);

  const badgeClass = categoryColors[event.category] || "bg-emerald-400 text-emerald-950";

  const navigatePhoto = (dir) => {
    if (selectedPhoto === null || !event.galleryImages || event.galleryImages.length === 0) return;
    setSelectedPhoto((selectedPhoto + dir + event.galleryImages.length) % event.galleryImages.length);
  };

  return (
    <div className="overflow-hidden bg-background">
      {/* ── BREADCRUMBS & HERO ── */}
      <section className="relative py-28 md:py-36 bg-slate-950 overflow-hidden text-white">
        <HeroBackground />
        {/* Background Image with Gradient Overlay */}
        <div className="absolute inset-0 z-0 opacity-40">
          <img src={event.image} alt={event.title} className="w-full h-full object-cover" />
          <div className="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/70 to-slate-950/40" />
        </div>

        <div className="w-full px-6 md:px-10 max-w-7xl mx-auto relative z-10">
          {/* Breadcrumb Trail */}
          <nav className="flex items-center gap-2 text-xs md:text-sm text-white/70 mb-6 font-medium">
            <Link to="/" className="hover:text-amber-400 transition-colors">Home</Link>
            <span>›</span>
            <Link to="/projects" className="hover:text-amber-400 transition-colors">Activities</Link>
            <span>›</span>
            <span className="text-amber-400 truncate max-w-[200px] md:max-w-none">{event.shortTitle || event.title}</span>
          </nav>

          {/* Category Badge */}
          <span className={`inline-block text-[11px] font-extrabold uppercase tracking-widest px-3.5 py-1 rounded-full mb-4 shadow-sm ${badgeClass}`}>
            {event.category}
          </span>

          {/* Main Title */}
          <h1 className="font-heading font-extrabold text-3xl md:text-5xl lg:text-6xl text-white leading-tight mb-4 max-w-4xl">
            {event.title}
          </h1>

          {/* Meta Info Row */}
          <div className="flex flex-wrap items-center gap-6 text-sm text-white/80 font-medium mb-6">
            <div className="flex items-center gap-2">
              <MapPin className="w-4 h-4 text-emerald-400" />
              <span>{event.location}</span>
            </div>
          </div>

          {/* Short Excerpt */}
          <p className="text-white/70 text-base md:text-lg max-w-3xl leading-relaxed">
            {event.shortDescription}
          </p>
        </div>
      </section>

      {/* ── MAIN CONTENT GRID ── */}
      <section className="py-16 md:py-24">
        <div className="w-full px-6 md:px-10 max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12">
          
          {/* LEFT COLUMN: Main Details */}
          <div className="lg:col-span-8 space-y-12">
            
            {/* About the Event */}
            <div className="space-y-4">
              <h2 className="font-heading text-2xl md:text-3xl font-extrabold text-foreground flex items-center gap-2.5">
                <Leaf className="w-6 h-6 text-emerald-600 dark:text-emerald-400 fill-emerald-600/20" />
                About the Event
              </h2>
              <div className="space-y-4 text-muted-foreground leading-relaxed text-sm md:text-base">
                {event.fullDescription.map((para, i) => (
                  <p key={i}>{para}</p>
                ))}
              </div>
            </div>

            {/* Objective Grid / Icons Row */}
            <div className="grid grid-cols-2 sm:grid-cols-4 gap-4 bg-emerald-50/70 dark:bg-emerald-950/20 p-6 rounded-2xl border border-emerald-100 dark:border-emerald-900/50">
              <div className="bg-card p-4 rounded-xl text-center shadow-xs border border-border/40 flex flex-col items-center">
                <div className="w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 flex items-center justify-center mb-2">
                  <Sparkles className="w-5 h-5" />
                </div>
                <span className="text-xs font-bold text-foreground">Raise Awareness</span>
              </div>

              <div className="bg-card p-4 rounded-xl text-center shadow-xs border border-border/40 flex flex-col items-center">
                <div className="w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 flex items-center justify-center mb-2">
                  <Leaf className="w-5 h-5" />
                </div>
                <span className="text-xs font-bold text-foreground">Promote Green Living</span>
              </div>

              <div className="bg-card p-4 rounded-xl text-center shadow-xs border border-border/40 flex flex-col items-center">
                <div className="w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 flex items-center justify-center mb-2">
                  <Users className="w-5 h-5" />
                </div>
                <span className="text-xs font-bold text-foreground">Build Community</span>
              </div>

              <div className="bg-card p-4 rounded-xl text-center shadow-xs border border-border/40 flex flex-col items-center">
                <div className="w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 flex items-center justify-center mb-2">
                  <Globe className="w-5 h-5" />
                </div>
                <span className="text-xs font-bold text-foreground">Support a Cleaner Planet</span>
              </div>
            </div>

            {/* Key Objectives Bulleted List */}
            {event.objectives && event.objectives.length > 0 && (
              <div className="space-y-4">
                <h3 className="font-heading text-xl md:text-2xl font-bold text-foreground">
                  Our Objectives
                </h3>
                <ul className="grid grid-cols-1 md:grid-cols-2 gap-3">
                  {event.objectives.map((obj, i) => (
                    <li key={i} className="flex items-start gap-3 p-3.5 bg-card rounded-xl border border-border/50 text-sm font-medium text-foreground/90">
                      <CheckCircle className="w-4 h-4 text-emerald-600 dark:text-emerald-400 mt-0.5 shrink-0" />
                      <span>{obj}</span>
                    </li>
                  ))}
                </ul>
              </div>
            )}

            {/* Event Highlights */}
            {event.highlights && event.highlights.length > 0 && (
              <div className="space-y-4">
                <h3 className="font-heading text-xl md:text-2xl font-bold text-foreground">
                  Event Highlights
                </h3>
                <ul className="space-y-3">
                  {event.highlights.map((h, i) => (
                    <li key={i} className="flex items-center gap-3 text-sm md:text-base font-medium text-foreground/90">
                      <CheckCircle className="w-5 h-5 text-emerald-600 dark:text-emerald-400 shrink-0" />
                      <span>{h}</span>
                    </li>
                  ))}
                </ul>
              </div>
            )}

            {/* Event Gallery */}
            <div className="space-y-5">
              <h3 className="font-heading text-xl md:text-2xl font-bold text-foreground">
                Event Gallery
              </h3>
              <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
                {event.galleryImages.map((img, i) => (
                  <div
                    key={i}
                    onClick={() => setSelectedPhoto(i)}
                    className="h-44 rounded-2xl overflow-hidden cursor-pointer relative group border border-border/50 shadow-xs"
                  >
                    <img src={img} alt="" className="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    <div className="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold">
                      Click to View
                    </div>
                  </div>
                ))}
              </div>
              <div>
                <Link
                  to="/projects"
                  className="inline-flex items-center gap-2 border border-emerald-700/30 text-emerald-800 dark:text-emerald-300 hover:bg-emerald-700 hover:text-white px-6 py-2.5 rounded-full text-xs font-bold transition-all shadow-xs"
                >
                  View More Photos <ArrowRight className="w-3.5 h-3.5" />
                </Link>
              </div>
            </div>

          </div>

          {/* RIGHT COLUMN: Sidebar Cards */}
          <div className="lg:col-span-4 space-y-6">
            
            {/* Event Details Sidebar Card */}
            <div className="bg-emerald-50/80 dark:bg-emerald-950/30 border border-emerald-200 dark:border-emerald-800 p-6 rounded-2xl space-y-5 shadow-xs">
              <h3 className="font-heading text-xl font-bold text-foreground flex items-center gap-2">
                <Leaf className="w-5 h-5 text-emerald-600 dark:text-emerald-400" />
                Event Details
              </h3>

              <div className="space-y-4 text-xs md:text-sm font-medium text-foreground/90">


                <div className="flex items-start gap-3">
                  <Clock className="w-4 h-4 text-emerald-600 dark:text-emerald-400 mt-0.5 shrink-0" />
                  <div>
                    <span className="text-muted-foreground block text-[11px]">Time</span>
                    <span>{event.time}</span>
                  </div>
                </div>

                <div className="flex items-start gap-3">
                  <MapPin className="w-4 h-4 text-emerald-600 dark:text-emerald-400 mt-0.5 shrink-0" />
                  <div>
                    <span className="text-muted-foreground block text-[11px]">Location</span>
                    <span>{event.location}</span>
                  </div>
                </div>

                <div className="flex items-start gap-3">
                  <Users className="w-4 h-4 text-emerald-600 dark:text-emerald-400 mt-0.5 shrink-0" />
                  <div>
                    <span className="text-muted-foreground block text-[11px]">Expected Participants</span>
                    <span>{event.participants}</span>
                  </div>
                </div>
              </div>
            </div>

            {/* Support This Event Card */}
            <div className="bg-card border border-border/80 p-6 rounded-2xl space-y-4 shadow-xs">
              <h3 className="font-heading text-lg font-bold text-foreground">
                Support This Event
              </h3>
              <p className="text-xs text-muted-foreground leading-relaxed">
                Help us make a bigger impact! Your contribution will support rally arrangements, saplings, refreshments and awareness materials.
              </p>

              <div className="space-y-1">
                <div className="w-full h-2 bg-secondary rounded-full overflow-hidden">
                  <div
                    className="h-full rounded-full"
                    style={{
                      width: `${Math.min(event.progress || 10, 100)}%`,
                      background:
                        event.category === "Education"
                          ? "linear-gradient(90deg, #7dd3fc 0%, #fbbf24 100%)"
                          : event.category === "Health"
                            ? "linear-gradient(90deg, #34d399 0%, #14b8a6 100%)"
                            : event.category === "Water"
                              ? "linear-gradient(90deg, #a78bfa 0%, #3b82f6 100%)"
                              : event.category === "Environment"
                                ? "linear-gradient(90deg, #34d399 0%, #22c55e 100%)"
                                : event.category === "Completed"
                                  ? "linear-gradient(90deg, #34d399 0%, #2dd4bf 100%)"
                                  : "linear-gradient(90deg, #34d399 0%, #38bdf8 100%)",
                    }}
                  />
                </div>
                <div className="flex justify-end text-[10px] font-bold text-muted-foreground">
                  <span>{event.progress}% funded</span>
                </div>
              </div>

              <Link
                to="/donate"
                className="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-500 hover:to-amber-600 text-amber-950 font-bold py-3 rounded-full text-xs shadow-gold transition-all"
              >
                <Heart className="w-4 h-4 fill-amber-950" /> Donate Now
              </Link>
            </div>

            {/* Quote Card */}
            {event.quote && (
              <div className="bg-emerald-50/60 dark:bg-emerald-950/20 border border-emerald-100 dark:border-emerald-900/50 p-6 rounded-2xl text-center italic text-emerald-900 dark:text-emerald-300 font-heading text-sm md:text-base leading-relaxed">
                "{event.quote}"
              </div>
            )}

          </div>

        </div>
      </section>

      {/* Lightbox Modal */}
      <AnimatePresence>
        {selectedPhoto !== null && (
          <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            className="fixed inset-0 z-[80] flex items-center justify-center p-4"
            onClick={() => setSelectedPhoto(null)}
          >
            <div className="absolute inset-0 bg-black/90 backdrop-blur-md" />

            <button
              className="absolute top-6 right-6 z-10 w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors"
              onClick={() => setSelectedPhoto(null)}
            >
              <X className="h-5 w-5" />
            </button>

            <button
              className="absolute left-4 md:left-8 z-10 w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors"
              onClick={(e) => { e.stopPropagation(); navigatePhoto(-1); }}
            >
              <ChevronLeft className="h-5 w-5" />
            </button>

            <button
              className="absolute right-4 md:right-8 z-10 w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors"
              onClick={(e) => { e.stopPropagation(); navigatePhoto(1); }}
            >
              <ChevronRight className="h-5 w-5" />
            </button>

            <div className="relative z-10 max-w-4xl max-h-[85vh]">
              <img
                src={event.galleryImages[selectedPhoto]}
                alt=""
                className="max-w-full max-h-[75vh] object-contain rounded-2xl shadow-2xl"
              />
            </div>
          </motion.div>
        )}
      </AnimatePresence>
    </div>
  );
};

export default EventDetails;
