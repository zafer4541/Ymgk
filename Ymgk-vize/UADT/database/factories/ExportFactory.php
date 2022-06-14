<?php

namespace Database\Factories;

use App\Models\Export;
use Illuminate\Database\Eloquent\Factories\Factory;


class ExportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Export::class;

    public function definition()
    {
        $type = ['API','mail','excel','pdf','manuel'];
        return [





            'company_name'=>$this-> faker-> paragraph(1),
            'company_mail' => $this -> faker -> unique() -> safeEmail(),
            'company_phone' => $this -> faker -> phoneNumber(),
            'total_quantity'=>$this -> faker -> buildingNumber(),
            'company_address'=>$this-> faker ->  address(),



            'title' => $this -> faker -> paragraph(1),
            'description' => $this -> faker -> paragraph(10),
            'country' => $this -> faker -> country(),
            'city' => $this -> faker -> city(),



            'created_at'=>$this->faker->date(),
            'request_date'=>$this->faker->dateTimeBetween('-1 week',now()),
            'deadline' => $this->faker->dateTimeBetween('now'),
            'type' => $type[rand(0,4)],
            'isPublished' => rand(0,1),
            'managerId' => rand(10,100)
        ];
    }
}
