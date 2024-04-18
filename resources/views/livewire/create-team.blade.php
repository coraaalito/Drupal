<div>
    <form wire:submit="create">
        {{ $this->form }}
        
        <div class="container w-full flex justify-center">
            <button type="submit" class="bg-blue-800 px-20 py-5 m-4 text-lg font-bold font-mono
                        rounded-lg justify-center text-white hover:bg-lime-700">
                Registrar 
            </button>
        </div>      
    </form>
    
    <x-filament-actions::modals />
</div>
