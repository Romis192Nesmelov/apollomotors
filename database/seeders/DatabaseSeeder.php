<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\MissingMechanic;
use App\Models\RepairSpare;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersSeeder::class);
        $this->call(SeoSeeder::class);

        $this->call(ContentsSeeder::class);
        $this->call(ContactsSeeder::class);
        $this->call(ActionsSeeder::class);
        $this->call(ActionsQuestionsSeeder::class);

        $this->call(BrandsSeeder::class);
        $this->call(CarsSeeder::class);
        $this->call(RepairsSeeder::class);
        $this->call(SubRepairsSeeder::class);
        $this->call(RepairImagesSeeder::class);
        $this->call(RecommendedWorksSeeder::class);

        $this->call(SparesSeeder::class);
        $this->call(RepairsSparesSeeder::class);

        $this->call(OfferRepairsSeeder::class);
        $this->call(FreeChecksSeeder::class);
        $this->call(ChecksSeeder::class);
        $this->call(HomePricesSeeder::class);
        $this->call(QuestionsSeeder::class);
        $this->call(ClientsSeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(ActionsBrandsSeeder::class);

        $this->call(MechanicsSeeder::class);
        $this->call(MissingMechanicsSeeder::class);
        $this->call(RecordsSeeder::class);
    }
}
