<x-filament-panels::page.simple>
    @include('recaptcha')
    <br><img class="w-full px-auto " src="{{asset('images/logocuc.png')}}" alt=""><br>
    
    <x-filament-panels::form wire:submit="authenticate">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />       
    </x-filament-panels::form>

    <div class="text-center">
        <span class="text-gray-500" > - o -</span>
    </div>

    {{-- Login with google --}}
    <x-filament::button class="w-full border border-gray-400   hover:bg-gray-100" tag="a"  color="white" href="{{route('login.google')}}">
        <div class="flex p-1">
            <img class="w-5 " src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" alt="">
            <span class="my-3 text-gray-600 border-slate-900">{{ __('Iniciar con Google') }}</span>
        </div>
    </x-filament::button>

</x-filament-panels::page.simple>
