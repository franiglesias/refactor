<?php
declare (strict_types=1);

namespace App\Comments;

use InvalidArgumentException;
use PHPUnit\Framework\Assert;

final class Book
{
    /** @var string $title */
    private $title;
    /** @var Author $author */
    private $author;
    /** @var string|null $content */
    private $content;
    /** @var string */
    private $status;

    private function __construct(string $title, Author $author, ?string $content = null)
    {
        $this->bookShouldHaveATitle($title);

        $this->title = $title;
        $this->author = $author;
        $this->content = $content;
        $this->status = 'draft';
    }

    public static function createWithoutContent(string $title, Author $author): Book
    {
        return new self($title, $author);
    }

    public static function createWithInitialContent(string $title, Author $author, string $content): Book
    {
        return new self($title, $author, $content);
    }

    private function bookShouldHaveATitle(string $title): void
    {
        Assert::assertNotEmpty($title, 'Book Title should be not empty');
    }

    /** Valid statuses draft, toReview, reviewed, published, cancelled  */
    public function setStatus(string $status): void
    {
        if (!in_array($status, ['draft', 'toReview', 'reviewed', 'published', 'cancelled'])) {
            throw new InvalidBookStatus(sprintf('%s is an invalid status', $status));
        }


        if ($status === 'toReview' && $this->status !== 'draft') {
            throw new InvalidBookStatus(sprintf('You cannot pass from %s to %s', $this->status, $status));
        }

        if ($status === 'reviewed' && $this->status !== 'toReview') {
            throw new InvalidBookStatus(sprintf('You cannot pass from %s to %s', $this->status, $status));
        }

        if ($status === 'published' && $this->status !== 'reviewed') {
            throw new InvalidBookStatus(sprintf('You cannot pass from %s to %s', $this->status, $status));
        }

        if ($status === 'cancelled' && $this->status !== 'toReview') {
            throw new InvalidBookStatus(sprintf('You cannot pass from %s to %s', $this->status, $status));
        }

        $this->status = $status;
    }

}
