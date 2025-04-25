<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class BookSeed extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'genre' => 'Fiction',
                'available' => true,
                'description' => 'A novel about the American dream, set in the 1920s.'
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'genre' => 'Dystopian',
                'available' => true,
                'description' => 'A dystopian novel set in a totalitarian society controlled by Big Brother.'
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'genre' => 'Classic',
                'available' => true,
                'description' => 'A story of racial injustice and the loss of innocence in the American South.'
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'genre' => 'Romance',
                'available' => true,
                'description' => 'A romantic novel that explores the issues of class, marriage, and love.'
            ],
            [
                'title' => 'The Catcher in the Rye',
                'author' => 'J.D. Salinger',
                'genre' => 'Literary Fiction',
                'available' => false,
                'description' => 'A novel about a troubled teenager named Holden Caulfield and his experiences in New York City.'
            ],
            [
                'title' => 'Brave New World',
                'author' => 'Aldous Huxley',
                'genre' => 'Dystopian',
                'available' => true,
                'description' => 'A story about a futuristic society where technology controls human lives.'
            ],
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'genre' => 'Fantasy',
                'available' => true,
                'description' => 'The story of Bilbo Baggins’ adventure in Middle-Earth.'
            ]
        ];

        $this->table('book')
            ->insert($data)
            ->saveData();
    }
}
