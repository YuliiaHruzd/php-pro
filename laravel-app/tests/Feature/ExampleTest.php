<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{

    public function test_not_successful_registration(): void
    {
        $response = $this->post('/register');

        $response->isRedirect('/login');
        $response->assertStatus(302);
    }

    public function test_successful_registration(): void
    {
        $credentials = [
            'email' => 'test@test.com',
            'password' => 'password',
            'name' => 'name',
        ];
        $response = $this->post('/register', $credentials);

        $response->isRedirect('/login');
        $response->assertStatus(302);
    }

    public function test_not_successful_login(): void
    {
        $response = $this->post('/login');

        $response->isRedirect('/login');
        $response->assertStatus(302);
    }

    /**
     * A basic test example.
     */
    public function test_successful_login(): void
    {
        $response = $this->post('/login', ['email' => 'test@test.com', 'password' => 'password']);

        $response->isRedirect('/');
        $response->assertStatus(302);
    }

     public function test_list_posts(): void
     {
         $response = $this->get('/admin/posts');

         $response->viewData('posts');
         $response->assertStatus(200);
     }

    public function test_view_post(): void
    {
        $response = $this->get('/admin/posts');

        $response->viewData('posts');
        $response->assertStatus(200);
    }

     public function test_post_create(): void
     {
         $credentials = [
             'name' => 'test',
             'text' => 'password',
             'author_id' => 1,
             'price' => 100,
             'tax_rate' => 1,
             'sku' => 'test',
         ];

         $response = $this->post('admin/post/create', $credentials);

         $response->isRedirect('admin/dashboard');
         $response->assertStatus(302);
     }

    public function test_update_post(): void
    {
        $credentials = [
             'name' => 'test1',
             'text' => 'password',
             'author_id' => 1,
             'price' => 100,
             'tax_rate' => 1,
             'sku' => 'test',
         ];
        $response = $this->post('admin/post/update/1', $credentials);

        $response->isRedirect('admin/dashboard');
        $response->assertStatus(302);
    }

    public function test_delete_post(): void
    {
        $response = $this->get('admin/post/delete/1');

        $response->isRedirect('admin/dashboard');
        $response->assertStatus(302);
    }
}
