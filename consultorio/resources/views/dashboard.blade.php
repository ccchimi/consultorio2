<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Consultorio') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-6">

            <a href="{{ route('pacientes.index') }}" class="block bg-blue-600 text-white p-6 rounded-lg shadow hover:bg-blue-700 transition">
                <h3 class="text-2xl font-bold">Pacientes</h3>
                <p class="mt-2">Gestionar pacientes: ver, crear, editar, eliminar</p>
            </a>

            <a href="{{ route('turnos.index') }}" class="block bg-green-600 text-white p-6 rounded-lg shadow hover:bg-green-700 transition">
                <h3 class="text-2xl font-bold">Turnos</h3>
                <p class="mt-2">Gestionar turnos: ver, agendar, modificar, cancelar</p>
            </a>

        </div>
    </div>
</x-app-layout>
