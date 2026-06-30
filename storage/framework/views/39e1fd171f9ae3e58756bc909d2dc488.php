<footer class="bg-black text-white border-t border-gray-800 mt-2">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Top Brand Section -->

        <div class="py-10 border-b border-gray-800">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                <!-- Brand -->

                <div>             


                    <a href="/" class="flex items-center space-x-2 sm:space-x-4 group">
                            <div class="flex items-center space-x-[2px]">
                                <span class="bg-white text-black font-black px-1.5 sm:px-2 py-0.5 text-base sm:text-lg tracking-tighter uppercase group-hover:bg-red-600 group-hover:text-white transition-colors">C</span>
                                <span class="bg-white text-black font-black px-1.5 sm:px-2 py-0.5 text-base sm:text-lg tracking-tighter uppercase group-hover:bg-red-600 group-hover:text-white transition-colors">B</span>
                                <span class="bg-white text-black font-black px-1.5 sm:px-2 py-0.5 text-base sm:text-lg tracking-tighter uppercase group-hover:bg-red-600 group-hover:text-white transition-colors">S</span>
                            </div>
                            <span class="text-xs sm:text-sm font-bold tracking-widest uppercase border-l border-neutral-700 pl-2 sm:pl-4 hidden sm:inline text-neutral-300 group-hover:text-white transition-colors whitespace-nowrap">
                                <?php echo e($brandName ?? 'Online Center'); ?>

                            </span>
                        </a>

                    <div class="w-16 h-1 bg-red-600 mt-3 mb-5"></div>

                    <p class="text-gray-400 leading-relaxed text-sm">

                        <?php echo e($brandDescription); ?>


                    </p>

                </div>

                <!-- Quick Links / Navigation Pages -->
                <div>
                    <h3 class="text-sm md:text-md font-bold uppercase tracking-[0.25em] text-gray-300 mb-5">
                        Navigation
                    </h3>

                    <ul class="grid grid-cols-2 gap-y-4 gap-x-6 text-[10px] font-bold uppercase tracking-widest">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <li>
                            <a href="<?php echo e(route('page.show', $page['slug'])); ?>"
                                class="relative inline-block pb-1 group transition-colors duration-200 <?php echo e(request()->is($page['slug']) ? 'text-red-500' : 'text-gray-300 hover:text-white'); ?>">
                                <?php echo e($page['title']); ?>


                                <!-- Smooth animated underline adapted for dark footer surface -->
                                <span class="absolute bottom-0 left-0 w-full h-[2.5px] bg-red-600 transform origin-left transition-transform duration-200 <?php echo e(request()->is($page['slug']) ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100'); ?>"></span>
                            </a>
                        </li>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <li class="text-gray-500 normal-case tracking-normal font-normal text-sm">
                            No pages available
                        </li>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </ul>
                </div>


                <!-- Connect -->

                <div>

                    <h3 class="text-xs font-bold uppercase tracking-[0.25em] text-gray-300 mb-5">

                        Information

                    </h3>

                    <ul class="space-y-3 text-sm">

                        <li>

                            <a
                                href="#"
                                class="text-gray-300 hover:text-white hover:underline underline-offset-4 transition-all">

                                About Us

                            </a>

                        </li>

                        <li>

                            <a
                                href="#"
                                class="text-gray-300 hover:text-white hover:underline underline-offset-4 transition-all">

                                Contact

                            </a>

                        </li>

                        <li>

                            <a
                                href="#"
                                class="text-gray-300 hover:text-white hover:underline underline-offset-4 transition-all">

                                Privacy Policy

                            </a>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

        <!-- Bottom Navigation Bar -->

        <div class="py-6">

            <div class="flex flex-wrap items-center justify-center gap-x-8 gap-y-3 text-xs uppercase font-bold tracking-wider text-gray-400">

                <!-- PASTE THIS REPLACED BLOCK -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <li>
                    <a href="<?php echo e(route('page.show', $page['slug'])); ?>"
                        class="relative inline-block pb-1 group transition-colors duration-200 <?php echo e(request()->is($page['slug']) ? 'text-red-500' : 'text-gray-300 hover:text-white'); ?>">
                        <?php echo e($page['title']); ?>


                        <!-- Smooth animated underline tracking -->
                        <span class="absolute bottom-0 left-0 w-full h-[2.5px] bg-red-600 transform origin-left transition-transform duration-200 <?php echo e(request()->is($page['slug']) ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100'); ?>"></span>
                    </a>
                </li>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <li class="text-gray-500 normal-case tracking-normal font-normal text-sm">
                    No pages available
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </div>

        </div>


        <!-- Copyright -->

        <div class="border-t border-gray-800 py-6">

            <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-gray-500">

                <p>

                    © <?php echo e($currentYear); ?> <?php echo e($brandName); ?>. All rights reserved.

                </p>

                <p>

                    Trusted News • Breaking Stories • Digital Journalism

                </p>

            </div>

        </div>

    </div>

</footer><?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views/livewire/frontend/global-page-footer.blade.php ENDPATH**/ ?>