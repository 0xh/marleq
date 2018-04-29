<?php

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add Services

        DB::table('services')->insert([
            ['name' => 'CV Review', 'featured' => 1, 'description' => 'Work with a resume review coach to turn your existing resume into an eye-catching, ATS-beating doc that clearly tells hiring managers why they should bring you in for an interview.'],
            ['name' => 'LinkedIn Review', 'featured' => 1, 'description' => 'It\'s hard to fit your entire career on a single piece of paper or social network profile. Our coaches know all the resume and LinkedIn profile tips to help you get hired faster.'],
            ['name' => 'Cover Letter Review', 'featured' => 0, 'description' => 'You have the perfect resume and you\'re ready to apply to your dream job. Now you just need a (non-sleep-inducing) cover letter that helps you stand out from the crowd.'],
            ['name' => 'New Job Search Strategy', 'featured' => 1, 'description' => 'Job searching can be an overwhelming process. The right strategy can make it easier and help you land a job much faster.'],
            ['name' => 'Interview Coaching', 'featured' => 0, 'description' => 'When it comes to landing a job, it\'s all about your interviewing skills. And our coaches are the best at helping you overcome your interview fears, refine your pitch, and tackle even the hardest interview questions.'],
            ['name' => 'Negotiation Coaching', 'featured' => 0, 'description' => 'Negotiating is tough stuff. But it\'s a skill you seriously need if you want to get ahead in your career. Let one of our coaches help you navigate salary negotiations, earn a promotion, or just get more comfortable fighting for what you deserve.'],
            ['name' => 'Leadership Coaching', 'featured' => 0, 'description' => 'All great leaders have gotten help along the way. Leadership coaching can help you become a better manager, establish yourself as a leader, and, in general, excel in any organization.'],
            ['name' => 'Networking Coaching', 'featured' => 0, 'description' => 'Networking is one of the single greatest things you can do for your career on a regular basis. Get the confidence and help you need to do it well and reach your career goals.'],
            ['name' => 'New Position Coaching', 'featured' => 0, 'description' => ''],
            ['name' => 'HRM Coaching', 'featured' => 0, 'description' => ''],
            ['name' => 'Grow in my current role', 'featured' => 0, 'description' => ''],
            ['name' => 'Explore future career options', 'featured' => 0, 'description' => ''],
            ['name' => 'Return to work after an absence', 'featured' => 0, 'description' => ''],
            ['name' => 'Career Q&A', 'featured' => 1, 'description' => 'Imagine having your own expert on call to answer any career questions you have, as soon as they come up. Now you do.'],
        ]);
    }
}
