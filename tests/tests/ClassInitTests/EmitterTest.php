<?php
/*
    EmitterTest.php

    Copyright (c) 2014 Snowplow Analytics Ltd. All rights reserved.

    This program is licensed to you under the Apache License Version 2.0,
    and you may not use this file except in compliance with the Apache License
    Version 2.0. You may obtain a copy of the Apache License Version 2.0 at
    http://www.apache.org/licenses/LICENSE-2.0.

    Unless required by applicable law or agreed to in writing,
    software distributed under the Apache License Version 2.0 is distributed on
    an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
    express or implied. See the Apache License Version 2.0 for the specific
    language governing permissions and limitations there under.

    Authors: Joshua Beemster
    Copyright: Copyright (c) 2014 Snowplow Analytics Ltd
    License: Apache License Version 2.0
*/
use Snowplow\Tracker\Emitters\SyncEmitter;
use Snowplow\Tracker\Emitters\CurlEmitter;
use Snowplow\Tracker\Emitters\SocketEmitter;
use Snowplow\Tracker\Emitters\FileEmitter;

class EmitterTest extends PHPUnit_Framework_TestCase {
    private $uri = "228e51cc.ngrok.com";

    public function testCurlEmitterInit() {
        $emitter = new CurlEmitter($this->uri, false, "GET", 1, false);

        // Asserts
        $this->assertNotNull($emitter);
    }

    public function testSyncEmitterInit() {
        $emitter = new SyncEmitter($this->uri, "http", "GET", 1, false);

        // Asserts
        $this->assertNotNull($emitter);
    }

    public function testSocketEmitterInit() {
        $emitter = new SocketEmitter($this->uri, NULL, "GET", NULL, NULL, false);

        // Asserts
        $this->assertNotNull($emitter);
    }

    public function testFileEmitterInit() {
        $emitter = new FileEmitter($this->uri, false, "GET", 1, 15, 1);

        // Asserts
        $this->assertNotNull($emitter);
    }

    public function testReturnFunctions() {
        $emitter = new SyncEmitter($this->uri, "http", "GET", 10, false);
        $emitter->addEvent(array("something" => "something"), "");

        $this->assertEquals(false,
            $emitter->returnDebugMode());
        $this->assertEquals(NULL,
            $emitter->returnDebugFile());
        $this->assertEquals(1,
            count($emitter->returnBuffer()));
        $this->assertEquals("",
            $emitter->returnBufferNuid());
    }
}
