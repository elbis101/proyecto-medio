<?php

namespace Database\Seeders;
use App\Models\User;

use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties=[
            'Oftalmología',
            'Pediatría',
            'Neurología'
        ];
        foreach($specialties as $specialtyName){
        $specialty=Specialty::create([
        'name'=> $specialtyName
      
            ]);
          
            $specialty->users()->saveMany(
                User::factory(3)->doctor()->make()
            );
    }
    User::find(2)->specialties()->save($specialty);
}
}