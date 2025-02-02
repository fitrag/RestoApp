<div class="bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-4 text-gray-800">Counter: {{ $count }}</h1>
    <button 
        wire:click="increment"
        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
    >
        Tambah +1
    </button>
</div>