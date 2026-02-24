<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            Editar Paciente
        </h2>
    </x-slot>

    <div class="py-6 px-4" x-data="{ tab: 'datos' }">
        <div class="flex space-x-4 mb-6 border-b border-gray-300 dark:border-gray-700">
            <button @click="tab = 'datos'" :class="tab === 'datos' ? 'border-b-2 border-indigo-600 text-indigo-600' : 'text-gray-500'" class="pb-2 font-semibold">
                Datos personales
            </button>
            <button @click="tab = 'contacto'" :class="tab === 'contacto' ? 'border-b-2 border-indigo-600 text-indigo-600' : 'text-gray-500'" class="pb-2 font-semibold">
                Contacto y nacimiento
            </button>
        </div>

        <form action="{{ route('pacientes.update', $paciente) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div x-show="tab === 'datos'" x-transition>
                <div>
                    <label class="block text-sm font-semibold text-white mb-1">Nombre completo</label>
                    <input type="text" name="nombre" class="w-full px-4 py-2 bg-white/70 text-black border border-gray-300 rounded-md focus:ring-indigo-500 focus:outline-none" value="{{ old('nombre', $paciente->nombre) }}" required>
                    @error('nombre') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-white mb-1">DNI (sin puntos)</label>
                    <input type="text" name="dni" class="w-full px-4 py-2 bg-white/70 text-black border border-gray-300 rounded-md focus:ring-indigo-500 focus:outline-none" value="{{ old('dni', $paciente->dni) }}" required>
                    @error('dni') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div x-show="tab === 'contacto'" x-transition>
                <div>
                    <label class="block text-sm font-semibold text-white mb-1">Correo electrónico</label>
                    <input type="email" name="email" class="w-full px-4 py-2 bg-white/70 text-black border border-gray-300 rounded-md focus:ring-indigo-500 focus:outline-none" value="{{ old('email', $paciente->email) }}" required>
                    @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-white mb-1">Teléfono</label>
                    <input type="text" name="telefono" class="w-full px-4 py-2 bg-white/70 text-black border border-gray-300 rounded-md focus:ring-indigo-500 focus:outline-none" value="{{ old('telefono', $paciente->telefono) }}" required>
                    @error('telefono') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-white mb-1">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" class="w-full px-4 py-2 bg-white/70 text-black border border-gray-300 rounded-md focus:ring-indigo-500 focus:outline-none" value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento) }}" required>
                    @error('fecha_nacimiento') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex justify-between mt-4">
                <a href="{{ route('pacientes.index') }}" class="btn bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancelar</a>
                <button type="submit" class="btn bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Actualizar</button>
            </div>
        </form>
    </div>
</x-app-layout>
