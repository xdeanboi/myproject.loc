<?php

return [
    '~^articles/(\d+)$~' => [\MyProject\Controllers\Api\ArticleApiController::class, 'view'],
    '~^articles/add$~' => [\MyProject\Controllers\Api\ArticleApiController::class, 'add'],
];