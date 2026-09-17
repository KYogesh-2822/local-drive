<?php

namespace Tests\Feature;

use App\Models\Content\ContentPage;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ContentAdminManagementTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware([
            \App\Http\Middleware\Authenticate::class,
            \App\Http\Middleware\AdminMiddleware::class,
        ]);

        $this->actingAs(new User([
            'name' => 'Content administrator',
            'email' => 'content-admin@example.test',
            'role' => 0,
        ]));
    }

    public function test_admin_can_update_a_managed_page(): void
    {
        $page = ContentPage::where('slug', 'home')->firstOrFail();

        $this->put('/admin/content/pages/home', [
            'name' => 'Homepage (managed)',
            'status' => 'published',
            'hero_image_alt' => $page->hero_image_alt,
            'meta_title' => $page->meta_title,
            'meta_description' => $page->meta_description,
            'focus_keyword' => $page->focus_keyword,
            'canonical_url' => $page->canonical_url,
            'blog_ids' => $page->blogPosts()->pluck('blog_posts.id')->all(),
        ])->assertRedirect();

        $this->assertDatabaseHas('content_pages', [
            'id' => $page->id,
            'name' => 'Homepage (managed)',
        ]);
    }

    public function test_central_faq_manager_assigns_an_faq_by_page_slug(): void
    {
        $page = ContentPage::where('slug', 'home')->firstOrFail();

        $this->post('/admin/content/faqs', [
            'target' => 'page:home',
            'question' => 'Can this FAQ be managed centrally?',
            'answer' => '<p>Yes, it can.</p><script>alert("unsafe")</script>',
            'sort_order' => 99,
            'is_active' => 1,
        ])->assertRedirect();

        $faq = $page->faqs()
            ->where('question', 'Can this FAQ be managed centrally?')
            ->firstOrFail();

        $this->assertSame('<p>Yes, it can.</p>', $faq->answer);
        $this->assertTrue($faq->is_active);
    }
}
