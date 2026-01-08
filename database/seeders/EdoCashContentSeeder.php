<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Carbon\Carbon;

use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\Motif;
use App\Models\MotifItem;
use App\Models\Motivation;
use App\Models\MotivationItem;
use App\Models\Reason;
use App\Models\PressSection;
use App\Models\PressSectionItem;
use App\Models\PressArticle;

class EdoCashContentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('fr_FR');

        /* =========================
           FAQ
        ========================= */
        $categories = ['Clients', 'Artisans', 'Paiement & Sécurité'];

        foreach ($categories as $catName) {

            $category = FaqCategory::create([
                'name' => $catName,
                'slug' => Str::slug($catName),
            ]);

            for ($i = 1; $i <= 4; $i++) {
                Faq::create([
                    'question' => $faker->sentence(7),
                    'answer' => $faker->paragraph(2), 
                    'faq_category_id' => $category->id,
                    'is_active' => true,
                    'sort_order' => $i,
                ]);
            }
        }

        /* =========================
           MOTIFS (POURQUOI NOUS)
        ========================= */
        $motifs = [
            'Artisans vérifiés',
            'Intervention rapide',
            'Tarifs transparents',
            'Service client réactif',
        ];

        foreach ($motifs as $index => $title) {

            $image = $faker->image(
                storage_path('app/public/motifs'),
                600,
                400,
                'business',
                false
            );

            $motif = Motif::create([
                'title' => $title,
                'subtitle' => $faker->sentence(6),
                'image' => 'motifs/' . $image,
            ]);

            for ($i = 1; $i <= 3; $i++) {
                MotifItem::create([
                    'motif_id' => $motif->id,
                    'title' => $faker->sentence(4),
                    'description' => $faker->sentence(12), // court
                    'sort_order' => $i,
                ]);
            }
        }

        /* =========================
           MOTIVATIONS
        ========================= */
        $motivation = Motivation::create([
            'title' => 'Une plateforme simple et fiable',
            'subtitle' => $faker->sentence(7),
        ]);

        for ($i = 1; $i <= 4; $i++) {
            MotivationItem::create([
                'motivation_id' => $motivation->id,
                'title' => $faker->sentence(6),
                'description' => $faker->paragraph(2), // moyen
                'author' => 'EdoCash',
                'published_at' => Carbon::now()->subDays(rand(10, 90)),
                'sort_order' => $i,
            ]);
        }

        /* =========================
           REASONS (ARGUMENTS COURTS)
        ========================= */
        for ($i = 1; $i <= 4; $i++) {

            $image = $faker->image(
                storage_path('app/public/reasons'),
                400,
                300,
                'abstract',
                false
            );

            Reason::create([
                'title' => $faker->sentence(4),
                'description' => $faker->sentence(10), // court
                'image' => 'reasons/' . $image,
                'sort_order' => $i,
            ]);
        }

        /* =========================
           PRESSE
        ========================= */
        $pressSection = PressSection::create([
            'title' => 'Ils parlent de nous',
            'subtitle' => $faker->sentence(6),
            'intro' => $faker->paragraph(2),
        ]);

        for ($i = 1; $i <= 3; $i++) {
            PressSectionItem::create([
                'press_section_id' => $pressSection->id,
                'quote' => $faker->sentence(15),
                'source' => $faker->company,
                'published_at' => Carbon::now()->subDays(rand(30, 180)),
                'sort_order' => $i,
            ]);
        }

        /* =========================
           ARTICLES (LONG TEXTE)
        ========================= */
        for ($i = 1; $i <= 5; $i++) {

            $title = $faker->sentence(8);

            $image = $faker->image(
                storage_path('app/public/press'),
                1200,
                800,
                'business',
                false
            );

            $content = collect(range(1, 6))
                ->map(fn () => '<p>' . $faker->paragraph(5) . '</p>')
                ->implode('');

            PressArticle::create([
                'title' => $title,
                'slug' => Str::slug($title) . "-$i",
                'excerpt' => $faker->paragraph(2),
                'content' => $content, // long
                'image' => 'press/' . $image,
                'category' => $faker->randomElement(['Innovation', 'Artisanat', 'Digital']),
                'published_at' => Carbon::now()->subDays(rand(60, 300)),
            ]);
        }
    }
}
