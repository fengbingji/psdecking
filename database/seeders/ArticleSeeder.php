<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $itTopics = [
            'Understanding the Basics of Machine Learning',
            'The Future of Cloud Computing',
            'Introduction to Blockchain Technology',
            'Advanced JavaScript Techniques',
            'Cybersecurity Best Practices',
            'The Role of AI in Healthcare',
            'DevOps: A Comprehensive Guide',
            'Building Scalable Web Applications',
            'Data Privacy and Protection Laws',
            'The Evolution of Programming Languages',
            'Quantum Computing: What You Need to Know',
            'The Impact of IoT on Business',
            'Containerization with Docker',
            'Serverless Architecture: Pros and Cons',
            'Agile Methodologies in Software Development',
            'The Importance of UI/UX Design',
            'Microservices Architecture',
            'The Role of Big Data in Decision Making',
            'The Future of Virtual Reality',
            'The Role of DevSecOps in Secure Software Development',
            'Introduction to Kubernetes',
            'The Benefits of Continuous Integration and Continuous Deployment',
            'The Role of Data Science in Business',
            'The Impact of 5G on the Internet',
            'The Role of Chatbots in Customer Service',
            'The Future of Artificial Intelligence',
            'The Role of Blockchain in Finance',
            'The Impact of Augmented Reality on Education',
            'The Role of Machine Learning in Finance',
        ];

        foreach ($itTopics as $title) {
            Article::factory()->create([
                'title' => $title,
            ]);
        }
    }
}
