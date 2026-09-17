<?php

namespace Tests\Feature;

use App\Models\Content\ContentPage;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class HomeSectionAdminManageabilityTest extends TestCase
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

    public function test_home_design_sections_are_fully_manageable_through_admin_endpoints(): void
    {
        $page = ContentPage::where('slug', 'home')->firstOrFail();
        $sectionKeys = ['safety', 'booking_process', 'destinations', 'fleet'];

        foreach ($sectionKeys as $sectionKey) {
            $section = $page->sections()->where('section_key', $sectionKey)->firstOrFail();
            $heading = 'Admin heading '.$sectionKey;

            $this->put("/admin/content/pages/home/sections/{$section->id}", [
                'heading' => $heading,
                'subheading' => 'Admin-managed subtitle',
                'body_html' => '',
                'is_enabled' => 1,
            ])->assertRedirect();

            $this->assertDatabaseHas('content_page_sections', [
                'id' => $section->id,
                'heading' => $heading,
                'subheading' => 'Admin-managed subtitle',
                'is_enabled' => 1,
            ]);

            $item = $section->items()->orderBy('sort_order')->firstOrFail();
            $itemTitle = 'Admin item '.$sectionKey;

            $this->put("/admin/content/pages/home/sections/{$section->id}/items/{$item->id}", [
                'title' => $itemTitle,
                'body' => '<p>Updated through admin.</p><script>alert("unsafe")</script>',
                'sort_order' => $item->sort_order,
                'is_enabled' => 1,
            ])->assertRedirect();

            $this->assertDatabaseHas('content_section_items', [
                'id' => $item->id,
                'title' => $itemTitle,
                'body' => '<p>Updated through admin.</p>',
                'is_enabled' => 1,
            ]);

            $this->post("/admin/content/pages/home/sections/{$section->id}/items", [
                'title' => 'Temporary '.$sectionKey,
                'body' => '<p>Temporary item.</p>',
                'is_enabled' => 1,
            ])->assertRedirect();

            $temporaryItem = $section->items()->where('title', 'Temporary '.$sectionKey)->firstOrFail();

            $this->put("/admin/content/pages/home/sections/{$section->id}/items/{$temporaryItem->id}", [
                'title' => $temporaryItem->title,
                'body' => $temporaryItem->body,
                'sort_order' => $temporaryItem->sort_order,
                'is_enabled' => 0,
            ])->assertRedirect();

            $this->assertDatabaseHas('content_section_items', [
                'id' => $temporaryItem->id,
                'is_enabled' => 0,
            ]);

            $this->delete("/admin/content/pages/home/sections/{$section->id}/items/{$temporaryItem->id}")
                ->assertRedirect();

            $this->assertDatabaseMissing('content_section_items', ['id' => $temporaryItem->id]);
        }

        $response = $this->get('/new-home')->assertOk();

        foreach ($sectionKeys as $sectionKey) {
            $response
                ->assertSee('Admin heading '.$sectionKey)
                ->assertSee('Admin item '.$sectionKey)
                ->assertDontSee('Temporary '.$sectionKey);
        }
    }
}
