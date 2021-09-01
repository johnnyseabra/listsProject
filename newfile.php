<?php
    class Bookshelf
    {
        public Array $bookshelfItens;
        
        public int $maxCapacity;
        
        public int $itensStored;
        
        public function store(): bool
        {
            
        }
        
        public function retrieveItens(Bookshelf $bookshelf): Array
        {
            
        }
        
        public function getState(Bookshelf $bookshelf):Bookshelf 
        {
            
        }
        
        public function initCapacity(int $capacity): bool
        {
            
        }
        
    }
    
    class BookshelfItem
    {
        
        public $page; 
        
        public function readItem(BookshelfItem $item, int $page): string
        {
            
        }
        
    }
    
    class Notebook extends BookshelfItem 
    {
        
        protected string $owner;
        
        protected function readItem(Notebook $item, int $page): string
        {
            
        }
        
        private function accessByOwner(string $owner): Magazine
        {
            
        }
        
    }
    
    class Magazine extends BookshelfItem
    {
        
        protected string $name;
        
        protected function readItem(Magazine $item, int $page): string
        {
            
        }
        
        private function accessByName(string $name): Magazine
        {
            
        }
    }
    class Book extends BookshelfItem
    {
        
        protected string $author; 
        protected string $title; 
        
        protected function readItem(Book $item, int $page): string
        {
            
        }
        
        private function accessByTitleAuthor(string $title = NULL, string $author = NULL): Book
        {
            
        }
    }
?>