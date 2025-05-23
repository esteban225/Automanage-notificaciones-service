<?php

// Define el espacio de nombres para la entidad Notificacion.
// Esto la categoriza dentro del núcleo del dominio.
namespace App\Core\Domain\Entities;

/**
 * Clase que representa una Notificación dentro del dominio.
 * Esta entidad modela los datos esenciales que una notificación debe tener.
 */
class Notificacion
{
    /**
     * Constructor de la entidad Notificacion.
     * Usa propiedades `readonly` para garantizar la inmutabilidad una vez instanciada.
     *
     * @param string $titulo     Título de la notificación.
     * @param string $mensaje    Contenido del mensaje de la notificación.
     * @param string $tipo       Tipo de notificación (por ejemplo: email, sms, push).
     * @param string $usuarioId  ID del usuario destinatario de la notificación.
     * @param \DateTimeImmutable $fecha Fecha y hora en que se genera la notificación.
     */
    public function __construct(
        public readonly string $titulo,
        public readonly string $mensaje,
        public readonly string $tipo, // email, sms, push, etc.
        public readonly string $usuarioId,
        public readonly \DateTimeImmutable $fecha
    ) {}
}
