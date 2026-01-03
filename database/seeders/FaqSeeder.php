<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $categories = [
            'General' => [
                [
                    'question' => 'What is your service about?',
                    'answer' => 'Our service provides users with an easy and efficient way to manage their tasks and workflows.'
                ],
                [
                    'question' => 'How can I contact support?',
                    'answer' => 'You can contact our support team via the contact form or by emailing support@example.com.'
                ],
            ],
            'Billing' => [
                [
                    'question' => 'What payment methods are accepted?',
                    'answer' => 'We accept all major credit cards, PayPal, and bank transfers.'
                ],
                [
                    'question' => 'Can I get a refund?',
                    'answer' => 'Refunds are available within 14 days of purchase, subject to our refund policy.'
                ],
            ],
            'Account' => [
                [
                    'question' => 'How do I reset my password?',
                    'answer' => 'Click on the "Forgot Password" link on the login page and follow the instructions.'
                ],
                [
                    'question' => 'How do I delete my account?',
                    'answer' => 'You can delete your account from your profile settings. This action is irreversible.'
                ],
            ],
        ];

        foreach ($categories as $categoryName => $items) {
            $categoryId = DB::table('faq_categories')->insertGetId([
                'name' => $categoryName,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            foreach ($items as $item) {
                DB::table('faq_items')->insert([
                    'faq_category_id' => $categoryId,
                    'question' => $item['question'],
                    'answer' => $item['answer'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
