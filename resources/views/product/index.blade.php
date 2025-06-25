<x-app-layout>
    <div class="max-w-2xl mx-auto p-6 bg-white dark:bg-gray-800 rounded shadow-md transition-colors duration-300">
        <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">Add New Product</h2>

        @if (session('success'))
            <div class="bg-green-500 dark:bg-green-500 text-green-800 dark:text-green-400 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('products.store') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Product Name</label>
                <input type="text" name="name" id="name"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <div class="mb-4">
                <label for="purchase_price" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Purchase Price</label>
                <input type="number" name="purchase_price" id="purchase_price"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <div class="mb-4">
                <label for="sell_price" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Sell Price</label>
                <input type="number" name="sell_price" id="sell_price"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <div class="mb-4">
                <label for="stock" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Opening Stock</label>
                <input type="number" name="stock" id="stock"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                Save Product
            </button>
        </form>
    </div>
</x-app-layout>
