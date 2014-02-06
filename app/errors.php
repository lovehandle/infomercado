<?php

//404 handler
App::missing(function($exception)
{
    return Response::view('404', array(), 404);
});

?>