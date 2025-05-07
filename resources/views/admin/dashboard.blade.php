<x-dashboard-layout>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
        <div class="bg-blue-100 text-blue-900 rounded-xl shadow-md p-6 flex flex-col items-start">
            <h2 class="text-lg font-semibold">Total Interns</h2>
            <span class="text-4xl font-bold mt-2">{{ $totalInterns }}</span>
        </div>

        <div class="bg-red-100 text-red-900 rounded-xl shadow-md p-6 flex flex-col items-start">
            <h2 class="text-lg font-semibold">Total Admins</h2>
            <span class="text-4xl font-bold mt-2">{{ $totalAdmins }}</span>
        </div>

        <div class="bg-green-100 text-green-900 rounded-xl shadow-md p-6 flex flex-col items-start">
            <h2 class="text-lg font-semibold">Total Tasks</h2>
            <span class="text-4xl font-bold mt-2">{{ $totalTasks }}</span>
        </div>

        <div class="bg-yellow-100 text-yellow-900 rounded-xl shadow-md p-6 flex flex-col items-start">
            <h2 class="text-lg font-semibold">Total Completed Tasks</h2>
            <span class="text-4xl font-bold mt-2">{{ $totalCompletedTasks }}</span>
        </div>

        <div class="bg-purple-100 text-purple-900 rounded-xl shadow-md p-6 flex flex-col items-start">
            <h2 class="text-lg font-semibold">Total In Progress Tasks</h2>
            <span class="text-4xl font-bold mt-2">{{ $totalInProgressTasks }}</span>
        </div>

        <div class="bg-gray-200 text-gray-900 rounded-xl shadow-md p-6 flex flex-col items-start">
            <h2 class="text-lg font-semibold">Total Pending Tasks</h2>
            <span class="text-4xl font-bold mt-2">{{ $totalPendingTasks }}</span>
        </div>
    </div>
</x-dashboard-layout>