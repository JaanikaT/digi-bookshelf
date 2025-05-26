<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;
use App\Models\Tag;
use App\Models\User;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first(); // or create your user
        $userId = $user->id;

        // Manual book data array
        $booksData = [
            [
                'title' => 'ChatGPT For Dummies, 2nd Edition',
                'isbn' => '9781394314454',
                'description' => "Expanded and extended, this new edition of ChatGPT For Dummies covers the latest tools, models, and options available on the popular generative AI platform. You'll learn best practices for using ChatGPT as a text and media generation tool, research assistant, and content reviewer. If you're new to the world of AI, you'll get all the basic know-how needed to add ChatGPT to your professional toolbox.",
                'author' => ['Pam Baker'],
                'publication_year' =>'2025',
                'pages' => '352',
                'notes' => 'Pole veel lugenud',
                'tag' => ['tehisaru', 'chatGPT'],
            ],
            [
                'title' => 'Bullerby lapsed',
                'isbn' => '9985550161',
                'description' => 'Bullerby on nimelt meie küla nimi. See on väga pisike küla, kõigest kolm talu - Põhjatalu, Vahetalu ja Lõunatalu. Ja kõigest kuus last: Lasse ja Bosse ja mina ja Olle ja Britta ja Anna.Rootsimaal on veel olemas palju väikesi külasid, aga mitte enam minu «Bullerbyd». Sinna on ehitatud suured hooned, kogu mu lapsepõlvemaa on kadunud. Bullerby elab mu mälestustes...',
                'author' => ['Astrid Lindgren'],
                'publication_year' =>'1995',
                'pages' => '220',
                'notes' => 'Armsad lood, vahel ka kurvad',
                'tag' => ['lastekirjandus', 'jutustused'],
                
            ],
            [
                'title' => 'Ronkmust',
                'isbn' => '9789985338407',
                'description' => 'On külm jaanuarihommik ja Shetlandi katab paks lumekord. Kodu poole rühkiva Fran Hunteri pilk langeb külmunud maapinnal ergavale värvilaigule, mille kohal tiirlevad rongad. See on Frani teismelise naabritüdruku Catherine Rossi laip. Fran hakkab kisendama, kuid rongad jätkavad surmatantsu. Vaikse saare elanikud näitavad näpuga erakliku Magnus Taiti suunas. Kui aga politseiuurija Jimmy Perez ja tema ametivennad maismaalt otsustavad juurdluse avada, langeb kahtluste vari tervele kogukonnale. „Ronkmust“ on Ann Cleevesi „Shetlandi“ sarja esimene romaan, mis pälvis 2006. aastal Briti krimikirjanike ühingu parima kriminaalromaani auhinna Kuldne Pistoda. Raamatute põhjal on valminud populaarne BBC telesari „Shetland“. Cleevesilt on ilmunud üle veerandsaja romaani, mida on müüdud üle miljoni eksemplari.',
                'author' => ['Ann Cleeves'],
                'publication_year' =>'2016',
                'pages' => '287',
                'notes' => 'Kaasahaarav, mõrvar selgub viimasel hetkel',
                'tag' => ['krimi', 'Shetland, Jimmy Perez'],
            ],
            [
                'title' => 'Meie mürgiseimad taimed',
                'isbn' => '9789985362679',
                'description' => "Selles raamatus käsitletakse 21 meie kõige mürgisemat taime, mis on võimelised tapma nii inimese kui ka looma. Iga taime puhul on toodud tema põhilised tunnused, kasvukohad ning mürgisusega seotu.
                Raamat sobib laiale lugejaskonnale, pakkudes lugusid antiikmütoloogiast ja kirjeldades mürgistusjuhtumeid üle maailma, kuid tänu rohketele viidetele ja süvitsi minevatele üksikasjadele peaks see eriti huvitav olema inimesele, kes hindab teaduspõhist faktoloogiat ja lisaks teada saamisele soovib ka aru saada.",
                'author' => ['Ain Raal', 'Kristel Vilbaste'],
                'publication_year' =>'2025',
                'pages' => '352',
                'notes' => 'Pole veel lugenud',
                'tag' => ['mürgised taimed', 'botaanika'],
            ]
        ];

        foreach ($booksData as $data) {
            // Create book
            $book = Book::create([
                'title' => $data['title'],
                'isbn' => $data['isbn'],
                'description' => $data['description'],
                'publication_year' => $data['publication_year'],
                'pages' => $data['pages'],
                'user_id' => $user->id,
            ]);

            // Create authors and attach
            $authorIds = [];
            foreach ($data['authors'] as $authorName) {
                $author = Author::firstOrCreate(['author' => $authorName]);
                $authorIds[] = $author->id;
            }
            $book->authors()->sync($authorIds);

            // Attach user-specific pivot data on book_user table
            $book->users()->syncWithoutDetaching([
                $user->id => [
                    'notes' => $data['user_notes'] ?? null,
                    
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
            $tagIds = [];
            foreach ($data['tag'] as $tagName) {
                $tag = Tag::firstOrCreate(['tag' => strtolower($tagName), 'user_id' => $userId]);
                $tagIds[] = $tag->id;
            }
            $book->tags()->sync($tagIds);
        }
    }
}
