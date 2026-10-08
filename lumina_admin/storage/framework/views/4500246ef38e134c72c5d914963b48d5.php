<?php $__env->startSection('title', 'Services & Programs'); ?>

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

    <!-- Top Action Header (Matching Design: [ + Add Service ]) -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Services & Community Programs</h2>
            <p class="text-xs text-slate-500 mt-1 font-medium">Manage healthcare drives, educational support, welfare services, and relief programs</p>
        </div>

        <a href="<?php echo e(route('admin.services.create')); ?>" 
           class="inline-flex items-center space-x-2 px-5 py-2.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-violet-500 hover:from-indigo-600 hover:to-violet-600 text-white text-xs font-extrabold rounded-full shadow-md shadow-indigo-500/20 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            <span>+ Add Service</span>
        </a>
    </div>

    <!-- Filter & Search Bar Section -->
    <div class="bg-white border border-slate-100 rounded-3xl p-4 shadow-sm shadow-indigo-500/5 flex flex-col md:flex-row md:items-center justify-between gap-4">
        
        <!-- Category Filter Pills: All | Healthcare | Education | Environment | Welfare | Emergency Relief -->
        <div class="flex items-center space-x-1.5 overflow-x-auto pb-2 md:pb-0">
            <?php
                $categories = ['All', 'Healthcare', 'Education', 'Environment', 'Welfare', 'Emergency Relief'];
            ?>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('admin.services.index', ['category' => $cat, 'search' => $search])); ?>" 
                   class="px-4 py-2 rounded-full text-xs font-extrabold transition-all whitespace-nowrap <?php echo e($category === $cat ? 'bg-gradient-to-r from-indigo-500 to-violet-500 text-white shadow-md shadow-indigo-500/20' : 'bg-slate-100/80 text-slate-600 border border-slate-200/60 hover:text-slate-900 hover:bg-slate-200/80'); ?>">
                    <?php echo e($cat); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- Search Input Form -->
        <form method="GET" action="<?php echo e(route('admin.services.index')); ?>" class="flex items-center space-x-2">
            <input type="hidden" name="category" value="<?php echo e($category); ?>">
            <div class="relative w-full md:w-64">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </span>
                <input type="text" 
                       name="search" 
                       value="<?php echo e($search); ?>" 
                       placeholder="Search services..." 
                       class="w-full pl-9 pr-3 py-2 bg-slate-50 border border-slate-200/80 rounded-full text-xs font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all">
            </div>
            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-extrabold rounded-full shadow-sm">
                Search
            </button>
            <?php if($search || $category !== 'All'): ?>
                <a href="<?php echo e(route('admin.services.index')); ?>" class="px-3 py-2 bg-slate-100 text-slate-600 hover:text-slate-900 text-xs font-bold rounded-full border border-slate-200">
                    Reset
                </a>
            <?php endif; ?>
        </form>

    </div>

    <!-- Data Table Section -->
    <div class="bg-white border border-slate-100 rounded-3xl shadow-sm shadow-indigo-500/5 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 uppercase tracking-wider font-extrabold">
                        <th class="py-4 px-6">Service</th>
                        <th class="py-4 px-6">Category</th>
                        <th class="py-4 px-6">Service Fee</th>
                        <th class="py-4 px-6">Availability & Location</th>
                        <th class="py-4 px-6">Contact Person</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $srv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <!-- Service Thumbnail & Title -->
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-3.5">
                                    <div class="relative shrink-0">
                                        <img src="<?php echo e($srv->image_url); ?>" 
                                             alt="<?php echo e($srv->title); ?>" 
                                             class="w-12 h-12 object-cover rounded-2xl border border-slate-200/80 shadow-sm">
                                        <?php if($srv->icon): ?>
                                            <span class="absolute -bottom-1 -right-1 w-6 h-6 rounded-lg bg-white border border-slate-200 text-xs flex items-center justify-center shadow-xs">
                                                <?php echo e($srv->icon); ?>

                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <h4 class="font-extrabold text-slate-900 text-sm leading-tight"><?php echo e($srv->title); ?></h4>
                                        <?php if($srv->short_title): ?>
                                            <span class="text-[11px] text-indigo-600 font-bold block mt-0.5"><?php echo e($srv->short_title); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>

                            <!-- Category -->
                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-extrabold bg-purple-50 text-purple-700 border border-purple-200/60">
                                    <?php echo e($srv->category); ?>

                                </span>
                            </td>

                            <!-- Charge / Fee -->
                            <td class="py-4 px-6">
                                <?php if($srv->service_charge == 0): ?>
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Free Service
                                    </span>
                                <?php else: ?>
                                    <span class="font-extrabold text-slate-900 text-xs">₹<?php echo e(number_format($srv->service_charge, 2)); ?></span>
                                <?php endif; ?>
                            </td>

                            <!-- Availability & Location -->
                            <td class="py-4 px-6">
                                <span class="font-semibold text-slate-800 block">🕒 <?php echo e($srv->availability ?: 'Standard Hours'); ?></span>
                                <span class="text-[11px] text-slate-400 font-normal block mt-0.5">📍 <?php echo e($srv->location ?: 'Pan Trust Locations'); ?></span>
                            </td>

                            <!-- Contact -->
                            <td class="py-4 px-6">
                                <span class="font-bold text-slate-800 block"><?php echo e($srv->contact_person ?: 'Support Team'); ?></span>
                                <span class="text-[11px] text-slate-400 font-normal block mt-0.5">📞 <?php echo e($srv->contact_phone ?: 'N/A'); ?></span>
                            </td>

                            <!-- Status Badge -->
                            <td class="py-4 px-6">
                                <?php if($srv->status === 'active'): ?>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        ● Active
                                    </span>
                                <?php elseif($srv->status === 'inactive'): ?>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-slate-100 text-slate-600 border border-slate-200">
                                        ○ Inactive
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-amber-50 text-amber-700 border border-amber-200">
                                        ⏳ Upcoming
                                    </span>
                                <?php endif; ?>
                            </td>

                            <!-- Action Buttons -->
                            <td class="py-4 px-6 text-right space-x-2">
                                <a href="<?php echo e(route('admin.services.edit', $srv)); ?>" 
                                   class="inline-block px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-bold border border-slate-200 transition-all">
                                    Edit
                                </a>

                                <form method="POST" action="<?php echo e(route('admin.services.destroy', $srv)); ?>" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this service?')">
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
                                    <div class="text-3xl">🧰</div>
                                    <p class="text-xs font-bold text-slate-700">No services added yet.</p>
                                    <p class="text-[11px] text-slate-400">Click '+ Add Service' above to create your first community service.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <?php if($services->hasPages()): ?>
            <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                <?php echo e($services->links()); ?>

            </div>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Sowmiya\OneDrive\Documents\GitHub\lumina\lumina_admin\resources\views/admin/services/index.blade.php ENDPATH**/ ?>