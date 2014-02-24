<?php

?>
<?xml version="1.0" encoding="UTF-8"?>
<Response>
    <Gather timeout="4" finishOnKey="*" action="/twilio-connect/start" method="POST" numDigits="1">
        <Say voice="alice" language="es-MX">Bienvenido a InfoMercado. Si eres cliente de un mercado y desesas dejar una opinión, marca 1. Si eres comerciante y deseas registrarte en el directorio, marca 2</Say>
    </Gather>
     <Say>No recibimos una respuesta. Gracias.</Say>
</Response>