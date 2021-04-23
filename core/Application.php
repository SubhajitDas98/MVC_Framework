<?php
namespace Core;
class Application
{
    public $router;
    public function __construct()
    {
        $this->router= new Router();
    }
    public function getIndex()
    {
        View::render("index");
    }
    public function getAbout_US()
    {
        View::render("about-us");
    }
    public function getSignin()
    {
        View::render("signin");
    }
    public function getSignup()
    {
        View::render("signup");
    }
    public function postSignup()
    {
        View::render("signup");
    }
    public function postSignin()
    {
        View::render("signin");
    }
    public function postIndex()
    {
        View::render("index");
    }
} 