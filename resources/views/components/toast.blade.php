<!-- resources/views/components/toast.blade.php -->
<div x-data="{ show: false, message: '{{ session('toast') }}' }" x-init="if (message) {
    show = true;
    setTimeout(() => show = false, 2000);
}" x-show="show"
    x-transition:enter="transform ease-out duration-300 transition" x-transition:enter-start="opacity-0 translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transform ease-in duration-300 transition"
    x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
    class="fixed bottom-5 right-5 backdrop-blur-xl bg-green-400/20 text-white px-4 py-2 rounded-lg shadow-lg max-w-xs"
    style="display: none;">
    {{ session('toast') }}
</div>
