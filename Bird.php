<?php

interface Eat
{
    public function eat();
}

interface Fly
{
    public function fly();
}

class Swallow implements Eat, Fly
{
    public function eat() {

    }
    public function fly() {

    }
}

class Ostrich implements Eat, Fly
{
    public function eat() {

    }
    public function fly() {

    }
}
