<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Course;
use App\Models\Tugas;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        
        $email = env('SEED_TO_EMAIL');
        $user  = $email ? User::firstWhere('email', $email) : User::first();

       
        if (!$user) {
            $user = User::create([
                'name'     => 'Demo User',
                'email'    => $email ?: 'demo@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }

        Tugas::where('user_id', $user->id)->delete();
        Course::where('user_id', $user->id)->delete();

        $coursesData = [
            ['name' => 'Pemrograman Web Lanjut',      'code' => 'IFW302',  'dosen_pengampu' => 'Dr. Ahmad', 'semester' => 5],
            ['name' => 'Sistem Basis Data',           'code' => 'IFD204',  'dosen_pengampu' => 'Ibu Sari',  'semester' => 4],
            ['name' => 'Kecerdasan Buatan',           'code' => 'IFAI402', 'dosen_pengampu' => 'Pak Budi',  'semester' => 5],
            ['name' => 'Keamanan Jaringan',           'code' => 'IFSEC401','dosen_pengampu' => 'Pak Raka',  'semester' => 5],
            ['name' => 'Interaksi Manusia & Komputer','code' => 'IFHCI301','dosen_pengampu' => 'Ibu Dina',  'semester' => 3],
            ['name' => 'Sistem Operasi',              'code' => 'IFOS202', 'dosen_pengampu' => 'Pak Andi',  'semester' => 4],
        ];

        $courses = [];
        foreach ($coursesData as $c) {
            $courses[] = Course::create([
                'user_id'        => $user->id,
                'name'           => $c['name'],
                'code'           => $c['code'],
                'dosen_pengampu' => $c['dosen_pengampu'],
                'semester'       => $c['semester'],
            ]);
        }

        $timeSlots = [0, 15, 30, 45];
        foreach ($courses as $course) {
            for ($i = 1; $i <= 3; $i++) {
                $randDays  = random_int(-5, 30);
                $randHour  = random_int(8, 21); 
                $randMin   = $timeSlots[array_rand($timeSlots)];
                $deadline  = now()->copy()->addDays($randDays)->setTime($randHour, $randMin);

                Tugas::create([
                    'user_id'     => $user->id,
                    'course_id'   => $course->id,
                    'judul'       => "Tugas $i - {$course->name}",
                    'description' => 'Catatan: ' . Str::limit(fake()->sentence(24), 180),
                    'deadline'    => $deadline,
                    'status'      => random_int(0,1) ? 'Belum Selesai' : 'Selesai',
                ]);
            }
        }
    }
}
