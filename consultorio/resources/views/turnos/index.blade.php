<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            Turnos
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <a href="{{ route('turnos.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Agendar Turno
        </a>

        <table class="mt-6 w-full border border-gray-300 bg-white shadow rounded">
            <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">DNI Paciente</th>
                <th class="px-4 py-2 border">Fecha</th>
                <th class="px-4 py-2 border">Estado</th>
                <th class="px-4 py-2 border">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($turnos as $turno)
                <tr>
                    <td class="border px-4 py-2">{{ $turno->id }}</td>
                    <td class="border px-4 py-2">{{ $turno->dni_paciente }}</td>
                    <td class="border px-4 py-2">{{ $turno->fecha }}</td>
                    <td class="border px-4 py-2">{{ $turno->status }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('turnos.edit', $turno) }}" class="text-blue-600">Editar</a>
                        <form action="{{ route('turnos.destroy', $turno) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 ml-2">Cancelar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-2 text-center">No hay turnos registrados.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
