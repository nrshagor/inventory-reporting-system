<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 sm:p-10 bg-white dark:bg-gray-900 shadow rounded-lg">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">Financial Report</h2>

        <form id="report-form" class="grid sm:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">From</label>
                <input type="date" id="from" name="from" class="w-full border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 px-4 py-2 rounded" required>
            </div>
            <div>
                <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">To</label>
                <input type="date" id="to" name="to" class="w-full border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 px-4 py-2 rounded" required>
            </div>
            <div class="sm:col-span-2">
                <button type="submit" class="mt-2 bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white px-6 py-2 rounded">
                    Generate Report
                </button>
            </div>
        </form>

        <div id="report-result" class="space-y-2 text-gray-800 dark:text-gray-100">
            <!-- Results will appear here -->
        </div>
    </div>

    <script>
        document.getElementById('report-form').addEventListener('submit', async function (e) {
            e.preventDefault();

            const from = document.getElementById('from').value;
            const to = document.getElementById('to').value;

            if (!from || !to) return;

            const res = await fetch(`/api/report?from=${from}&to=${to}`);
            const data = await res.json();

            const resultDiv = document.getElementById('report-result');
            resultDiv.innerHTML = `
                <div><strong>Total Sales:</strong> ${data.total_sales ?? 0} TK</div>
                <div><strong>Total Expenses:</strong> ${data.total_expenses ?? 0} TK</div>
                <div><strong>Profit:</strong> ${data.profit ?? 0} TK</div>
            `;
        });
    </script>
</x-app-layout>
