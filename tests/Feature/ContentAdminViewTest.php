<?php

namespace Tests\Feature;

use Tests\TestCase;

class ContentAdminViewTest extends TestCase
{
    public function test_content_management_screens_render_with_seeded_data(): void
    {
        $this->withoutMiddleware([
            \App\Http\Middleware\Authenticate::class,
            \App\Http\Middleware\AdminMiddleware::class,
        ]);

        $this->get('/admin/content/pages')
            ->assertOk()
            ->assertSee('Content Pages');

        $this->get('/admin/content/pages/home/edit')
            ->assertOk()
            ->assertSee('Edit Homepage');

        $this->get('/admin/content/faqs?target=page:home')
            ->assertOk()
            ->assertSee('Central FAQ Manager');

        $this->get('/admin/content/blogs')
            ->assertOk()
            ->assertSee('Blog Posts');

        $this->get('/admin/content/blogs/complete-guide-to-car-rental-in-jordan-for-first-time-visitors/edit')
            ->assertOk()
            ->assertSee('Edit Blog Post')
            ->assertSee('type="date"', false)
            ->assertSee('data-rich-text-editor', false)
            ->assertDontSee('type="datetime-local"', false);
    }
}
