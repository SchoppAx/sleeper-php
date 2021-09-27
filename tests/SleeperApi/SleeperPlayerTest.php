<?php

use PHPUnit\Framework\TestCase;
use SchoppAx\Sleeper\SleeperClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;

class SleeperPlayerTest extends TestCase
{

  public function testUser()
  {
    $data = file_get_contents(__DIR__ . '/data/players.json');
    $response = new GuzzleHttp\Psr7\Response(200, [], $data);
    $mock = new GuzzleHttp\Handler\MockHandler([ $response, $response ]);

    $client = new SleeperClient($mock);

    $players = $client->players()->all();
    $mThomas = (object) $players['3199'];

    $this->assertIsArray($players);
    $this->assertCount(4, $players);
    $this->assertIsObject($mThomas);
    $this->assertEquals('nfl', $mThomas->sport);
    $this->assertEquals('Michael Thomas', $mThomas->full_name);
    $this->assertEquals('PUP', $mThomas->injury_status);
    $this->assertEquals('Inactive', $mThomas->status);
    $this->assertEquals("6'3\"", $mThomas->height);
    $this->assertEquals(28, $mThomas->age);
    $this->assertEquals('212', $mThomas->weight);
    $this->assertEquals(5, $mThomas->years_exp);
    $this->assertEquals('NO', $mThomas->team);
    $this->assertEquals('WR', $mThomas->position);
    $this->assertEquals('3199', $mThomas->player_id);
  }

}