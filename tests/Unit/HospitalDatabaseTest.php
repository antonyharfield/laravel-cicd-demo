<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Hospital;

class HospitalDatabaseTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        
        // for ($i = 0; $i < 10; $i++) {
        //     $name = $this->faker()->words(4, true);
        //     $address = $this->faker()->streetAddress;
        //     $numberOfBeds = $this->faker()->numberBetween(10, 10000);
        //     $numberOfDoctors = $this->faker()->numberBetween(1, 1000);
        //     $hospital = Hospital::create($name, $address, $numberOfBeds, $numberOfDoctors);
        //     $hospital->save();
        // }

        factory(Hospital::class, 10)->create();
    }

    public function testSaveModel()
    {
        // Arrange
        $name = 'Naresuan University Hospital';
        $address = '99 Moo 9 Thapho Muang Phitsanulok';
        $numberOfBeds = 5000;
        $numberOfDoctors = 333;
        $hospital = Hospital::create($name, $address, $numberOfBeds, $numberOfDoctors);

        // Act
        $hospital->save();

        // Assert
        $this->assertDatabaseHas('hospitals', [
            'name' => $name,
            'address' => $address,
            'numberOfBeds' => $numberOfBeds,
            'numberOfDoctors' => $numberOfDoctors]);
    }

    public function testUpdateModel()
    {
        // Arrange
        $name = 'Naresuan University Hospital';
        $address = '99 Moo 9 Thapho Muang Phitsanulok';
        $numberOfBeds = 5000;
        $numberOfDoctors = 333;
        $hospital = Hospital::create($name, $address, $numberOfBeds, $numberOfDoctors);
        $hospital->save();

        // Act
        $hospital->name = 'NU Hospital';
        $hospital->save();

        // Assert
        $this->assertDatabaseHas('hospitals', ['name' => 'NU Hospital']);
        $this->assertDatabaseMissing('hospitals', ['name' => $name]);
    }

    public function testGetModel() {
        // Arrange
        $expected = factory(Hospital::class)->create();
        factory(Hospital::class, 5)->create();

        // Act
        $actual = Hospital::find($expected->id);

        // Assert
        $this->assertEquals($expected->id, $actual->id);
        $this->assertEquals($expected->name, $actual->name);
    }

    public function testSaveIncrementsRowCount() {
        // Arrange
        $previousRows = Hospital::count();
        $hospital = factory(Hospital::class)->make();

        // Act
        $hospital->save();

        // Assert
        $currentRows = Hospital::count();
        $this->assertEquals($previousRows + 1, $currentRows);
    }

}
