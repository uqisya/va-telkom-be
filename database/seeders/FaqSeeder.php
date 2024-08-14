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
                'answer' => 'Telkom Indonesia, atau PT Telekomunikasi Indonesia (Persero) Tbk, adalah perusahaan telekomunikasi dan jaringan terbesar di Indonesia.'
            ],
            [
                'question' => 'Kapan Telkom Indonesia berdiri?',
                'answer' => 'Telkom Indonesia didirikan pada tanggal 6 Juli 1965. Awalnya, perusahaan ini beroperasi sebagai bagian dari Direktorat Pos dan Telekomunikasi Indonesia dan kemudian menjadi entitas terpisah dengan fokus pada layanan telekomunikasi. '
            ],
            [
                'question' => 'Bagaimana cara daftar di Telkom University?',
                'answer' => 'Anda dapat melakukan pendaftaran melalui situs resmi Telkom University: https://smb.telkomuniversity.ac.id'
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
