<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            Pacientes
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <a href="{{ route('pacientes.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Agregar Paciente
        </a>

        <table class="mt-6 w-full border border-gray-300 bg-white shadow rounded">
            <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">Nombre</th>
                <th class="px-4 py-2 border">DNI</th>
                <th class="px-4 py-2 border">Email</th>
                <th class="px-4 py-2 border">Teléfono</th>
                <th class="px-4 py-2 border">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($pacientes as $paciente)
                <tr>
                    <td class="border px-4 py-2">{{ $paciente->id }}</td>
                    <td class="border px-4 py-2">{{ $paciente->nombre }}</td>
                    <td class="border px-4 py-2">{{ $paciente->dni }}</td>
                    <td class="border px-4 py-2">{{ $paciente->email }}</td>
                    <td class="border px-4 py-2">{{ $paciente->telefono }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('pacientes.edit', $paciente) }}" class="text-blue-600">Editar</a>
                        <form action="{{ route('pacientes.destroy', $paciente) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 ml-2">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-4 py-2 text-center">No hay pacientes registrados.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
