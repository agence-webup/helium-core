<?php

namespace Webup\Helium\Attributes;

use Attribute;
use Illuminate\Support\Facades\Log;

#[Attribute(Attribute::TARGET_FUNCTION | Attribute::TARGET_METHOD)]
class Route
{
    public function __construct(
        public string $method,
        public string $path,
    ) {
        Log::info("Route registered: {$this->method} {$this->path}");
    }
}
