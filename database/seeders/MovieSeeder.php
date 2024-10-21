<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = [
            [
                "category_id" => 3,
                "title" => "Onward",
                "description" => "Two brothers embark on a magical quest to bring their father back for one day. They encounter magical creatures and learn valuable lessons about life and family. Along the way, their bond strengthens as they face challenges.",
                "year" => 2020,
                "duration" => 102,
                "imdb_rating" => 7.4,
                "status" => "published",
                "slug" => "onward"
            ],
            [
                "category_id" => 4,
                "title" => "Tenet",
                "description" => "A secret agent embarks on a time-bending mission to prevent the start of World War III. Armed with one word—Tenet—he must navigate through a twilight world of international espionage. The film challenges concepts of time and perception.",
                "year" => 2020,
                "duration" => 150,
                "imdb_rating" => 7.5,
                "status" => "published",
                "slug" => "tenet"
            ],
            [
                "category_id" => 5,
                "title" => "Bad Boys for Life",
                "description" => "The wife and son of a Mexican drug lord embark on a vengeful quest. Two Miami detectives must face their old foes, confronting danger and personal turmoil along the way.",
                "year" => 2020,
                "duration" => 124,
                "imdb_rating" => 7.2,
                "status" => "published",
                "slug" => "bad-boys-for-life"
            ],
            [
                "category_id" => 6,
                "title" => "The Invisible Man",
                "description" => "A woman believes she's being hunted by her abusive ex-boyfriend who has become invisible. She fights to prove that she's being terrorized, but no one believes her.",
                "year" => 2020,
                "duration" => 124,
                "imdb_rating" => 7.1,
                "status" => "published",
                "slug" => "the-invisible-man"
            ],
            [
                "category_id" => 7,
                "title" => "American Murder: The Family Next Door",
                "description" => "Using raw, firsthand footage, this documentary examines the disappearance of Shanann Watts and her children, unraveling a disturbing true crime story.",
                "year" => 2020,
                "duration" => 83,
                "imdb_rating" => 7.2,
                "status" => "published",
                "slug" => "american-murder-the-family-next-door"
            ],
            [
                "category_id" => 8,
                "title" => "The Half of It",
                "description" => "A shy, introverted student helps the school jock woo a girl whom, secretly, they both want. As the student grapples with unspoken emotions, the story explores love, friendship, and identity.",
                "year" => 2020,
                "duration" => 104,
                "imdb_rating" => 7.0,
                "status" => "published",
                "slug" => "the-half-of-it"
            ],
            [
                "category_id" => 9,
                "title" => "Greyhound",
                "description" => "In the early days of World War II, an inexperienced U.S. Navy captain must lead an Allied convoy. The film centers around intense naval battles and personal bravery.",
                "year" => 2020,
                "duration" => 91,
                "imdb_rating" => 7.0,
                "status" => "published",
                "slug" => "greyhound"
            ],
            [
                "category_id" => 10,
                "title" => "News of the World",
                "description" => "A Civil War veteran embarks on a journey across Texas to return a young girl to her relatives, encountering challenges and rediscovering his own humanity.",
                "year" => 2020,
                "duration" => 118,
                "imdb_rating" => 6.8,
                "status" => "published",
                "slug" => "news-of-the-world"
            ],
            [
                "category_id" => 11,
                "title" => "The Witcher: Nightmare of the Wolf",
                "description" => "Vesemir escapes poverty to become a witcher and kill monsters for coin, but a new menace rises. The story delves into the origins of the Witcher universe.",
                "year" => 2020,
                "duration" => 81,
                "imdb_rating" => 7.5,
                "status" => "published",
                "slug" => "the-witcher-nightmare-of-the-wolf"
            ],
            [
                "category_id" => 13,
                "title" => "The Grudge",
                "description" => "A detective investigates a murder scene that has a connection to a supernatural curse. The curse spreads and haunts anyone who dares to enter the cursed house.",
                "year" => 2020,
                "duration" => 94,
                "imdb_rating" => 4.3,
                "status" => "published",
                "slug" => "the-grudge"
            ],
            [
                "category_id" => 14,
                "title" => "Soul",
                "description" => "A musician who's lost his passion for music is transported out of his body and must find his way back with the help of a young soul learning about life.",
                "year" => 2020,
                "duration" => 100,
                "imdb_rating" => 8.1,
                "status" => "published",
                "slug" => "soul"
            ],
            [
                "category_id" => 1,
                "title" => "Wonder Woman 1984",
                "description" => "Diana Prince comes into conflict with the Soviet Union during the Cold War in the 1980s. The film sees Wonder Woman battle villains in a colorful, retro setting.",
                "year" => 2020,
                "duration" => 151,
                "imdb_rating" => 5.4,
                "status" => "published",
                "slug" => "wonder-woman-1984"
            ],
            [
                "category_id" => 2,
                "title" => "Palm Springs",
                "description" => "Stuck in a time loop, two wedding guests develop a budding romance as they relive the same day over and over. The film blends romance with sci-fi elements.",
                "year" => 2020,
                "duration" => 90,
                "imdb_rating" => 7.4,
                "status" => "published",
                "slug" => "palm-springs"
            ],
            [
                "category_id" => 3,
                "title" => "The Call of the Wild",
                "description" => "A domesticated dog embarks on an adventure in the Yukon during the Klondike Gold Rush. As the dog adapts to wilderness life, it learns to embrace its wild nature.",
                "year" => 2020,
                "duration" => 100,
                "imdb_rating" => 6.8,
                "status" => "published",
                "slug" => "the-call-of-the-wild"
            ],
            [
                "category_id" => 4,
                "title" => "Extraction",
                "description" => "A black ops mercenary must rescue the kidnapped son of an international crime lord. As he battles his way through adversaries, he confronts his own demons.",
                "year" => 2020,
                "duration" => 116,
                "imdb_rating" => 6.7,
                "status" => "published",
                "slug" => "extraction"
            ],
            [
                "category_id" => 5,
                "title" => "The Trial of the Chicago 7",
                "description" => "The story of seven individuals charged with conspiracy and inciting a riot during the 1968 Democratic National Convention. The film focuses on the courtroom drama and political turbulence.",
                "year" => 2020,
                "duration" => 130,
                "imdb_rating" => 7.8,
                "status" => "published",
                "slug" => "the-trial-of-the-chicago-7"
            ]
        ];

        //Loop to insert all movies
        foreach($movies as $movie){
            Movie::create($movie);
        }
    }
}
