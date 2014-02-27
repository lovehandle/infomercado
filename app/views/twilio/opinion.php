<?php

?>
<?xml version="1.0" encoding="UTF-8"?>
<Response>
    <Play>http://www.infomercado.mx/raw/03_opinion02.mp3</Play>
    <Record
        action="/twilio-connect/opiniones"
        method="POST"
        maxLength="20"
        finishOnKey="#"
        playBeep="true"
        transcribe="false"
       />
    <Say>No pudimos procesar tu opinion. Hasta luego !</Say>
</Response>