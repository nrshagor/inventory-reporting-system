<x-app-layout>
    <div class="max-w-5xl mx-auto p-6 sm:p-10 bg-white dark:bg-gray-900 shadow rounded-lg">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">Create New Sale</h2>

        <form id="sale-form" class="space-y-6">
            @csrf

            <div id="product-rows" class="space-y-4">
                <div class="product-row flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    <select name="product_id[]" class="product-select w-full sm:w-1/2 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 px-4 py-2 rounded" required>
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} (Stock: {{ $product->stock }})</option>
                        @endforeach
                    </select>
                    <input type="number" name="quantity[]" placeholder="Quantity" class="quantity-input w-full sm:w-32 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 px-4 py-2 rounded" required>
                    <button type="button" class="remove-row text-red-600 text-xl font-bold hover:text-red-800 dark:hover:text-red-400">×</button>
                </div>
            </div>

            <button type="button" id="add-row" class="text-blue-600 dark:text-blue-400 font-semibold hover:underline">
                + Add Another Product
            </button>

            <div class="grid sm:grid-cols-2 gap-6">
                <div>
                    <label for="discount" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Discount (TK)</label>
                    <input type="number" id="discount" class="w-full border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 px-4 py-2 rounded" value="0">
                </div>

                <div>
                    <label for="paid_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Paid Amount (TK)</label>
                    <input type="number" id="paid_amount" class="w-full border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 px-4 py-2 rounded" required>
                </div>
            </div>

            <div class="text-sm text-red-500 mt-2" id="error-area"></div>
            <div class="text-sm text-green-500 mt-2" id="success-area"></div>

            <div class="pt-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded">
                    Submit Sale
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('add-row').addEventListener('click', () => {
            const row = document.querySelector('.product-row').cloneNode(true);
            row.querySelector('select').value = '';
            row.querySelector('input').value = '';
            document.getElementById('product-rows').appendChild(row);
        });

        document.getElementById('product-rows').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-row') && document.querySelectorAll('.product-row').length > 1) {
                e.target.parentElement.remove();
            }
        });

        document.getElementById('sale-form').addEventListener('submit', async function (e) {
            e.preventDefault();
            document.getElementById('error-area').innerText = '';
            document.getElementById('success-area').innerText = '';

            const rows = document.querySelectorAll('.product-row');
            const items = [];
            rows.forEach(row => {
                const productId = row.querySelector('select').value;
                const quantity = row.querySelector('input').value;
                if (productId && quantity > 0) {
                    items.push({ product_id: parseInt(productId), quantity: parseInt(quantity) });
                }
            });

            const body = {
                items: items,
                discount: parseFloat(document.getElementById('discount').value || 0),
                paid_amount: parseFloat(document.getElementById('paid_amount').value || 0)
            };

            const res = await fetch("/api/sales", {
                method: "POST",
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(body)
            });

            const data = await res.json();

            if (res.ok) {
                document.getElementById('success-area').innerText = 'Sale created';
                document.getElementById('sale-form').reset();
            } else {
                document.getElementById('error-area').innerText = data.error || 'Something went wrong.';
            }
        });
    </script>
</x-app-layout>
