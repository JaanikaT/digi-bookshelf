@if (session()->has('success'))
    <div x-data="{show:true}" x-init="setTimeout(() => show = false, 1500)" x-show="show" class="fixed top-0 bg-[#97da9a] transform text-white text-lg text-center p-4 w-full z-[1000] shadow-md animate-slideUp">
        <p>{{ session('success') }}</p>
    </div>

@endif