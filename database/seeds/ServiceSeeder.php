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
            ['name' => 'CV Review', 'alias' => 'cv-review', 'featured' => 1, 'description' => 'Work on your CV and improve it with your career coach, who will mentor you master CV writing. Your exceptional CV will be a signal to recruiters and hiring managers to invite you for an interview.'],
            ['name' => 'LinkedIn Review', 'alias' => 'linkedin-review', 'featured' => 1, 'description' => 'Job seekers are still not aware of importance of LinkedIn profile and its power in hiring process. Luckily, our career coaches will guide you in order to attract headhunters and get job opportunities.'],
            ['name' => 'Cover Letter Review', 'alias' => 'cover-letter-review', 'featured' => 0, 'description' => 'You have an outstanding CV and you are ready to apply for a desirable job. Next step is a cover letter that stands out.'],
            ['name' => 'New Job Search Strategy', 'alias' => 'new-job-search-strategy', 'featured' => 1, 'description' => 'You are not alone in a job hunt. All you need is right approach and strategy. Our experienced coaches will provide you with tips and guidance, and help you get a dream job faster and easier.'],
            ['name' => 'Interview Coaching', 'alias' => 'interview-coaching', 'featured' => 0, 'description' => 'The most important step for landing a desirable job is interview. Therefore, interview skills are essential. Our coaches will prepare you and help in order overcome even the trickiest interview questions.'],
            ['name' => 'Negotiation Coaching', 'alias' => 'negotiation-coaching', 'featured' => 0, 'description' => 'Negotiating skills are crucial for a career progress and for fighting for your needs and motivation. Our coaches will help you to better negotiate current position, wage, bonuses, advancement, etc.'],
            ['name' => 'Leadership Coaching', 'alias' => 'leadership-coaching', 'featured' => 0, 'description' => 'Leadership coaching will help you become a more successful and effective leader in any organization. We believe that leaders should be leading by example, and by being a role model to others. Leaders do not create followers, they create more leaders.'],
            ['name' => 'New Position Coaching', 'alias' => 'new-position-coaching', 'featured' => 0, 'description' => 'Our career coach will help you set specific goals, improve your performance, and overcome new career challenges.'],
            ['name' => 'HRM Coaching', 'alias' => 'hrm-coaching', 'featured' => 0, 'description' => 'Human Resource Management coaching helps in motivation of individuals in making changes to further their professional development. Our coaches will help you to improve yours and your colleagues’ work skills, discover your strengths, and achieve your goals.'],
            ['name' => 'Grow in my current role', 'alias' => 'grow-in-my-current-role', 'featured' => 0, 'description' => 'We will help you develop skills to become a respected colleague everyone wants to work with.'],
            ['name' => 'Return to work after an absence', 'alias' => 'return-to-work-after-an-absence', 'featured' => 0, 'description' => 'Back-on-track is a real career challenge. Reaching your career goals is faster and easier with right career coaching guidance and support.'],
            ['name' => 'Career Q&A', 'alias' => 'career-q-a', 'featured' => 1, 'description' => 'Finally, you have a list of experts to ask all career related questions and receive answers that will help you build a successful career.'],
        ]);
    }
}
