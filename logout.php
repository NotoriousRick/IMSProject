<?php
/* Need this to start the application, otherwise it will not work */
session_start();

/* Remove all session variables */
session_unset();

/* Destroy session */
session_destroy();