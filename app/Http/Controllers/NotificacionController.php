<?php

namespace App\Http\Controllers;

use App\Core\Application\UseCases\EnviarNotificacion;
use App\Core\Domain\Entities\Notificacion;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    public function enviar(Request $request, EnviarNotificacion $casoUso)
    {
        $notificacion = new Notificacion(
            titulo: 'Nuevo Mensaje',
            mensaje: 'Tienes una nueva alerta',
            tipo: 'email',
            usuarioId: '123',
            fecha: new \DateTimeImmutable()
        );

        $casoUso->ejecutar($notificacion);

        return response()->json(['estado' => 'Notificación enviada']);
    }
}
