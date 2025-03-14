<?php

namespace App\Enums;

enum ContentType: string
{
    case Page = 'PAGE';
    case Article = 'ARTICLE';
    case Product = 'PRODUCT';
    case Other = 'OTHER';
}
