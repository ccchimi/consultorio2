<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            Agendar Turno
        </h2>
    </x-slot>

    <div class="py-6 px-4" x-data="{ tab: 'paciente' }">
        <div class="flex space-x-4 mb-6 border-b border-gray-300 dark:border-gray-700">
            <button @click="tab = 'paciente'" :class="tab === 'paciente' ? 'border-b-2 border-indigo-600 text-indigo-600' : 'text-gray-500'" class="pb-2 font-semibold">
                Datos del paciente
            </button>
            <button @click="tab = 'turno'" :class="tab === 'turno' ? 'border-b-2 border-indigo-600 text-indigo-600' : 'text-gray-500'" class="pb-2 font-semibold">
                Información del turno
            </button>
        </div>

        <form action="{{ route('turnos.store') }}" method="POST" class="space-y-4">
            @csrf

            <div x-show="tab === 'paciente'" x-transition>
                <div>
                    <label class="block text-sm font-semibold text-white mb-1">DNI del Paciente</label>
                    <input type="text" name="dni_paciente" class="w-full px-4 py-2 bg-white/70 text-black border border-gray-300 rounded-md focus:ring-indigo-500 focus:outline-none" value="{{ old('dni_paciente') }}" required>
                    @error('dni_paciente') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div x-show="tab === 'turno'" x-transition>
                <div>
                    <label class="block text-sm font-semibold text-white mb-1">Fecha del Turno</label>
                    <input type="date" name="fecha" class="w-full px-4 py-2 bg-white/70 text-black border border-gray-300 rounded-md focus:ring-indigo-500 focus:outline-none" value="{{ old('fecha') }}" required>
                    @error('fecha') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-white mb-1">Estado</label>
                    <select name="status" class="form-select w-full bg-white/70 text-black border border-gray-300 rounded-md" required>
                        <option value="Pendiente" {{ old('status') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="Confirmado" {{ old('status') == 'Confirmado' ? 'selected' : '' }}>Confirmado</option>
                        <option value="Cancelado" {{ old('status') == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                    @error('status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex justify-between mt-4">
                <a href="{{ route('turnos.index') }}" class="btn bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancelar</a>
                <button type="submit" class="btn bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Guardar</button>
            </div>
        </form>
    </div>
</x-app-layout>
