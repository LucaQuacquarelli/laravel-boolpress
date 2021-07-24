<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 10; $i++) {

            $newPost = new Post();

            $newPost->title = 'Articolo ' . $i;
            $newPost->slug = Str::slug($newPost->title, '-');
            $newPost->content = 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Placeat repellendus esse ratione saepe hic reiciendis quibusdam maxime amet corrupti vel tempore provident corporis, non reprehenderit laudantium mollitia magnam possimus iste id perferendis sunt. Nulla doloremque vel recusandae architecto voluptatum magni corrupti et. Voluptatem recusandae beatae aspernatur blanditiis commodi? Adipisci vero rem cupiditate aliquid fugit iste, quod perspiciatis eveniet tempora labore, iusto minima similique harum cumque. Ab sapiente omnis ullam accusamus mollitia tempore tempora, aut quaerat rem optio nam delectus placeat odio officiis non voluptatum ratione, esse commodi quidem consequatur repudiandae, quod perferendis? Molestiae nemo dolorum culpa delectus itaque quis earum?';
            $newPost->save();
        }
    }
}
