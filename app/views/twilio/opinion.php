<?php

?>
<?xml version="1.0" encoding="UTF-8"?>
<Response>
    <Play>http://www.infomercado.mx/raw/Opinion.wav</Play>
    <Record
        action="/twilio-connect/opiniones"
        method="POST"
        maxLength="20"
        finishOnKey="#"
        playBeep="true"
       />
    <Say>No pudimos procesar tu opinion. Hasta luego !</Say>
</Response>