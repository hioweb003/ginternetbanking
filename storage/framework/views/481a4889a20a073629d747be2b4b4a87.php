<?php
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
?>

<div class="w-full max-w-md">

           <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($nextpg == 1): ?>
               
                  <!-- Logo -->
            <div class="mb-6">
                <h1 class="text-xl font-bold text-orange-600">
                    <img src="<?php echo e($institution_logo); ?>" width="60" height="60" alt="">
                </h1>
            </div>

            <!-- Heading -->
            <h4 class="text-3xl font-semibold mb-2">Register</h4>
            <p class="text-gray-500 mb-8">
                Register New Account
            </p>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('success')): ?>
                    <div wire:transition class="text-green-600">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                  <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('error')): ?>
                    <div wire:transition class="text-red-600">
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            
            <!-- Form -->
             <form wire:transition class="space-y-5" wire:submit.prevent='VerifyBvnNumber'>

                <!-- Username -->
                <div>
                    <input type="text"
                        placeholder="Enter Bvn Number"
                        maxlength="11"
                        wire:model="BvnNumber"
                        class="w-full px-4 text-gray-900 py-3 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                </div>



                <!-- Login Button -->
                <button style="background-color: <?php echo e($institution_color); ?>;"
                    class="w-full text-white py-3 rounded-lg font-semibold transition hover:brightness-90"
                    wire:loading.attr="disabled">
                
                    <span wire:loading.remove>Continue</span>
                    <span wire:loading wire:target="VerifyBvnNumber" >
                        <i class="fa fa-spinner fa-spin"></i>
                    </span>
                </button>

            </form>

           <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?> 
           
           <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($nextpg == 2): ?>
               
                 <!-- Logo -->
            <div class="mb-6">
                <h1 class="text-xl font-bold text-orange-600">
                    <img src="<?php echo e($institution_logo); ?>" width="60" height="60" alt="">
                </h1>
            </div>

            <!-- Heading -->
            <h4 class="text-3xl font-semibold mb-2"> Create Profile</h4>
            <p class="text-gray-500 mb-8">
               Account profile
            </p>

            <!-- Form -->
             <form wire:transition class="space-y-5" wire:submit.prevent="profile">

                   <div>
                    <input type="text"
                        placeholder="First Name" readonly
                        wire:model='first_name'
                        class="w-full px-4 py-3 text-gray-900 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                </div>
                   <div>
                    <input type="text"
                      wire:model='last_name'
                        placeholder="Last Name" readonly
                        class="w-full px-4 py-3 text-gray-900 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                </div>

                 <div>
                    <input type="date" wire:model='dob' max='2008-12-31' min="1930-01-01"
                        placeholder="date of Birth" readonly
                        class="w-full px-4 py-3 text-gray-900 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                </div>

                <div>
                    <select wire:model='gender' class="w-full px-4 py-3 text-gray-900 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                       <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                   <div>
                    <input type="tel" wire:model='phone_number'
                        placeholder="Phone Number"
                        class="w-full px-4 py-3 text-gray-900 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                   <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                <div>
                    <input type="email"
                        placeholder="email" wire:model='email'
                        class="w-full px-4 py-3 text-gray-900 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                       <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div>
                    <input type="text"
                        placeholder="Username" wire:model.defer='username'
                        class="w-full px-4 py-3 text-gray-900 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                     <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

               

                <!-- Login Button -->
                <button style="background-color: <?php echo e($institution_color); ?>"
                    class="w-full text-white py-3 rounded-lg font-semibold transition hover:brightness-90"
                    wire:loading.attr="disabled">
                    
                       <span wire:loading.remove>Continue</span>
                    <span wire:loading wire:target="profile" >
                        <i class="fa fa-spinner fa-spin"></i>
                    </span>
                </button>

            </form>

           <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($nextpg == 3): ?>
               
                 <!-- Logo -->
            <div class="mb-6">
                <h1 class="text-xl font-bold text-orange-600">
                    <img src="<?php echo e($institution_logo); ?>" width="60" height="60" alt="">
                </h1>
            </div>

            <!-- Heading -->
            <h4 class="text-3xl font-semibold mb-2">Create Password/Pin </h4>
            <p class="text-gray-500 mb-8">
               Account Secret
            </p>

            <!-- Form -->
             <form wire:transition class="space-y-5" wire:submit.prevent="CreateAccount">

                 <!-- Password -->
                <div class="relative" x-data="{showPin: false}">
                    <input :type="showPin ? 'text' : 'password'"
                        placeholder="Pin"
                        wire:model="pin"
                        class="w-full px-4 py-3 text-gray-900 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                    <span class="absolute right-4 top-3 text-gray-400 cursor-pointer" x-on:click="showPin = !showPin">
                        <i x-show="!showPin" class="fa fa-eye"></i>
                        <i x-show="showPin" class="fa fa-eye-slash"></i>
                    </span>
                       <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['pin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                 <!-- Password -->
                <div class="relative" x-data="{showPassword: false}">
                    <input :type="showPassword ? 'text' : 'password'"
                        placeholder="Password"
                        wire:model="password"
                        class="w-full px-4 py-3 text-gray-900 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                    <span class="absolute right-4 top-3 text-gray-400 cursor-pointer" x-on:click="showPassword = !showPassword">
                        <i x-show="!showPassword" class="fa fa-eye"></i>
                        <i x-show="showPassword" class="fa fa-eye-slash"></i>
                    </span>
                       <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <!-- Login Button -->
                <button style="background-color: <?php echo e($institution_color); ?>"
                    class="w-full text-white py-3 rounded-lg font-semibold transition hover:brightness-90 cursor-pointer"
                    wire:loading.attr="disabled">
                    
                       <span wire:loading.remove>Create Account</span>
                    <span wire:loading wire:target="CreateAccount" >
                        <i class="fa fa-spinner fa-spin"></i>
                    </span>
                </button>

             </form>
             <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <!-- Setup Banking -->
            <div class="mt-8 text-center text-sm text-gray-600">
                Already have an account?
                <a href="<?php echo e(route('home', ['institution' => $institution_name])); ?>" wire:navigate.hover  class="hover:underline text-gray-800">
                    Login
                </a>
            </div>

</div><?php /**PATH /home/henry/Desktop/htdocs/grubinternetbanking/storage/framework/views/livewire/views/b337ac02.blade.php ENDPATH**/ ?>