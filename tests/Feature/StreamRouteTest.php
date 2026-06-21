<?php

namespace Tests\Feature;

use Tests\TestCase;

class StreamRouteTest extends TestCase
{
    public function test_stream_page_loads_without_server_error(): void
    {
        $response = $this->get('/stream');

        $response->assertOk();
        $response->assertSee('Live Streams');
    }
}
