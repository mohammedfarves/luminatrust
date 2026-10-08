<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-8">

    <!-- Header Greeting Banner (Matching Uploaded Mockup) -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <span class="text-xs font-semibold text-slate-400 block mb-0.5">Welcome back,</span>
            <h2 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight flex items-center space-x-2">
                <span>Good Morning, Alex!</span>
                <span class="inline-block animate-bounce">👋</span>
            </h2>
            <p class="text-slate-500 text-xs mt-1 font-medium">
                Here's what's happening with your platform today.
            </p>
        </div>

        <!-- Date Pill Button -->
        <div class="flex items-center space-x-3 shrink-0">
            <button class="px-4 py-2 bg-white border border-slate-200/80 rounded-full text-xs font-bold text-slate-700 shadow-sm hover:border-slate-300 transition-all flex items-center space-x-2">
                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span><?php echo e(date('d M Y')); ?></span>
                <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
        </div>
    </div>

    <!-- 4 Summary Stat Cards Grid (Matching Uploaded Mockup) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Card 1: Total Projects -->
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm shadow-indigo-500/5 space-y-4 hover:shadow-md transition-all relative">
            <button class="absolute top-6 right-6 text-slate-400 hover:text-slate-600 text-sm font-bold">•••</button>
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 rounded-2xl bg-purple-100/80 text-purple-600 flex items-center justify-center font-bold text-xl shrink-0">
                    📁
                </div>
                <div>
                    <span class="text-xs font-extrabold text-slate-700 block">Total Projects</span>
                    <div class="text-2xl font-black text-slate-900 tracking-tight mt-0.5"><?php echo e($totalProjectsCount); ?></div>
                </div>
            </div>
            <div class="flex items-center text-[11px] text-slate-400 font-semibold pt-1">
                <span>Active causes running</span>
                <span class="ml-1 text-purple-600">→</span>
            </div>
        </div>

        <!-- Card 2: Total Volunteers -->
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm shadow-indigo-500/5 space-y-4 hover:shadow-md transition-all relative">
            <button class="absolute top-6 right-6 text-slate-400 hover:text-slate-600 text-sm font-bold">•••</button>
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 rounded-2xl bg-sky-100/80 text-sky-600 flex items-center justify-center font-bold text-xl shrink-0">
                    🤝
                </div>
                <div>
                    <span class="text-xs font-extrabold text-slate-700 block">Total Volunteers</span>
                    <div class="text-2xl font-black text-slate-900 tracking-tight mt-0.5">
                        <?php echo e($totalVolunteersCount >= 50 ? '50+' : $totalVolunteersCount); ?>

                    </div>
                </div>
            </div>
            <div class="flex items-center text-[11px] text-slate-400 font-semibold pt-1">
                <span>Community signups</span>
                <span class="ml-1 text-sky-600">→</span>
            </div>
        </div>

        <!-- Card 3: Donations -->
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm shadow-indigo-500/5 space-y-4 hover:shadow-md transition-all relative">
            <button class="absolute top-6 right-6 text-slate-400 hover:text-slate-600 text-sm font-bold">•••</button>
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100/80 text-emerald-600 flex items-center justify-center font-bold text-xl shrink-0">
                    ₹
                </div>
                <div>
                    <span class="text-xs font-extrabold text-slate-700 block">Donations</span>
                    <div class="text-2xl font-black text-slate-900 tracking-tight mt-0.5">
                        ₹<?php echo e(number_format($totalDonationsSum, 2)); ?>

                    </div>
                </div>
            </div>
            <div class="flex items-center text-[11px] text-slate-400 font-semibold pt-1">
                <span>Total contributions</span>
                <span class="ml-1 text-emerald-600">→</span>
            </div>
        </div>

        <!-- Card 4: Contact Messages -->
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm shadow-indigo-500/5 space-y-4 hover:shadow-md transition-all relative">
            <button class="absolute top-6 right-6 text-slate-400 hover:text-slate-600 text-sm font-bold">•••</button>
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-100/80 text-amber-600 flex items-center justify-center font-bold text-xl shrink-0">
                    📩
                </div>
                <div>
                    <span class="text-xs font-extrabold text-slate-700 block">Contact Messages</span>
                    <div class="text-2xl font-black text-slate-900 tracking-tight mt-0.5"><?php echo e($totalMessagesCount); ?></div>
                </div>
            </div>
            <div class="flex items-center text-[11px] text-slate-400 font-semibold pt-1">
                <span><?php echo e($unreadMessagesCount); ?> unread messages</span>
                <span class="ml-1 text-amber-600">→</span>
            </div>
        </div>

    </div>

    <!-- Platform Overview & Quick Stats Row (Matching Uploaded Mockup Layout) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Platform Overview Chart / Metrics (Left 2 cols) -->
        <div class="lg:col-span-2 bg-white rounded-3xl p-6 border border-slate-100 shadow-sm shadow-indigo-500/5 space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-black text-slate-900 tracking-tight">Platform Overview</h3>
                    <p class="text-xs text-slate-400 font-medium mt-0.5">Summary of your platform performance</p>
                </div>
                <div class="flex items-center space-x-1 bg-slate-100 p-1 rounded-full text-xs font-bold text-slate-500">
                    <button class="px-3 py-1 rounded-full bg-indigo-500 text-white shadow-sm">7 Days</button>
                    <button class="px-3 py-1 rounded-full hover:text-slate-900">30 Days</button>
                    <button class="px-3 py-1 rounded-full hover:text-slate-900">3 Months</button>
                    <button class="px-3 py-1 rounded-full hover:text-slate-900">1 Year</button>
                </div>
            </div>

            <!-- Activity Trends Progress Indicators -->
            <div class="space-y-4 pt-2">
                <div class="space-y-1.5">
                    <div class="flex justify-between text-xs font-bold">
                        <span class="text-slate-700">Project Execution Progress</span>
                        <span class="text-indigo-600">85%</span>
                    </div>
                    <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden">
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-500 h-3 rounded-full" style="width: 85%;"></div>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <div class="flex justify-between text-xs font-bold">
                        <span class="text-slate-700">Volunteer Community Signups Target</span>
                        <span class="text-sky-600">92%</span>
                    </div>
                    <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden">
                        <div class="bg-gradient-to-r from-sky-400 to-blue-500 h-3 rounded-full" style="width: 92%;"></div>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <div class="flex justify-between text-xs font-bold">
                        <span class="text-slate-700">Donation Goal Fulfillment</span>
                        <span class="text-emerald-600">78%</span>
                    </div>
                    <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden">
                        <div class="bg-gradient-to-r from-emerald-400 to-teal-500 h-3 rounded-full" style="width: 78%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats (Right 1 col - Matching Uploaded Mockup) -->
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm shadow-indigo-500/5 space-y-6">
            <div>
                <h3 class="text-lg font-black text-slate-900 tracking-tight">Quick Stats</h3>
                <p class="text-xs text-slate-400 font-medium mt-0.5">Platform statistics at a glance</p>
            </div>

            <div class="space-y-3 divide-y divide-slate-100">
                <div class="flex items-center justify-between pt-2">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center font-bold text-xs">
                            📁
                        </div>
                        <span class="text-xs font-bold text-slate-700">Total Projects</span>
                    </div>
                    <span class="text-xs font-black text-slate-900"><?php echo e($totalProjectsCount); ?> ›</span>
                </div>

                <div class="flex items-center justify-between pt-3">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs">
                            🤝
                        </div>
                        <span class="text-xs font-bold text-slate-700">Total Volunteers</span>
                    </div>
                    <span class="text-xs font-black text-slate-900"><?php echo e($totalVolunteersCount); ?> ›</span>
                </div>

                <div class="flex items-center justify-between pt-3">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-xs">
                            ₹
                        </div>
                        <span class="text-xs font-bold text-slate-700">Total Contributions</span>
                    </div>
                    <span class="text-xs font-black text-slate-900">₹<?php echo e(number_format($totalDonationsSum, 0)); ?> ›</span>
                </div>

                <div class="flex items-center justify-between pt-3">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center font-bold text-xs">
                            📩
                        </div>
                        <span class="text-xs font-bold text-slate-700">Contact Messages</span>
                    </div>
                    <span class="text-xs font-black text-slate-900"><?php echo e($totalMessagesCount); ?> ›</span>
                </div>
            </div>
        </div>

    </div>

    <!-- Recent Activity Table (Matching Uploaded Mockup Style) -->
    <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm shadow-indigo-500/5 space-y-5">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-black text-slate-900 tracking-tight">Recent Activity</h3>
                <p class="text-xs text-slate-400 font-medium mt-0.5">Latest updates from your platform</p>
            </div>
            <a href="<?php echo e(route('admin.activities.index')); ?>" class="text-xs font-extrabold text-indigo-600 hover:text-indigo-800">View all →</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 uppercase tracking-wider font-extrabold border-b border-slate-100">
                        <th class="py-3 px-4 rounded-l-xl">#</th>
                        <th class="py-3 px-4">Activity</th>
                        <th class="py-3 px-4">Details</th>
                        <th class="py-3 px-4">Date</th>
                        <th class="py-3 px-4 text-right rounded-r-xl">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php $__empty_1 = true; $__currentLoopData = $recentActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3.5 px-4 font-bold text-slate-400">#<?php echo e($index + 1); ?></td>
                            <td class="py-3.5 px-4 font-bold text-slate-900"><?php echo e($act->title); ?></td>
                            <td class="py-3.5 px-4 text-slate-500 font-medium"><?php echo e($act->description); ?></td>
                            <td class="py-3.5 px-4 text-slate-400 font-medium"><?php echo e($act->created_at->format('M d, Y')); ?></td>
                            <td class="py-3.5 px-4 text-right">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-emerald-50 text-emerald-600 border border-emerald-200">
                                    Logged
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="py-10 text-center text-slate-400 font-medium">
                                <div class="space-y-2">
                                    <div class="w-10 h-10 rounded-full bg-purple-50 text-purple-600 mx-auto flex items-center justify-center text-lg">📋</div>
                                    <p class="text-xs font-bold text-slate-700">No recent activity available</p>
                                    <p class="text-[11px] text-slate-400">When there are updates, they will appear here.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Sowmiya\OneDrive\Documents\GitHub\lumina\lumina_admin\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>