<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Module;
use App\Models\Note;
use App\Models\NoteFile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Calima',
            'email' => 'dev@calimasolutions.com',
            'password' => Hash::make('password'),
        ]);

        $this->call([
            AcademicYearSeeder::class,
            ModuleSeeder::class,
        ]);

        $notes = Note::factory(50)
            ->for(Module::inRandomOrder()->first())
            ->has(NoteFile::factory(2), 'files')
            ->create();
        $user->notes()->sync($notes, [
            'role' => 'owner',
        ]);
    }
}
