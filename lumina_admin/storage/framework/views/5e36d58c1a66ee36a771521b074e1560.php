<?php $__env->startSection('title', 'Add New Activity'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Top Navigation Breadcrumb & Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="<?php echo e(route('admin.activities.index')); ?>" class="inline-flex items-center space-x-2 text-xs font-bold text-slate-400 hover:text-orange-400 transition-colors mb-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Back to Activities List</span>
            </a>
            <h2 class="text-2xl font-black text-white tracking-tight">Create New Activity</h2>
            <p class="text-xs text-slate-400 mt-0.5">Fill in the fields below to publish a project, event, or community drive.</p>
        </div>
    </div>

    <!-- Form Container -->
    <form method="POST" action="<?php echo e(route('admin.activities.store')); ?>" enctype="multipart/form-data" class="space-y-6">
        <?php echo csrf_field(); ?>

        <!-- 1. General & Categorization Section -->
        <div class="bg-[#0f172a] border border-slate-800 rounded-2xl p-6 shadow-xl space-y-6">
            <h3 class="text-sm font-extrabold text-orange-400 uppercase tracking-wider flex items-center space-x-2">
                <span>📌</span>
                <span>Basic Information</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-xs font-extrabold text-slate-300 uppercase tracking-wider mb-2">
                        Activity Title <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="<?php echo e(old('title')); ?>" 
                           placeholder="e.g. Book & Stationery Distribution Drive" 
                           required 
                           class="w-full px-4 py-2.5 bg-[#0b0f19] border border-slate-800 rounded-xl text-xs font-medium text-slate-200 focus:outline-none focus:border-orange-500/50">
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-rose-400 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Short Title -->
                <div>
                    <label for="short_title" class="block text-xs font-extrabold text-slate-300 uppercase tracking-wider mb-2">
                        Short Title / Tagline
                    </label>
                    <input type="text" 
                           name="short_title" 
                           id="short_title" 
                           value="<?php echo e(old('short_title')); ?>" 
                           placeholder="e.g. Empowering 200+ Students" 
                           class="w-full px-4 py-2.5 bg-[#0b0f19] border border-slate-800 rounded-xl text-xs font-medium text-slate-200 focus:outline-none focus:border-orange-500/50">
                    <?php $__errorArgs = ['short_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-rose-400 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-xs font-extrabold text-slate-300 uppercase tracking-wider mb-2">
                        Category <span class="text-rose-500">*</span>
                    </label>
                    <select name="category" 
                            id="category" 
                            required 
                            class="w-full px-4 py-2.5 bg-[#0b0f19] border border-slate-800 rounded-xl text-xs font-medium text-slate-200 focus:outline-none focus:border-orange-500/50">
                        <option value="Education" <?php echo e(old('category') == 'Education' ? 'selected' : ''); ?>>Education</option>
                        <option value="Health" <?php echo e(old('category') == 'Health' ? 'selected' : ''); ?>>Health</option>
                        <option value="Environment" <?php echo e(old('category') == 'Environment' ? 'selected' : ''); ?>>Environment</option>
                        <option value="Water" <?php echo e(old('category') == 'Water' ? 'selected' : ''); ?>>Water</option>
                    </select>
                    <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-rose-400 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-xs font-extrabold text-slate-300 uppercase tracking-wider mb-2">
                        Status <span class="text-rose-500">*</span>
                    </label>
                    <select name="status" 
                            id="status" 
                            required 
                            class="w-full px-4 py-2.5 bg-[#0b0f19] border border-slate-800 rounded-xl text-xs font-medium text-slate-200 focus:outline-none focus:border-orange-500/50">
                        <option value="active" <?php echo e(old('status', 'active') == 'active' ? 'selected' : ''); ?>>Active</option>
                        <option value="completed" <?php echo e(old('status') == 'completed' ? 'selected' : ''); ?>>Completed</option>
                        <option value="upcoming" <?php echo e(old('status') == 'upcoming' ? 'selected' : ''); ?>>Upcoming</option>
                    </select>
                    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-rose-400 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-xs font-extrabold text-slate-300 uppercase tracking-wider mb-2">
                        Location
                    </label>
                    <input type="text" 
                           name="location" 
                           id="location" 
                           value="<?php echo e(old('location')); ?>" 
                           placeholder="e.g. Primary School, Govt Sector 4" 
                           class="w-full px-4 py-2.5 bg-[#0b0f19] border border-slate-800 rounded-xl text-xs font-medium text-slate-200 focus:outline-none focus:border-orange-500/50">
                    <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-rose-400 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        <!-- 2. Event Logistics & Financial Targets -->
        <div class="bg-[#0f172a] border border-slate-800 rounded-2xl p-6 shadow-xl space-y-6">
            <h3 class="text-sm font-extrabold text-sky-400 uppercase tracking-wider flex items-center space-x-2">
                <span>📊</span>
                <span>Logistics & Fundraising Targets</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Date -->
                <div>
                    <label for="date" class="block text-xs font-extrabold text-slate-300 uppercase tracking-wider mb-2">
                        Event Date
                    </label>
                    <input type="date" 
                           name="date" 
                           id="date" 
                           value="<?php echo e(old('date')); ?>" 
                           class="w-full px-4 py-2.5 bg-[#0b0f19] border border-slate-800 rounded-xl text-xs font-medium text-slate-200 focus:outline-none focus:border-sky-500/50">
                    <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-rose-400 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Time -->
                <div>
                    <label for="time" class="block text-xs font-extrabold text-slate-300 uppercase tracking-wider mb-2">
                        Time Slot / Schedule
                    </label>
                    <input type="text" 
                           name="time" 
                           id="time" 
                           value="<?php echo e(old('time')); ?>" 
                           placeholder="e.g. 09:00 AM - 04:00 PM" 
                           class="w-full px-4 py-2.5 bg-[#0b0f19] border border-slate-800 rounded-xl text-xs font-medium text-slate-200 focus:outline-none focus:border-sky-500/50">
                    <?php $__errorArgs = ['time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-rose-400 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Participants -->
                <div>
                    <label for="participants" class="block text-xs font-extrabold text-slate-300 uppercase tracking-wider mb-2">
                        Participants / Volunteers
                    </label>
                    <input type="text" 
                           name="participants" 
                           id="participants" 
                           value="<?php echo e(old('participants')); ?>" 
                           placeholder="e.g. 50+ Volunteers & 200 Students" 
                           class="w-full px-4 py-2.5 bg-[#0b0f19] border border-slate-800 rounded-xl text-xs font-medium text-slate-200 focus:outline-none focus:border-sky-500/50">
                    <?php $__errorArgs = ['participants'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-rose-400 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Progress % -->
                <div>
                    <label for="progress_percent" class="block text-xs font-extrabold text-slate-300 uppercase tracking-wider mb-2">
                        Progress Percentage (%)
                    </label>
                    <input type="number" 
                           name="progress_percent" 
                           id="progress_percent" 
                           min="0" 
                           max="100" 
                           value="<?php echo e(old('progress_percent', 0)); ?>" 
                           class="w-full px-4 py-2.5 bg-[#0b0f19] border border-slate-800 rounded-xl text-xs font-medium text-slate-200 focus:outline-none focus:border-sky-500/50">
                    <?php $__errorArgs = ['progress_percent'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-rose-400 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Raised Amount -->
                <div>
                    <label for="raised_amount" class="block text-xs font-extrabold text-slate-300 uppercase tracking-wider mb-2">
                        Raised Amount (₹)
                    </label>
                    <input type="number" 
                           step="0.01" 
                           name="raised_amount" 
                           id="raised_amount" 
                           value="<?php echo e(old('raised_amount', 0)); ?>" 
                           placeholder="0.00" 
                           class="w-full px-4 py-2.5 bg-[#0b0f19] border border-slate-800 rounded-xl text-xs font-medium text-slate-200 focus:outline-none focus:border-sky-500/50">
                    <?php $__errorArgs = ['raised_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-rose-400 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Goal Amount -->
                <div>
                    <label for="goal_amount" class="block text-xs font-extrabold text-slate-300 uppercase tracking-wider mb-2">
                        Goal Amount (₹)
                    </label>
                    <input type="number" 
                           step="0.01" 
                           name="goal_amount" 
                           id="goal_amount" 
                           value="<?php echo e(old('goal_amount', 0)); ?>" 
                           placeholder="0.00" 
                           class="w-full px-4 py-2.5 bg-[#0b0f19] border border-slate-800 rounded-xl text-xs font-medium text-slate-200 focus:outline-none focus:border-sky-500/50">
                    <?php $__errorArgs = ['goal_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-rose-400 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        <!-- 3. Descriptions, Objectives, Highlights & Quotes -->
        <div class="bg-[#0f172a] border border-slate-800 rounded-2xl p-6 shadow-xl space-y-6">
            <h3 class="text-sm font-extrabold text-amber-400 uppercase tracking-wider flex items-center space-x-2">
                <span>📝</span>
                <span>Descriptions & Content</span>
            </h3>

            <div class="space-y-6">
                <!-- Short Description -->
                <div>
                    <label for="description" class="block text-xs font-extrabold text-slate-300 uppercase tracking-wider mb-2">
                        Short Summary / Description
                    </label>
                    <textarea name="description" 
                              id="description" 
                              rows="2" 
                              placeholder="Brief overview displayed on cards and list items..." 
                              class="w-full px-4 py-2.5 bg-[#0b0f19] border border-slate-800 rounded-xl text-xs font-medium text-slate-200 focus:outline-none focus:border-amber-500/50"><?php echo e(old('description')); ?></textarea>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-rose-400 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Full Description -->
                <div>
                    <label for="full_description" class="block text-xs font-extrabold text-slate-300 uppercase tracking-wider mb-2">
                        Full Detailed Description
                    </label>
                    <textarea name="full_description" 
                              id="full_description" 
                              rows="5" 
                              placeholder="Complete story, background, and implementation details of this activity..." 
                              class="w-full px-4 py-2.5 bg-[#0b0f19] border border-slate-800 rounded-xl text-xs font-medium text-slate-200 focus:outline-none focus:border-amber-500/50"><?php echo e(old('full_description')); ?></textarea>
                    <?php $__errorArgs = ['full_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-rose-400 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Objectives -->
                    <div>
                        <label for="objectives" class="block text-xs font-extrabold text-slate-300 uppercase tracking-wider mb-2">
                            Key Objectives
                        </label>
                        <textarea name="objectives" 
                                  id="objectives" 
                                  rows="3" 
                                  placeholder="List key targets or goals..." 
                                  class="w-full px-4 py-2.5 bg-[#0b0f19] border border-slate-800 rounded-xl text-xs font-medium text-slate-200 focus:outline-none focus:border-amber-500/50"><?php echo e(old('objectives')); ?></textarea>
                        <?php $__errorArgs = ['objectives'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-rose-400 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Highlights -->
                    <div>
                        <label for="highlights" class="block text-xs font-extrabold text-slate-300 uppercase tracking-wider mb-2">
                            Key Highlights
                        </label>
                        <textarea name="highlights" 
                                  id="highlights" 
                                  rows="3" 
                                  placeholder="Notable achievements or stats..." 
                                  class="w-full px-4 py-2.5 bg-[#0b0f19] border border-slate-800 rounded-xl text-xs font-medium text-slate-200 focus:outline-none focus:border-amber-500/50"><?php echo e(old('highlights')); ?></textarea>
                        <?php $__errorArgs = ['highlights'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-rose-400 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Quote -->
                    <div>
                        <label for="quote" class="block text-xs font-extrabold text-slate-300 uppercase tracking-wider mb-2">
                            Featured Quote / Testimonial
                        </label>
                        <textarea name="quote" 
                                  id="quote" 
                                  rows="3" 
                                  placeholder="Inspiring quote from a beneficiary or leader..." 
                                  class="w-full px-4 py-2.5 bg-[#0b0f19] border border-slate-800 rounded-xl text-xs font-medium text-slate-200 focus:outline-none focus:border-amber-500/50"><?php echo e(old('quote')); ?></textarea>
                        <?php $__errorArgs = ['quote'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-rose-400 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Media & Gallery Images -->
        <div class="bg-[#0f172a] border border-slate-800 rounded-2xl p-6 shadow-xl space-y-6">
            <h3 class="text-sm font-extrabold text-emerald-400 uppercase tracking-wider flex items-center space-x-2">
                <span>🖼️</span>
                <span>Media & Images</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Main Image File Input -->
                <div>
                    <label for="main_image" class="block text-xs font-extrabold text-slate-300 uppercase tracking-wider mb-2">
                        Main Activity Cover Image
                    </label>
                    <input type="file" 
                           name="main_image" 
                           id="main_image" 
                           accept="image/*" 
                           class="w-full px-4 py-2 bg-[#0b0f19] border border-slate-800 rounded-xl text-xs text-slate-400 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-orange-500 file:text-white hover:file:bg-orange-600 cursor-pointer">
                    <p class="text-[11px] text-slate-500 mt-1">Recommended size: 800x600px. Supports JPG, PNG, WEBP up to 4MB.</p>
                    <?php $__errorArgs = ['main_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-rose-400 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Gallery Images List / URLs -->
                <div>
                    <label for="gallery_images" class="block text-xs font-extrabold text-slate-300 uppercase tracking-wider mb-2">
                        Gallery Image Links (Comma or newline separated)
                    </label>
                    <textarea name="gallery_images" 
                              id="gallery_images" 
                              rows="3" 
                              placeholder="https://images.unsplash.com/photo-1..., https://..." 
                              class="w-full px-4 py-2.5 bg-[#0b0f19] border border-slate-800 rounded-xl text-xs font-medium text-slate-200 focus:outline-none focus:border-emerald-500/50"><?php echo e(old('gallery_images')); ?></textarea>
                    <?php $__errorArgs = ['gallery_images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-rose-400 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        <!-- Submit & Cancel Action Buttons -->
        <div class="flex items-center justify-end space-x-4 pt-2">
            <a href="<?php echo e(route('admin.activities.index')); ?>" 
               class="px-6 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold rounded-xl border border-slate-700 transition-all">
                Cancel
            </a>
            <button type="submit" 
                    class="px-6 py-2.5 bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white text-xs font-extrabold rounded-xl shadow-lg shadow-orange-500/25 transition-all">
                Save & Publish Activity
            </button>
        </div>

    </form>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Sowmiya\OneDrive\Documents\GitHub\lumina\lumina_admin\resources\views/admin/activities/create.blade.php ENDPATH**/ ?>