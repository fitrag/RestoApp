<div class="container mx-auto p-4">
    <!-- Promo Section -->
    <div class="bg-orange-500 text-white p-4 rounded-lg mb-4 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold">New Year's Sales!!</h2>
            <p>Many Discount!</p>
        </div>
        <div class="flex items-center">
            <p class="mr-4">Discount Up To</p>
            <span class="bg-yellow-500 px-4 py-2 rounded-full text-xl font-bold">30%</span>
        </div>
        <img src="https://img.pikbest.com/backgrounds/20190227/brown-simple-flat-food-banner-background_1867052.jpg!sw800" alt="Promo Food" class="ml-4 w-32 h-20 object-cover">
    </div>

   <!-- Search and Filter Section -->
   <div class="mb-4 flex items-center">
        <div class="relative w-full">
            <input type="text" placeholder="Search menu..." class="border border-gray-300 p-2 rounded-lg w-full pl-10">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
        <button class="bg-orange-500 text-white px-4 py-2 rounded-lg ml-4 flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414A1 1 0 0012 10.586V17a1 1 0 01-1 1h-2a1 1 0 01-1-1v-2.586a1 1 0 00-.293-.707L7.293 7.293A1 1 0 017 6.586V4a1 1 0 011-1z" />
            </svg>
            <span>Filter</span>
        </button>
    </div>

    <!-- Category Buttons -->
    <div class="mb-8 flex overflow-x-auto space-x-2">
        <button class="bg-orange-500 text-white px-4 py-2 rounded-lg">Pizza</button>
        <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">Burger</button>
        <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">Drinks</button>
        <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">Meat</button>
        <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">Sushi</button>
        <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">Pop Corn</button>
    </div>

    <!-- Menu Items Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($items as $item)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105">
                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ $item['name'] }}</h3>
                            <p class="text-orange-500 font-bold text-xl">${{ number_format($item['price'], 2) }}</p>
                        </div>
                        <div>
                        <button class="bg-orange-500 text-white px-4 py-2 rounded-full hover:bg-orange-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>