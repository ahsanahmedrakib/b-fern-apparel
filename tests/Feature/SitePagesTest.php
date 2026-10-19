<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class SitePagesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<string, array{string}>
     */
    public static function publicRoutes(): array
    {
        return [
            'home' => ['home'],
            'about' => ['about'],
            'services' => ['services'],
            'locations' => ['locations'],
            'team' => ['team'],
            'contact' => ['contact.index'],
        ];
    }

    #[DataProvider('publicRoutes')]
    public function test_it_renders_every_public_page(string $route): void
    {
        $this->get(route($route))
            ->assertOk()
            ->assertSee('B.Fern Apparel');
    }

    #[DataProvider('publicRoutes')]
    public function test_every_public_page_links_to_the_showroom_details(string $route): void
    {
        $this->get(route($route))
            ->assertOk()
            ->assertSee('525 Seventh Avenue');
    }

    public function test_it_lists_every_international_office(): void
    {
        $response = $this->get(route('locations'))->assertOk();

        foreach (config('bfern.international_offices') as $office) {
            $response->assertSee($office['country']);
        }
    }

    public function test_navigation_links_resolve_to_registered_routes(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee(route('about'), false)
            ->assertSee(route('services'), false)
            ->assertSee(route('locations'), false)
            ->assertSee(route('team'), false)
            ->assertSee(route('contact.index'), false);
    }
}
