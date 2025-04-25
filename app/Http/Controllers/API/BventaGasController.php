<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BventaGas; 
use Illuminate\Http\Request;

class BventaGasController extends Controller
{
  public function activate(Request $request)
    {
      // Validamos la entrada
      $request->validate([
          'key' => 'required|string|size:6',  // El código debe ser de 6 caracteres
          'machine_id' => 'required|string', // Necesitamos el ID de la máquina
      ]);

      $key = $request->input('key');
      $machineId = $request->input('machine_id');

      // Buscar la licencia
      $venta = BventaGas::where('key', $key)->first();

      // Si no encontramos la licencia, respondemos con error
      if (!$venta) {
          return response()->json(['status' => 'error', 'message' => 'Código inválido']);
      }

      // Comprobamos si la licencia ya fue usada en otra máquina
      if ($venta->is_used && $venta->machine_id !== $machineId) {
          return response()->json(['status' => 'error', 'message' => 'Código ya usado en otro dispositivo']);
      }

      // Si el pago no está completo, no permitimos la activación
      if (!$venta->is_fully_paid) {
          return response()->json(['status' => 'error', 'message' => 'Pago incompleto. Comunicate para finalizar.']);
      }

      // Si la licencia no ha sido activada aún, la activamos
      if (!$venta->is_used) {
          $venta->update([
              'is_used' => true,
              'machine_id' => $machineId,
              'ip_address' => $request->ip(), // Guardamos la IP del cliente
              'activated_at' => now(), // Fecha y hora de activación
          ]);
      }

      // Si la licencia ya está activa, devolvemos un mensaje indicando que ya se activó
      return response()->json(['status' => 'success', 'message' => 'Licencia activada correctamente.']);
  }
}
