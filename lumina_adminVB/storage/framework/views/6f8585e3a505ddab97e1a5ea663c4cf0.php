<?php $__env->startSection('title', 'Activities & Projects'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

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

    <!-- Top Action Header (Matching User Request: [ + Add Activity ]) -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Activities & Projects</h2>
            <p class="text-xs text-slate-500 mt-1 font-medium">Manage community drives, educational programs, and fundraising causes</p>
        </div>

        <a href="<?php echo e(route('admin.activities.create')); ?>" 
           class="inline-flex items-center space-x-2 px-5 py-2.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-violet-500 hover:from-indigo-600 hover:to-violet-600 text-white text-xs font-extrabold rounded-full shadow-md shadow-indigo-500/20 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            <span>+ Add Activity</span>
        </a>
    </div>

    <!-- Filter & Search Bar Section (Matching User Request: Search... and Category Filter Pills) -->
    <div class="bg-white border border-slate-100 rounded-3xl p-4 shadow-sm shadow-indigo-500/5 flex flex-col md:flex-row md:items-center justify-between gap-4">
        
        <!-- Category Filter Pills: All | Education | Health | Environment | Water -->
        <div class="flex items-center space-x-1.5 overflow-x-auto pb-2 md:pb-0">
            <?php
                $categories = ['All', 'Education', 'Health', 'Environment', 'Water'];
            ?>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('admin.activities.index', ['category' => $cat, 'search' => $search])); ?>" 
                   class="px-4 py-2 rounded-full text-xs font-extrabold transition-all whitespace-nowrap <?php echo e($category === $cat ? 'bg-gradient-to-r from-indigo-500 to-violet-500 text-white shadow-md shadow-indigo-500/20' : 'bg-slate-100/80 text-slate-600 border border-slate-200/60 hover:text-slate-900 hover:bg-slate-200/80'); ?>">
                    <?php echo e($cat); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- Search Input Form -->
        <form method="GET" action="<?php echo e(route('admin.activities.index')); ?>" class="flex items-center space-x-2">
            <input type="hidden" name="category" value="<?php echo e($category); ?>">
            <div class="relative w-full md:w-64">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </span>
                <input type="text" 
                       name="search" 
                       value="<?php echo e($search); ?>" 
                       placeholder="Search activities..." 
                       class="w-full pl-9 pr-3 py-2 bg-slate-50 border border-slate-200/80 rounded-full text-xs font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
            </div>
            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-extrabold rounded-full shadow-sm">
                Search
            </button>
            <?php if($search || $category !== 'All'): ?>
                <a href="<?php echo e(route('admin.activities.index')); ?>" class="px-3 py-2 bg-slate-100 text-slate-600 hover:text-slate-900 text-xs font-bold rounded-full border border-slate-200">
                    Reset
                </a>
            <?php endif; ?>
        </form>

    </div>

    <!-- Data Table Section (Matching User Request: Image | Title | Category | Status) -->
    <div class="bg-white border border-slate-100 rounded-3xl shadow-sm shadow-indigo-500/5 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 uppercase tracking-wider font-extrabold">
                        <th class="py-4 px-6">Image</th>
                        <th class="py-4 px-6">Title & Summary</th>
                        <th class="py-4 px-6">Category</th>
                        <th class="py-4 px-6">Progress %</th>
                        <th class="py-4 px-6">Raised / Goal</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php $__empty_1 = true; $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <!-- Image Thumbnail -->
                            <td class="py-4 px-6">
                                <img src="<?php echo e($act->image_url); ?>" 
                                     alt="<?php echo e($act->title); ?>" 
                                     class="w-14 h-14 object-cover rounded-2xl border border-slate-200/80 shadow-sm">
                            </td>

                            <!-- Title & Location -->
                            <td class="py-4 px-6">
                                <h4 class="font-extrabold text-slate-900 text-sm leading-tight"><?php echo e($act->title); ?></h4>
                                <?php if($act->short_title): ?>
                                    <span class="text-[11px] text-indigo-600 font-bold block mt-0.5"><?php echo e($act->short_title); ?></span>
                                <?php endif; ?>
                                <span class="text-[11px] text-slate-400 font-normal block mt-1">
                                    📍 <?php echo e($act->location ?: 'Online / Multiple Locations'); ?>

                                    <?php if($act->date): ?> • 📅 <?php echo e($act->date->format('M d, Y')); ?> <?php endif; ?>
                                </span>
                            </td>

                            <!-- Category -->
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-extrabold bg-indigo-50 text-indigo-700 border border-indigo-200/60">
                                    <?php echo e($act->category); ?>

                                </span>
                            </td>

                            <!-- Progress Percent -->
                            <td class="py-4 px-6 min-w-[120px]">
                                <div class="space-y-1">
                                    <div class="flex justify-between text-[11px] font-bold">
                                        <span class="text-slate-900"><?php echo e($act->progress_percent); ?>%</span>
                                    </div>
                                    <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                                        <div class="bg-gradient-to-r from-indigo-500 to-violet-500 h-2 rounded-full" style="width: <?php echo e(min(100, $act->progress_percent)); ?>%;"></div>
                                    </div>
                                </div>
                            </td>

                            <!-- Raised vs Goal Amount -->
                            <td class="py-4 px-6">
                                <span class="font-extrabold text-emerald-600 text-xs block">₹<?php echo e(number_format($act->raised_amount, 2)); ?></span>
                                <span class="text-[11px] text-slate-400 font-normal">Goal: ₹<?php echo e(number_format($act->goal_amount, 2)); ?></span>
                            </td>

                            <!-- Status Badge -->
                            <td class="py-4 px-6">
                                <?php if($act->status === 'active'): ?>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        ● Active
                                    </span>
                                <?php elseif($act->status === 'completed'): ?>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-blue-50 text-blue-700 border border-blue-200">
                                        ✓ Completed
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-amber-50 text-amber-700 border border-amber-200">
                                        ⏳ Upcoming
                                    </span>
                                <?php endif; ?>
                            </td>

                            <!-- Action Buttons -->
                            <td class="py-4 px-6 text-right space-x-2">
                                <a href="<?php echo e(route('admin.activities.edit', $act)); ?>" 
                                   class="inline-block px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-bold border border-slate-200 transition-all">
                                    Edit
                                </a>

                                <form method="POST" action="<?php echo e(route('admin.activities.destroy', $act)); ?>" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this activity?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-xl text-xs font-bold border border-rose-200 transition-all">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                <div class="max-w-sm mx-auto space-y-3">
                                    <div class="text-3xl">📁</div>
                                    <p class="text-xs font-bold text-slate-700">No activities found.</p>
                                    <p class="text-[11px] text-slate-400">Click '+ Add Activity' above to create your first activity.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <?php if($activities->hasPages()): ?>
            <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                <?php echo e($activities->links()); ?>

            </div>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mohammedfarves/Downloads/luminatrust/luminatrust/lumina_admin/resources/views/admin/activities/index.blade.php ENDPATH**/ ?>