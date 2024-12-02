<?php

require_once "Contact.php";

$contact = new Contact();
$newContact = $contact->setPhone('000-555-000')
    ->setName("John")
    ->setSurname("Surname")
    ->setEmail("john@email.com")
    ->setAddress("Some address")
    ->build();
