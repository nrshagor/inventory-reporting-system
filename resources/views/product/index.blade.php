<x-app-layout>
    <div class="max-w-5xl mx-auto p-6 space-y-8">
        {{-- Add New Product --}}
        <div class="bg-white dark:bg-gray-800 rounded shadow-md p-6 transition-colors duration-300">
            <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">Add New Product</h2>

            @if (session('success'))
                <div class="bg-green-100 dark:bg-green-600 text-green-800 dark:text-green-100 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('products.store') }}">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Product Name</label>
                        <input type="text" name="name" id="name" required
                            class="w-full border border-gray-300 dark:border-gray-600 rounded px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="purchase_price" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Purchase Price</label>
                        <input type="number" name="purchase_price" id="purchase_price" required
                            class="w-full border border-gray-300 dark:border-gray-600 rounded px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="sell_price" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Sell Price</label>
                        <input type="number" name="sell_price" id="sell_price" required
                            class="w-full border border-gray-300 dark:border-gray-600 rounded px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="stock" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Opening Stock</label>
                        <input type="number" name="stock" id="stock" required
                            class="w-full border border-gray-300 dark:border-gray-600 rounded px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring focus:ring-blue-500">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded focus:ring focus:ring-blue-500">
                        Save Product
                    </button>
                </div>
            </form>
        </div>

        {{-- Product List --}}
        <div class="bg-white dark:bg-gray-800 rounded shadow-md p-6 transition-colors duration-300">
            <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">Product List</h2>

            @if(count($products) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold">#</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold">Name</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold">Purchase Price</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold">Sell Price</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold">Stock</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100">
                            @foreach($products as $index => $product)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">{{ $product->name }}</td>
                                    <td class="px-4 py-2">{{ $product->purchase_price }} TK</td>
                                    <td class="px-4 py-2">{{ $product->sell_price }} TK</td>
                                    <td class="px-4 py-2">{{ $product->stock }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-600 dark:text-gray-300">No products found.</p>
            @endif
        </div>
    </div>
</x-app-layout>
