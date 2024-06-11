<?php

namespace App\DataFixtures;

//use App\Entity\Metadata;
//use App\Entity\Product;
//use App\Entity\Comment;
//use App\Entity\Tag;

use App\Factory\CommentFactory;
use App\Factory\TagFactory;
use App\Factory\ProductFactory;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {  
        TagFactory::createMany(7);

        //decir que desarrollamos rgistro con la fabrica de datos
        ProductFactory::createMany(20, [
            'comments' => CommentFactory::new()->many(2, 8),
            'tags'     => TagFactory::randomRange(2, 7)
            //'tags'     => TagFactory::randomSet(2)
        ]);
    }
}