<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Apa itu Telkom Indonesia?',
                'answer' => 'Telkom Indonesia adalah perusahaan telekomunikasi terbesar di Indonesia.'
            ],
            [
                'question' => 'Kapan Telkom Indonesia berdiri?',
                'answer' => 'Telkom Indonesia berdiri pada tanggal 6 Mei 1991.'
            ],
            [
                'question' => 'Bagaimana cara daftar di Telkom University?',
                'answer' => 'Anda bisa mendaftar di Telkom University melalui website resmi Telkom University. https://smb.telkomuniversity.ac.id'
            ],
        ];

        foreach ($faqs as $faq) {
            DB::insert(
                'INSERT INTO faqs (question, answer)
                VALUES (:question, :answer)',
                [
                    'question' => $faq['question'],
                    'answer' => $faq['answer'],
                ]
            );
        }
    }
}
