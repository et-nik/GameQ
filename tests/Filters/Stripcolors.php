<?php
/**
 * This file is part of GameQ.
 *
 * GameQ is free software; you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * GameQ is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace GameQ\Tests\Filters;

/**
 * Class for testing Stripcolors filter
 *
 * @package GameQ\Tests\Filters
 */
class Stripcolors extends Base
{

    /**
     * Test the filter for Stripcolors
     *
     * @dataProvider loadData
     *
     * @param $protocol
     * @param $raw
     * @param $filtered
     */
    public function testFiltered($protocol, $raw, $filtered)
    {

        // Pop the key from the raw response
        $host = key($raw);

        // Create a mock server
        $server = $this->getMock('\GameQ\Server', null, [
            [
                \GameQ\Server::SERVER_HOST => $host,
                \GameQ\Server::SERVER_TYPE => $protocol,
            ]
        ]);

        // Create a mock filter
        $filter = $this->getMock('\GameQ\Filters\Stripcolors', null, [ ]);

        $this->assertEquals($filtered[$host], $filter->apply($raw[$host], $server));
    }

    /**
     * Test for empty data pass to filter
     */
    public function testEmpty()
    {

        // Create a mock server
        $server = $this->getMock('\GameQ\Server', null, [
            [
                \GameQ\Server::SERVER_HOST => '127.0.0.1:28960',
                \GameQ\Server::SERVER_TYPE => 'quake3',
            ]
        ]);

        // Create a mock filter
        $filter = $this->getMock('\GameQ\Filters\Stripcolors', null, [ ]);

        $this->assertEmpty($filter->apply([ ], $server));
    }
}
