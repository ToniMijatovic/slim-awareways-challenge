<?php

namespace App\Enums;

enum QuestionTypeEnum:string
{
    case MULTIPLE_CHOICE = 'Multiple Choice';
    case ORDER = 'Order';
    case DRAG_AND_DROP = 'Drag & Drop';
}
