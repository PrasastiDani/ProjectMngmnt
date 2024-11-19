<div class="inline-flex rounded-md shadow-sm" role="group">
    <a href="{{ route('transaction.index', ['filter' => 'all']) }}"
        class="px-4 py-2 text-sm font-medium text-gray-900 {{ $filter == 'all' ? 'bg-green-100' : 'bg-white' }} border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-green-500 focus:z-10 focus:ring-2 focus:ring-green-500 focus:text-green-500">
        All
    </a>
    <a href="{{ route('transaction.index', ['filter' => 'new']) }}"
        class="px-4 py-2 text-sm font-medium text-gray-900 {{ $filter == 'new' ? 'bg-green-100' : 'bg-white' }} border-t border-b border-gray-200 hover:bg-gray-100 hover:text-green-500 focus:z-10 focus:ring-2 focus:ring-green-500 focus:text-green-500">
        New
    </a>
    <a href="{{ route('transaction.index', ['filter' => 'passed']) }}"
        class="px-4 py-2 text-sm font-medium text-gray-900 {{ $filter == 'passed' ? 'bg-green-100' : 'bg-white' }} border border-gray-200 rounded-r-lg hover:bg-gray-100 hover:text-green-500 focus:z-10 focus:ring-2 focus:ring-green-500 focus:text-green-500">
        Passed
    </a>
</div>
