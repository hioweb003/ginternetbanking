<div>
            <!-- Logo -->
            <div class="mb-6">
                <h1 class="text-xl font-bold text-orange-600">
                    <img src="{{ $institution_logo }}" width="60" height="60" alt="">
                </h1>
            </div>

            <!-- Heading -->
            <h2 class="text-3xl font-semibold mb-2">Register</h2>
            <p class="text-gray-500 mb-8">
                Register New Account
            </p>
          @if (session()->has('success'))
                    <div class="text-green-600">
                        {{ session('success') }}
                    </div>
                @endif
                  @if (session()->has('error'))
                    <div class="text-red-600">
                        {{ session('error') }}
                    </div>
                @endif
            
            <!-- Form -->
             <form class="space-y-5" wire:submit.prevent='VerifyBvnNumber'>

                <!-- Username -->
                <div>
                    <input type="text"
                        placeholder="Enter Bvn Number"
                        maxlength="11"
                        wire:model="BvnNumber"
                        class="w-full px-4 text-gray-900 py-3 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                </div>



                <!-- Login Button -->
                <button style="background-color: {{ $institution_color }};"
                    class="w-full text-white py-3 rounded-lg font-semibold transition hover:brightness-90 cursor-pointer"
                    wire:loading.attr="disabled">
                
                    <span wire:loading.remove>Continue</span>
                    <span wire:loading wire:target="VerifyBvnNumber" >
                        <i class="fa fa-spinner fa-spin"></i>
                    </span>
                </button>

            </form>

            <!-- Setup Banking -->
            <div class="mt-8 text-center text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('home', ['institution' => $institution_name]) }}" class="hover:underline text-gray-800">
                    Login
                </a>
            </div>

</div>