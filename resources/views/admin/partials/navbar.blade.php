<header class="bg-white shadow p-4 flex justify-between items-center">
    <h2 class="text-lg font-semibold text-gray-800">@yield('title','Panel de Administración')</h2>
    <div class="text-gray-700"> {{ auth()->guard('admin')->user()->name ?? 'Admin' }} </div>
</header>
