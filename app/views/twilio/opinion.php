<?php

?>
<?xml version="1.0" encoding="UTF-8"?>
<Response>
    <Say voice="alice" language="es-MX">
    	Para dejar tu opinion menciona el nombre del mercado y tu mensaje después del tono. Guarda tu mensaje presionando gato.
    </Say>
    <Record
        action="/twilio-connect/opiniones"
        method="POST"
        maxLength="20"
        finishOnKey="#"
        playBeep="true"
        transcri
        />
    <Say>No pudimos procesar tu opinion. Hasta luego !</Say>
</Response>