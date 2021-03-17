<?php
namespace core\repositories;

use core\entities\PhoneBook;

class PhoneBookRepository
{
    public function getById($id)
    {
        return $this->getBy(['id' => $id]);
    }

    public function save(PhoneBook $phoneBook) : void
    {
        if(!$phoneBook->save()){
            throw new \DomainException('saving error');
        }
    }

    public function remove(PhoneBook $phoneBook): void
    {
        if (!$phoneBook->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    private function getBy($condition)
    {
        return  PhoneBook::find()->where($condition)->one();
    }
}