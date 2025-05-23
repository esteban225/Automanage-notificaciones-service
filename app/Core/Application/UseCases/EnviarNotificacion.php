<?php

// Define el espacio de nombres (namespace) donde está ubicada esta clase.
// Esto permite organizar el código según su responsabilidad.
namespace App\Core\Application\UseCases;

// Importa la clase Notificacion del dominio.
use App\Core\Domain\Entities\Notificacion;

/**
 * Interfaz que define el contrato para un servicio de envío de notificaciones.
 * Cualquier clase que implemente esta interfaz debe definir el método enviar().
 */
interface NotificacionServiceInterface
{
    /**
     * Método para enviar una notificación.
     *
     * @param Notificacion $notificacion Instancia de la notificación a enviar.
     */
    public function enviar(Notificacion $notificacion): void;
}

/**
 * Caso de uso "EnviarNotificacion"
 * Orquesta la acción de enviar una notificación usando una implementación concreta
 * del servicio de notificaciones (por ejemplo, via RabbitMQ, Email, etc.).
 */
class EnviarNotificacion
{
    /**
     * Constructor que recibe una implementación del servicio de notificación.
     * Utiliza inyección de dependencias para mayor flexibilidad y testeo.
     *
     * @param NotificacionServiceInterface $notificacionService
     */
    public function __construct(
        private NotificacionServiceInterface $notificacionService
    ) {}

    /**
     * Ejecuta el caso de uso, delegando la lógica de envío a la implementación del servicio.
     *
     * @param Notificacion $notificacion La notificación que se desea enviar.
     */
    public function ejecutar(Notificacion $notificacion): void
    {
        // Aquí se aplica la lógica para enviar la notificación
        $this->notificacionService->enviar($notificacion);
    }
}
