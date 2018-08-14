<?php

namespace Tests\Unit\Application\Service;

use App\Application\Service\DTO;
use App\Application\Service\DTOSerializer;
use PHPUnit\Framework\TestCase;

class DTOSerializerTest extends TestCase
{

    public function test_serialize_with_array()
    {
        $obj1Array = ['test' => 1];
        $obj1 = $this->prophesize(DTO::class);
        $obj1->serialize()->shouldBeCalled()->willReturn($obj1Array);

        $obj2Array = ['test' => 2];
        $obj2 = $this->prophesize(DTO::class);
        $obj2->serialize()->shouldBeCalled()->willReturn($obj2Array);

        $serializedDTO = DTOSerializer::serialize([ $obj1->reveal(), $obj2->reveal() ]);

        $this->assertEquals([$obj1Array, $obj2Array], $serializedDTO);
    }

    public function test_serialize_with_one_dto()
    {
        $obj1Array = ['test' => 1];
        $obj1 = $this->prophesize(DTO::class);
        $obj1->serialize()->shouldBeCalled()->willReturn($obj1Array);

        $serializedDTO = DTOSerializer::serialize($obj1->reveal());

        $this->assertEquals($obj1Array, $serializedDTO);
    }
}
