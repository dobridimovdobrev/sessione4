<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;


class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Notification::create([
            'user_id' => 1,
            'message' => 'Your content is now available to watch!',
        ]);
    }
}
