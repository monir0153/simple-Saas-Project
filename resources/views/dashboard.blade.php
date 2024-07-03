<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div>
                        <form action="{{ route('addition') }}" method="GET-">
                            <x-input name="firstValue" class="w-16" />
                            <label class="text-3xl font-semibold">+</label>
                            <x-input name="secondValue" class="w-16" />
                            <button type="submit" class="text-3xl font-semibold px-3"> = </button>
                        </form>
                        <h2 class="text-4xl font-semibold mt-4">Total: {{ session('total') }}</h2>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
