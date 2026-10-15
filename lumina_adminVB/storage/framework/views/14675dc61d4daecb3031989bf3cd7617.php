<?php $__env->startSection('title', 'About Us Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-8">

    <!-- Flash Success Alert -->
    <?php if(session('success')): ?>
        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold flex items-center justify-between shadow-sm">
            <div class="flex items-center space-x-2">
                <span>✓</span>
                <span><?php echo e(session('success')); ?></span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900">✕</button>
        </div>
    <?php endif; ?>

    <!-- Top Action Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">About Lumina Trust</h2>
            <p class="text-xs text-slate-500 mt-1 font-medium">Manage trust overview, mission, vision, founder statement, and impact metrics</p>
        </div>

        <a href="<?php echo e(route('admin.about.edit')); ?>" 
           class="inline-flex items-center space-x-2 px-5 py-2.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-violet-500 hover:from-indigo-600 hover:to-violet-600 text-white text-xs font-extrabold rounded-full shadow-md shadow-indigo-500/20 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            <span>Edit Full About Page</span>
        </a>
    </div>

    <!-- 1. Impact Metric Cards Section -->
    <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm shadow-indigo-500/5 space-y-4">
        <div class="flex items-center justify-between pb-2 border-b border-slate-100">
            <div>
                <h4 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider flex items-center space-x-2">
                    <span>📊</span>
                    <span>Impact Statistics</span>
                </h4>
                <p class="text-xs text-slate-500">Live counter numbers displayed on front page.</p>
            </div>
            <a href="<?php echo e(route('admin.about.edit')); ?>#sec-stats" class="inline-flex items-center space-x-1.5 px-3 py-1.5 bg-slate-100 hover:bg-indigo-600 hover:text-white text-slate-700 text-xs font-extrabold rounded-xl transition-all">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span>Edit Statistics</span>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 pt-2">
            <div class="bg-slate-50/80 rounded-2xl p-5 border border-slate-200/60 space-y-2">
                <span class="text-xs font-extrabold text-slate-400 block uppercase tracking-wider">Beneficiaries Reached</span>
                <div class="text-2xl font-black text-slate-900 tracking-tight"><?php echo e($about->beneficiaries_count ?: '10,000+'); ?></div>
                <p class="text-[11px] text-emerald-600 font-bold">Lives Impacted Across India</p>
            </div>

            <div class="bg-slate-50/80 rounded-2xl p-5 border border-slate-200/60 space-y-2">
                <span class="text-xs font-extrabold text-slate-400 block uppercase tracking-wider">Projects Completed</span>
                <div class="text-2xl font-black text-slate-900 tracking-tight"><?php echo e($about->projects_count ?: '150+'); ?></div>
                <p class="text-[11px] text-purple-600 font-bold">Social Drives Executed</p>
            </div>

            <div class="bg-slate-50/80 rounded-2xl p-5 border border-slate-200/60 space-y-2">
                <span class="text-xs font-extrabold text-slate-400 block uppercase tracking-wider">Active Volunteers</span>
                <div class="text-2xl font-black text-slate-900 tracking-tight"><?php echo e($about->volunteers_count ?: '500+'); ?></div>
                <p class="text-[11px] text-sky-600 font-bold">Dedicated Community Members</p>
            </div>

            <div class="bg-slate-50/80 rounded-2xl p-5 border border-slate-200/60 space-y-2">
                <span class="text-xs font-extrabold text-slate-400 block uppercase tracking-wider">Cities Reached</span>
                <div class="text-2xl font-black text-slate-900 tracking-tight"><?php echo e($about->cities_count ?: '25+'); ?></div>
                <p class="text-[11px] text-amber-600 font-bold">Regional Hubs Covered</p>
            </div>
        </div>
    </div>

    <!-- About Main Showcase Card Container -->
    <div class="bg-white rounded-3xl p-6 md:p-8 border border-slate-100 shadow-sm shadow-indigo-500/5 space-y-8">
        
        <!-- 2. Hero & Intro Story Section -->
        <div class="space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <h4 class="text-sm font-extrabold text-indigo-600 uppercase tracking-wider flex items-center space-x-2">
                    <span>📌</span>
                    <span>Hero Section & Intro Story</span>
                </h4>
                <a href="<?php echo e(route('admin.about.edit')); ?>#sec-hero" class="inline-flex items-center space-x-1.5 px-3 py-1.5 bg-slate-100 hover:bg-indigo-600 hover:text-white text-slate-700 text-xs font-extrabold rounded-xl transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span>Edit Hero Section</span>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center pt-2">
                <div class="lg:col-span-2 space-y-3">
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-600 border border-indigo-200/60 inline-block">
                        Established Est. <?php echo e($about->established_year ?: '2018'); ?>

                    </span>
                    <h3 class="text-2xl font-black text-slate-900 tracking-tight"><?php echo e($about->title); ?></h3>
                    <p class="text-sm font-semibold text-indigo-600 leading-relaxed"><?php echo e($about->subtitle); ?></p>
                    <p class="text-xs text-slate-600 leading-relaxed pt-2"><?php echo e($about->story); ?></p>
                </div>

                <div class="relative">
                    <img src="<?php echo e($about->image_url); ?>" alt="About Lumina Trust" class="w-full h-56 object-cover rounded-2xl border border-slate-200/80 shadow-sm">
                </div>
            </div>
        </div>

        <!-- 3. Who We Are Section -->
        <div class="border-t border-slate-100 pt-8 space-y-4">
            <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                <h4 class="text-sm font-extrabold text-teal-600 uppercase tracking-wider flex items-center space-x-2">
                    <span>🏢</span>
                    <span>Who We Are Section</span>
                </h4>
                <a href="<?php echo e(route('admin.about.edit')); ?>#sec-who-we-are" class="inline-flex items-center space-x-1.5 px-3 py-1.5 bg-slate-100 hover:bg-teal-600 hover:text-white text-slate-700 text-xs font-extrabold rounded-xl transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span>Edit Who We Are</span>
                </a>
            </div>
            <div class="bg-slate-50/80 p-5 rounded-2xl border border-slate-200/60 space-y-2">
                <h5 class="text-sm font-bold text-slate-900"><?php echo e($about->who_we_are_title ?: 'Uplifting Underserved Communities with Dignity'); ?></h5>
                <p class="text-xs text-slate-600 leading-relaxed"><?php echo e($about->who_we_are_description ?: $about->story); ?></p>
                <span class="inline-block mt-2 text-[11px] font-bold text-teal-600 bg-teal-50 px-3 py-1 rounded-full border border-teal-200/60">
                    Overlay Badge: <?php echo e($about->image_badge_text ?: '100% Non-Profit NGO'); ?>

                </span>
            </div>
        </div>

        <!-- 4. Mission & Vision Statements Section -->
        <div class="border-t border-slate-100 pt-8 space-y-4">
            <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                <h4 class="text-sm font-extrabold text-purple-600 uppercase tracking-wider flex items-center space-x-2">
                    <span>🎯</span>
                    <span>Mission & Vision Statements</span>
                </h4>
                <a href="<?php echo e(route('admin.about.edit')); ?>#sec-mission-vision" class="inline-flex items-center space-x-1.5 px-3 py-1.5 bg-slate-100 hover:bg-purple-600 hover:text-white text-slate-700 text-xs font-extrabold rounded-xl transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span>Edit Mission & Vision</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Mission Card -->
                <div class="bg-slate-50/80 p-6 rounded-2xl border border-slate-200/60 space-y-3">
                    <div class="w-9 h-9 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center font-bold text-sm">
                        🎯
                    </div>
                    <h4 class="text-xs font-black uppercase text-purple-700 tracking-wider">Our Mission</h4>
                    <h5 class="text-sm font-bold text-slate-900"><?php echo e($about->mission_title ?: 'Transforming Lives Through Education & Healthcare'); ?></h5>
                    <p class="text-xs text-slate-600 leading-relaxed"><?php echo e($about->mission); ?></p>
                    <?php if(!empty($about->mission_points)): ?>
                        <ul class="space-y-1 pt-2 border-t border-slate-200/60">
                            <?php $__currentLoopData = $about->mission_points; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="text-[11px] text-slate-600 font-medium flex items-center gap-1.5">
                                    <span class="text-purple-500 font-bold">›</span> <?php echo e($mp); ?>

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- Vision Card -->
                <div class="bg-slate-50/80 p-6 rounded-2xl border border-slate-200/60 space-y-3">
                    <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center font-bold text-sm">
                        👁️
                    </div>
                    <h4 class="text-xs font-black uppercase text-amber-700 tracking-wider">Our Vision</h4>
                    <h5 class="text-sm font-bold text-slate-900"><?php echo e($about->vision_title ?: 'Empowered Communities Living with Dignity & Equality'); ?></h5>
                    <p class="text-xs text-slate-600 leading-relaxed"><?php echo e($about->vision); ?></p>
                    <?php if(!empty($about->vision_points)): ?>
                        <ul class="space-y-1 pt-2 border-t border-slate-200/60">
                            <?php $__currentLoopData = $about->vision_points; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="text-[11px] text-slate-600 font-medium flex items-center gap-1.5">
                                    <span class="text-amber-500 font-bold">›</span> <?php echo e($vp); ?>

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- 5. Core Values Section -->
        <?php if(!empty($about->core_values)): ?>
            <div class="border-t border-slate-100 pt-8 space-y-4">
                <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                    <h4 class="text-sm font-extrabold text-amber-600 uppercase tracking-wider flex items-center space-x-2">
                        <span>💎</span>
                        <span>Core Values</span>
                    </h4>
                    <a href="<?php echo e(route('admin.about.edit')); ?>#sec-core-values" class="inline-flex items-center space-x-1.5 px-3 py-1.5 bg-slate-100 hover:bg-amber-600 hover:text-white text-slate-700 text-xs font-extrabold rounded-xl transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        <span>Edit Core Values</span>
                    </a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <?php $__currentLoopData = $about->core_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $title = is_array($val) ? ($val['title'] ?? ($val['label'] ?? '')) : $val;
                            $desc = is_array($val) ? ($val['description'] ?? ($val['desc'] ?? '')) : '';
                        ?>
                        <div class="p-4 bg-slate-50/80 rounded-2xl border border-slate-200/80 flex items-start space-x-3.5">
                            <div class="w-8 h-8 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center font-bold text-xs shrink-0 mt-0.5 shadow-xs">
                                ✓
                            </div>
                            <div>
                                <h5 class="text-xs font-black text-slate-900"><?php echo e($title); ?></h5>
                                <?php if($desc): ?>
                                    <p class="text-xs text-slate-500 font-medium mt-0.5 leading-relaxed"><?php echo e($desc); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- 6. Areas of Impact Section -->
        <?php if(!empty($about->impact_items)): ?>
            <div class="border-t border-slate-100 pt-8 space-y-4">
                <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                    <div>
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase bg-cyan-50 text-cyan-600 border border-cyan-200/60 inline-block mb-1">
                            <?php echo e($about->impact_subtitle ?: 'Areas of Impact'); ?>

                        </span>
                        <h4 class="text-sm font-extrabold text-slate-900 tracking-tight"><?php echo e($about->impact_title ?: 'Where We Make a Difference'); ?></h4>
                        <p class="text-xs text-slate-500 mt-0.5"><?php echo e($about->impact_description); ?></p>
                    </div>
                    <a href="<?php echo e(route('admin.about.edit')); ?>#sec-impact" class="inline-flex items-center space-x-1.5 px-3 py-1.5 bg-slate-100 hover:bg-cyan-600 hover:text-white text-slate-700 text-xs font-extrabold rounded-xl transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        <span>Edit Impact Cards</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <?php $__currentLoopData = $about->impact_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="p-4 bg-slate-50/80 rounded-2xl border border-slate-200/60 space-y-1">
                            <h5 class="text-xs font-bold text-slate-900"><?php echo e($imp['title'] ?? ''); ?></h5>
                            <p class="text-[11px] text-slate-500 leading-relaxed"><?php echo e($imp['description'] ?? ''); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- 7. Our Process Section -->
        <?php if(!empty($about->process_steps)): ?>
            <div class="border-t border-slate-100 pt-8 space-y-4">
                <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                    <div>
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase bg-indigo-50 text-indigo-600 border border-indigo-200/60 inline-block mb-1">
                            <?php echo e($about->process_subtitle ?: 'Our Process'); ?>

                        </span>
                        <h4 class="text-sm font-extrabold text-slate-900 tracking-tight"><?php echo e($about->process_title ?: 'How We Work'); ?></h4>
                        <p class="text-xs text-slate-500 mt-0.5"><?php echo e($about->process_description); ?></p>
                    </div>
                    <a href="<?php echo e(route('admin.about.edit')); ?>#sec-process" class="inline-flex items-center space-x-1.5 px-3 py-1.5 bg-slate-100 hover:bg-indigo-600 hover:text-white text-slate-700 text-xs font-extrabold rounded-xl transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        <span>Edit Process</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <?php $__currentLoopData = $about->process_steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="p-4 bg-slate-50/80 rounded-2xl border border-slate-200/60 space-y-1">
                            <span class="text-xs font-black text-indigo-600 block"><?php echo e($step['step'] ?? sprintf('%02d', $loop->iteration)); ?></span>
                            <h5 class="text-xs font-bold text-slate-900"><?php echo e($step['title'] ?? ''); ?></h5>
                            <p class="text-[11px] text-slate-500 leading-relaxed"><?php echo e($step['description'] ?? ''); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- 8. Leadership Team Section -->
        <?php if(!empty($about->team_members)): ?>
            <div class="border-t border-slate-100 pt-8 space-y-4">
                <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                    <div>
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase bg-amber-50 text-amber-600 border border-amber-200/60 inline-block mb-1">
                            <?php echo e($about->team_subtitle ?: 'Leadership'); ?>

                        </span>
                        <h4 class="text-sm font-extrabold text-slate-900 tracking-tight"><?php echo e($about->team_title ?: 'Meet Our Team'); ?></h4>
                        <p class="text-xs text-slate-500 mt-0.5"><?php echo e($about->team_description); ?></p>
                    </div>
                    <a href="<?php echo e(route('admin.about.edit')); ?>#sec-team" class="inline-flex items-center space-x-1.5 px-3 py-1.5 bg-slate-100 hover:bg-amber-500 hover:text-white text-slate-700 text-xs font-extrabold rounded-xl transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        <span>Edit Team</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <?php $__currentLoopData = $about->team_members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $mName = is_array($member) ? ($member['name'] ?? '') : '';
                            $mRole = is_array($member) ? ($member['role'] ?? '') : '';
                            $mDesc = is_array($member) ? ($member['desc'] ?? ($member['description'] ?? '')) : '';
                        ?>
                        <div class="p-4 bg-slate-50/80 rounded-2xl border border-slate-200/60 space-y-1.5 text-center">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-orange-500 text-white font-bold text-sm mx-auto flex items-center justify-center shadow-xs">
                                <?php echo e(strtoupper(substr($mName, 0, 1))); ?>

                            </div>
                            <h5 class="text-xs font-bold text-slate-900"><?php echo e($mName); ?></h5>
                            <span class="text-[10px] font-extrabold text-amber-600 uppercase tracking-wider block"><?php echo e($mRole); ?></span>
                            <p class="text-[11px] text-slate-500 leading-relaxed"><?php echo e($mDesc); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- 9. Founder Statement Section -->
        <div class="border-t border-slate-100 pt-8 space-y-4">
            <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                <h4 class="text-sm font-extrabold text-amber-600 uppercase tracking-wider flex items-center space-x-2">
                    <span>💬</span>
                    <span>Founder's Message & Media</span>
                </h4>
                <a href="<?php echo e(route('admin.about.edit')); ?>#sec-founder" class="inline-flex items-center space-x-1.5 px-3 py-1.5 bg-slate-100 hover:bg-amber-600 hover:text-white text-slate-700 text-xs font-extrabold rounded-xl transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span>Edit Founder Message</span>
                </a>
            </div>
            <div class="flex flex-col sm:flex-row items-start space-y-4 sm:space-y-0 sm:space-x-5 bg-gradient-to-r from-indigo-50/60 via-purple-50/40 to-slate-50 p-6 rounded-2xl border border-indigo-100">
                <img src="<?php echo e($about->founder_image_url); ?>" alt="<?php echo e($about->founder_name); ?>" class="w-16 h-16 rounded-full object-cover border-2 border-indigo-200 shadow-sm shrink-0">
                <div class="space-y-1 flex-1">
                    <h5 class="text-sm font-extrabold text-slate-900"><?php echo e($about->founder_name ?: 'Ananya Kapoor'); ?></h5>
                    <span class="text-[11px] font-bold text-indigo-600 block"><?php echo e($about->founder_title ?: 'Founder & CEO'); ?></span>
                    <p class="text-xs italic text-slate-600 pt-1 leading-relaxed">"<?php echo e($about->founder_message); ?>"</p>
                </div>
            </div>
        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mohammedfarves/Downloads/luminatrust/luminatrust/lumina_admin/resources/views/admin/about/index.blade.php ENDPATH**/ ?>