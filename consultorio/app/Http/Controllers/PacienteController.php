<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class PacienteController extends Controller
{
    public function index(): View
    {
        $pacientes = Paciente::where('user_id', auth()->id())->get();
        return view('pacientes.index', compact('pacientes'));
    }

    public function create(): View
    {
        return view('pacientes.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required',
            'dni' => 'required|numeric|unique:pacientes,dni',
            'email' => 'required|email|unique:pacientes,email',
            'telefono' => 'required'
        ]);

        $paciente = new Paciente($request->all());
        $paciente->user_id = auth()->id();
        $paciente->save();

        return redirect()->route('pacientes.index')->with('success', 'Paciente registrado correctamente.');
    }

    public function edit(Paciente $paciente): View
    {
        if ($paciente->user_id !== auth()->id()) {
            return redirect()->route('pacientes.index')->with('error', 'Acceso no autorizado.');
        }

        return view('pacientes.edit', compact('paciente'));
    }

    public function update(Request $request, Paciente $paciente): RedirectResponse
    {
        if ($paciente->user_id !== auth()->id()) {
            return redirect()->route('pacientes.index')->with('error', 'Acceso no autorizado.');
        }

        $request->validate([
            'nombre' => 'required',
            'dni' => 'required|numeric|unique:pacientes,dni,' . $paciente->id,
            'email' => 'required|email|unique:pacientes,email,' . $paciente->id,
            'telefono' => 'required'
        ]);

        $paciente->update($request->all());

        return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado correctamente.');
    }

    public function destroy(Paciente $paciente): RedirectResponse
    {
        if ($paciente->user_id !== auth()->id()) {
            return redirect()->route('pacientes.index')->with('error', 'Acceso no autorizado.');
        }

        $paciente->delete();

        DB::statement('ALTER TABLE pacientes AUTO_INCREMENT = 1');

        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado correctamente.');
    }
}
