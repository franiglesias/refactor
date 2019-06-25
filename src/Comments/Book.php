<?php
declare (strict_types=1);

namespace App\Comments;

/**
 * Class Book
 * @package App\Comments
 *
 * Represents a Book
 */
class Book
{
    /** @var string $title */
    private $title;
    /** @var Author $author */
    private $author;
    /** @var string $content */
    private $content;

    /**
     * Book constructor.
     * @param string $title
     * @param Author $author
     * @param string $content
     */
    public function __construct($title, $author, $content = null)
    {
        $this->title = $title;
        $this->author = $author;
        $this->content = $content;
    }

    /**
     * Creates a book with a title and an author
     *
     * @param string $title
     * @param Author $author
     * @returns Book
     * @return Book
     */
    public static function create($title, $author)
    {
        if (empty($title)) {
            throw new \InvalidArgumentException('Title should have a value');
        }

        if (! $author instanceof Author) {
            throw new \InvalidArgumentException('Author is not a valid object');
        }

        return new self($title, $author);
    }

    /**
     * Creates a book with a title and an author
     *
     * @param string $title
     * @param Author $author
     * @param string $content
     * @return Book
     */
    public static function create2($title, $author, $content)
    {
        if (empty($title)) {
            throw new \InvalidArgumentException('Title should have a value');
        }

        return new self($title, $author, $content);
    }
}
