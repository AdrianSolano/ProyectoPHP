<?php

require_once '../setup.php';

// Esto debe ir antes del session_destroy()
session_unset();

session_destroy();

header("Location: ".BASE_URL);