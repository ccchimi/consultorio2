<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TurnoController extends Controller
{
    public function index(): View
    {
        // Filtrar los turnos por el usuario logueado
        $turnos = Turno::where('user_id', auth()->id())->get();
        return view('turnos.index', compact('turnos'));
    }

    public function create(): View
    {
        return view('turnos.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'dni_paciente' => 'required|numeric|exists:pacientes,dni',
            'fecha' => 'required|date|after_or_equal:today',
            'status' => 'required|in:Confirmado,Cancelado,Pendiente'
        ]);

        if (!$this->pacienteEsMayor($request->dni_paciente)) {
            return back()->withErrors(['dni_paciente' => 'El paciente debe ser mayor de 18 años para reservar un turno'])->withInput();
        }

        $turno = new Turno($request->all());
        $turno->user_id = auth()->id();
        $turno->save();

        return redirect()->route('turnos.index')->with('success', 'Turno agendado correctamente.');
    }

    public function update(Request $request, Turno $turno): RedirectResponse
    {
        if ($turno->user_id !== auth()->id()) {
            return redirect()->route('turnos.index')->with('error', 'Acceso no autorizado.');
        }

        $request->validate([
            'dni_paciente' => 'required|numeric|exists:pacientes,dni',
            'fecha' => 'required|date|after_or_equal:today',
            'status' => 'required|in:Confirmado,Cancelado,Pendiente'
        ]);

        if (!$this->pacienteEsMayor($request->dni_paciente)) {
            return back()->withErrors(['dni_paciente' => 'El paciente debe ser mayor de 18 años para reservar un turno'])->withInput();
        }

        $turno->update($request->all());

        return redirect()->route('turnos.index')->with('success', 'Turno actualizado correctamente.');
    }

    public function edit(Turno $turno): View
    {
        if ($turno->user_id !== auth()->id()) {
            return redirect()->route('turnos.index')->with('error', 'Acceso no autorizado.');
        }

        return view('turnos.edit', compact('turno'));
    }

    public function destroy(Turno $turno): RedirectResponse
    {
        if ($turno->user_id !== auth()->id()) {
            return redirect()->route('turnos.index')->with('error', 'Acceso no autorizado.');
        }

        $turno->delete();

        // Reiniciar el auto_increment para turnos
        DB::statement('ALTER TABLE turnos AUTO_INCREMENT = 1');

        return redirect()->route('turnos.index')->with('success', 'Turno cancelado.');
    }

    private function pacienteEsMayor(string $dni): bool
    {
        $paciente = Paciente::where('dni', $dni)->first();

        if (!$paciente || !$paciente->fecha_nacimiento) {
            return false;
        }

        $edad = Carbon::parse($paciente->fecha_nacimiento)->age;

        return $edad >= 18;
    }
}
