<div>

            <!-- Logo -->
            <div class="mb-6">
                <h1 class="text-xl font-bold text-orange-600">
                    <img src="{{ $institution_logo }}" width="60" height="60" alt="">
                </h1>
            </div>

            <!-- Heading -->
            <h2 class="text-3xl font-semibold mb-2">Password Reset</h2>
            <p class="text-gray-500 mb-8">
                Reset Password.
            </p>

            <!-- Form -->
             <form wire:transition class="space-y-5" wire:submit="ResetPassword">

               
                <!-- Password -->
                <div class="relative" x-data="{showPassword: false}">
                    <input :type="showPassword ? 'text' : 'password'"
                        placeholder="Password"
                        wire:model="password"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                    <span class="absolute right-4 top-3 text-gray-400 cursor-pointer" x-on:click="showPassword = !showPassword">
                        <i x-show="!showPassword" class="fa fa-eye"></i>
                        <i x-show="showPassword" class="fa fa-eye-slash"></i>
                    </span>
                      @error('password')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Login Button -->
                <button style="background-color: {{ $institution_color }}"
                    class="w-full text-white py-3 rounded-lg font-semibold transition hover:brightness-90 cursor-pointer"
                    wire:loading.attr="disabled">
                    
                       <span wire:loading.remove>Reset Password</span>
                    <span wire:loading wire:target="ResetPassword" >
                        <i class="fa fa-spinner fa-spin"></i>
                    </span>
                </button>

            </form>

            <!-- Setup Banking -->
            <div class="mt-8 text-center text-sm text-gray-600">
                 Already have an account?
                <a href="{{ route('home', ['institution' => $institution_name]) }}" wire:navigate.hover  class="hover:underline text-gray-800">
                   Login
                </a>
            </div>

</div>