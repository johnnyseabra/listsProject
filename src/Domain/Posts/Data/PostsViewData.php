<?php

namespace App\Domain\User\Data;

use Selective\ArrayReader\ArrayReader;

/**
 * Data Model.
 */
final class PostsViewData
{
    public ?string $peopleName = null;

    public ?string $socialNetwork = null;

    public ?string $profileLink = null;

    public ?string $postDate = null;

    public ?string $postText = null;

    public ?string $postLink = null;

    public ?int $peopleLists = null;

    /**
     * The constructor.
     *
     * @param array $data The data
     */
    public function __construct(array $data = [])
    {
        $reader = new ArrayReader($data);

        $this->peopleName = $reader->findString('people_name');
        $this->socialNetwork = $reader->findString('social_network');
        $this->profileLink = $reader->findString('profile_link');
        $this->postDate = $reader->findString('post_date');
        $this->postText = $reader->findString('post_text');
        $this->postLink = $reader->findString('post_link');
        $this->peopleLists = $reader->findInt('lists');
    }
}
