<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Seeder;


class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $persons = [
            ['name' => "Silverster Stallone"],
            ['name' => "Bruce Lee"],
            ['name' => "Mike Tyson"],
            ['name' => "Steven Segal"],
            ['name' => "Pamela Anderson"],
            ['name' => "Robert De Niro"],
            ['name' => "Al Pacino"],
            ['name' => "Leonardo DiCaprio"],
            ['name' => "Tom Hanks"],
            ['name' => "Johnny Depp"],
            ['name' => "Brad Pitt"],
            ['name' => "Denzel Washington"],
            ['name' => "Matt Damon"],
            ['name' => "Morgan Freeman"],
            ['name' => "Clint Eastwood"],
            ['name' => "Will Smith"],
            ['name' => "Christian Bale"],
            ['name' => "Robert Downey Jr."],
            ['name' => "Chris Hemsworth"],
            ['name' => "Chris Evans"],
            ['name' => "Scarlett Johansson"],
            ['name' => "Natalie Portman"],
            ['name' => "Julia Roberts"],
            ['name' => "Charlize Theron"],
            ['name' => "Angelina Jolie"],
            ['name' => "Meryl Streep"],
            ['name' => "Emma Stone"],
            ['name' => "Anne Hathaway"],
            ['name' => "Jennifer Lawrence"],
            ['name' => "Reese Witherspoon"],
            ['name' => "Cate Blanchett"],
            ['name' => "Tom Cruise"],
            ['name' => "Keanu Reeves"],
            ['name' => "Hugh Jackman"],
            ['name' => "Ryan Reynolds"],
            ['name' => "Mark Wahlberg"],
            ['name' => "Jake Gyllenhaal"],
            ['name' => "Ben Affleck"],
            ['name' => "Matt Damon"],
            ['name' => "Gerard Butler"],
            ['name' => "Daniel Craig"],
            ['name' => "Liam Neeson"],
            ['name' => "Harrison Ford"],
            ['name' => "Samuel L. Jackson"],
            ['name' => "Anthony Hopkins"],
            ['name' => "Michael Caine"],
            ['name' => "Ian McKellen"],
            ['name' => "Javier Bardem"],
            ['name' => "Joaquin Phoenix"],
            ['name' => "Adam Driver"],
            ['name' => "Chris Pratt"],
            ['name' => "Zoe Saldana"],
            ['name' => "Vin Diesel"],
            ['name' => "Dwayne Johnson"],
            ['name' => "Ryan Gosling"],
            ['name' => "Ethan Hawke"],
            ['name' => "Paul Rudd"],
            ['name' => "Jason Momoa"],
            ['name' => "Tessa Thompson"],
            ['name' => "Mahershala Ali"],
            ['name' => "Chadwick Boseman"],
            ['name' => "Jared Leto"],
            ['name' => "Gal Gadot"],
            ['name' => "Brie Larson"],
            ['name' => "Margot Robbie"],
            ['name' => "Nicole Kidman"],
            ['name' => "Emily Blunt"],
            ['name' => "Jessica Chastain"],
            ['name' => "Amy Adams"],
            ['name' => "Elizabeth Olsen"],
            ['name' => "Kristen Stewart"],
            ['name' => "Emma Watson"],
            ['name' => "Sandra Bullock"],
            ['name' => "Halle Berry"],
            ['name' => "Michelle Pfeiffer"],
            ['name' => "Renee Zellweger"],
            ['name' => "Glenn Close"],
            ['name' => "Sharon Stone"],
            ['name' => "Uma Thurman"],
            ['name' => "Monica Bellucci"],
            ['name' => "Salma Hayek"],
            ['name' => "Penélope Cruz"],
            ['name' => "Sofia Vergara"],
            ['name' => "Eva Mendes"],
            ['name' => "Jessica Alba"],
            ['name' => "Cameron Diaz"],
            ['name' => "Drew Barrymore"],
            ['name' => "Kate Winslet"],
            ['name' => "Helen Mirren"],
            ['name' => "Judi Dench"],
            ['name' => "Keira Knightley"],
            ['name' => "Emily Mortimer"],
            ['name' => "Rosamund Pike"],
            ['name' => "Gwyneth Paltrow"],
            ['name' => "Winona Ryder"],
            ['name' => "Dakota Johnson"],
            ['name' => "Maggie Gyllenhaal"],
            ['name' => "Zooey Deschanel"],
            ['name' => "Kristen Bell"],
            ['name' => "Alison Brie"],
            ['name' => "Jennifer Garner"]
        ];

        foreach($persons as $person){
            Person::create($person);
        }
    }
}
