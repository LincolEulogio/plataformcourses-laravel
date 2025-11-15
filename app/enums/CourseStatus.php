<?php

namespace App\Enums;

enum CourseStatus: int
{
    // Define possible course statuses
    case BORRADOR = 1;
    case PENDIENTE = 2;
    case PUBLICADO = 3;
}
