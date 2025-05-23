<?php

// Define el namespace para organizar las clases de infraestructura
namespace App\Infrastructure\Services;

// Importa la entidad Notificacion y la interfaz que se implementará
use App\Core\Domain\Entities\Notificacion;
use App\Core\Application\UseCases\NotificacionServiceInterface;

// Importa las clases necesarias de PhpAmqpLib para conectar y enviar mensajes a RabbitMQ
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Servicio de infraestructura que implementa el envío de notificaciones usando RabbitMQ.
 * Aplica el principio de inversión de dependencias, cumpliendo con la interfaz definida en la capa de aplicación.
 */
class NotificacionRabbitMQService implements NotificacionServiceInterface
{
    /**
     * Envía una notificación a la cola 'notificaciones' en RabbitMQ.
     *
     * @param Notificacion $notificacion Instancia de la entidad con los datos de la notificación.
     */
    public function enviar(Notificacion $notificacion): void
    {
        // Establece la conexión con RabbitMQ usando datos del archivo .env
        $connection = new AMQPStreamConnection(
            env('RABBITMQ_HOST', 'localhost'),  // Dirección del servidor RabbitMQ
            env('RABBITMQ_PORT', 5672),         // Puerto por defecto de RabbitMQ
            env('RABBITMQ_USER', 'guest'),      // Usuario por defecto
            env('RABBITMQ_PASSWORD', 'guest')   // Contraseña por defecto
        );

        // Abre un canal para enviar el mensaje
        $channel = $connection->channel();

        // Declara (crea si no existe) una cola llamada 'notificaciones'
        // durable = true para que persista después de un reinicio del servidor
        $channel->queue_declare('notificaciones', false, true, false, false);

        // Crea el cuerpo del mensaje en formato JSON
        $payload = json_encode([
            'tipo' => $notificacion->tipo,
            'mensaje' => $notificacion->mensaje,
            'usuario_id' => $notificacion->usuarioId,
        ]);

        // Crea un mensaje AMQP con el payload y lo marca como persistente
        $msg = new AMQPMessage($payload, [
            'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT,
        ]);

        // Publica el mensaje en la cola 'notificaciones'
        $channel->basic_publish($msg, '', 'notificaciones');

        // Cierra el canal y la conexión para liberar recursos
        $channel->close();
        $connection->close();
    }
}
