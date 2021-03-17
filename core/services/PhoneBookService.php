<?php
namespace core\services;

use core\entities\PhoneBook;
use core\forms\PhoneBookForm;
use core\repositories\PhoneBookRepository;


class PhoneBookService
{
    private $repository;

    public function __construct(PhoneBookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(PhoneBookForm $form) : PhoneBook
    {
        $phoneBook = PhoneBook::create(
            $form->firstName,
            $form->lastName,
            $form->email,
            $form->dateBirth
        );

        $phones = $form->getArray();
        foreach ($phones as $number) {
            $phoneBook->assignPhone($number);
        }

        $this->repository->save($phoneBook);
        return $phoneBook;

    }

    public function update(PhoneBookForm $form, int $id) : void
    {
        /* @var $phoneBook PhoneBook**/
        $phoneBook = $this->repository->getById($id);
        $phoneBook->edit($form->firstName,
            $form->lastName,
            $form->email,
            $form->dateBirth
        );

        $phones = $form->getArray();
        $phoneBook->revokePhones();


        foreach ($phones as $number) {
            $phoneBook->assignPhone($number);
        }

        $this->repository->save($phoneBook);

    }

    public function remove(int $id)
    {
        $phoneBook = $this->repository->getById($id);
        $this->repository->remove($phoneBook);
    }
}