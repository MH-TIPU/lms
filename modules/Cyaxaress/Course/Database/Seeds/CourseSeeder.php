<?php

namespace Cyaxaress\Course\Database\Seeds;

use Cyaxaress\Course\Models\Course;
use Cyaxaress\Media\Services\MediaFileService;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        auth()->loginUsingId(1);
        $courses = [
            [
                'title' => 'Modular Programming in Laravel',
                'slug' => 'modular-programming-in-laravel',
                'body' => 'Lorem Ipsum',
                'category_id' => 2,
                'teacher_id' => 1,
                'price' => 5000000,
                'percent' => 50,
                'type' => 'cash',
                'status' => 'completed',
                'confirmation_status' => 'accepted',
                'image' => 'course-1-laravel.png',
            ],
            [
                'title' => 'Beginner to Advanced ReactJS Course',
                'slug' => 'reactjs',
                'body' => 'Lorem Ipsum',
                'category_id' => 2,
                'teacher_id' => 2,
                'price' => 750000,
                'percent' => 50,
                'type' => 'cash',
                'status' => Course::STATUS_NOT_COMPLETED,
                'confirmation_status' => 'accepted',
                'image' => 'course-2-react.png',
            ],
            [
                'title' => 'Beginner to Advanced PHP Course',
                'slug' => 'php',
                'body' => 'Lorem Ipsum',
                'category_id' => 2,
                'teacher_id' => 2,
                'price' => 890000,
                'percent' => 50,
                'type' => 'cash',
                'status' => Course::STATUS_NOT_COMPLETED,
                'confirmation_status' => 'accepted',
                'image' => 'course-3-php.png',
            ],
            [
                'title' => 'Beginner to Advanced Angular Course',
                'slug' => 'angular',
                'body' => 'Lorem Ipsum',
                'category_id' => 2,
                'teacher_id' => 2,
                'price' => 0,
                'percent' => 50,
                'type' => 'free',
                'status' => Course::STATUS_NOT_COMPLETED,
                'confirmation_status' => 'accepted',
                'image' => 'course-4-angularjs.jpg',
            ],
            [
                'title' => 'Web Service Development Course',
                'slug' => 'web-service',
                'body' => 'Lorem Ipsum',
                'category_id' => 2,
                'teacher_id' => 2,
                'price' => 0,
                'percent' => 50,
                'type' => 'cash',
                'status' => Course::STATUS_LOCKED,
                'confirmation_status' => 'accepted',
                'image' => 'course-5-web-service.jpg',
            ],
            [
                'title' => 'Practical Docker Training Course',
                'slug' => 'docker',
                'body' => 'Lorem Ipsum',
                'category_id' => 2,
                'teacher_id' => 2,
                'price' => 1500000,
                'percent' => 50,
                'type' => 'cash',
                'status' => Course::STATUS_COMPLETED,
                'confirmation_status' => 'accepted',
                'image' => 'course-6-docker.png',
            ],
            [
                'title' => 'Unity Game Development Training',
                'slug' => 'unity',
                'body' => 'Lorem Ipsum',
                'category_id' => 2,
                'teacher_id' => 2,
                'price' => 1500000,
                'percent' => 50,
                'type' => 'cash',
                'status' => Course::STATUS_COMPLETED,
                'confirmation_status' => 'accepted',
                'image' => 'course-7-unity.png',
            ],
            [
                'title' => 'Redis Caching Training',
                'slug' => 'redis',
                'body' => 'Lorem Ipsum',
                'category_id' => 2,
                'teacher_id' => 2,
                'price' => 499000,
                'percent' => 50,
                'type' => 'cash',
                'status' => Course::STATUS_COMPLETED,
                'confirmation_status' => 'accepted',
                'image' => 'course-8-redis.png',
            ],
        ];
        foreach ($courses as $course) {
            Course::query()->create([
                'title' => $course['title'],
                'slug' => $course['slug'],
                'body' => $course['body'],
                'category_id' => $course['category_id'],
                'teacher_id' => $course['teacher_id'],
                'price' => $course['price'],
                'percent' => $course['percent'],
                'type' => $course['type'],
                'status' => $course['status'],
                'confirmation_status' => $course['confirmation_status'],
                'banner_id' => MediaFileService::publicUpload(new UploadedFile(storage_path('app/public/seeds/'.$course['image']), $course['image']))->id,
            ]);
        }
    }
}