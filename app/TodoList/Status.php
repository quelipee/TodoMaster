<?php

namespace App\TodoList;

enum Status : string
{
    case Completed = 'Completed';
    case Pending = 'Pending';
}
