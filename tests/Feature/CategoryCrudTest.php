<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryCrudTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that keuangan user can view the categories page.
     */
    public function test_keuangan_user_can_view_categories_page(): void
    {
        $user = User::factory()->create([
            'username' => 'keuangan_test',
            'role' => 'keuangan',
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->get(route('keuangan.categories'));

        $response->assertStatus(200);
        $response->assertSee('Kategori Barang');
        $response->assertSee('Tambah Kategori Baru');
    }

    /**
     * Test that keuangan user can store a new category.
     */
    public function test_keuangan_user_can_store_category(): void
    {
        $user = User::factory()->create([
            'username' => 'keuangan_test',
            'role' => 'keuangan',
            'is_active' => true,
        ]);

        $payload = [
            'name' => 'WADAH PLASTIK',
            'description' => 'Kategori untuk wadah plastik',
        ];

        $response = $this->actingAs($user)->post(route('keuangan.categories.store'), $payload);

        $response->assertRedirect(route('keuangan.categories'));
        $this->assertDatabaseHas('categories', [
            'name' => 'WADAH PLASTIK',
            'description' => 'Kategori untuk wadah plastik',
        ]);
    }

    /**
     * Test that keuangan user can update a category.
     */
    public function test_keuangan_user_can_update_category(): void
    {
        $user = User::factory()->create([
            'username' => 'keuangan_test',
            'role' => 'keuangan',
            'is_active' => true,
        ]);

        $category = Category::create([
            'name' => 'PLASTIK ASLI',
            'description' => 'Deskripsi lama',
        ]);

        $payload = [
            'name' => 'PLASTIK ORIGINAL',
            'description' => 'Deskripsi baru',
        ];

        $response = $this->actingAs($user)->post(route('keuangan.categories.update', $category->id), $payload);

        $response->assertRedirect(route('keuangan.categories'));
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'PLASTIK ORIGINAL',
            'description' => 'Deskripsi baru',
        ]);
    }

    /**
     * Test that keuangan user can delete an empty category.
     */
    public function test_keuangan_user_can_delete_empty_category(): void
    {
        $user = User::factory()->create([
            'username' => 'keuangan_test',
            'role' => 'keuangan',
            'is_active' => true,
        ]);

        $category = Category::create([
            'name' => 'KATEGORI KOSONG',
        ]);

        $response = $this->actingAs($user)->post(route('keuangan.categories.delete', $category->id));

        $response->assertRedirect(route('keuangan.categories'));
        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }

    /**
     * Test that deleting a category containing products is restricted.
     */
    public function test_deleting_category_with_products_is_restricted(): void
    {
        $user = User::factory()->create([
            'username' => 'keuangan_test',
            'role' => 'keuangan',
            'is_active' => true,
        ]);

        $category = Category::create([
            'name' => 'KATEGORI BERISI',
        ]);

        Product::create([
            'category_id' => $category->id,
            'product_code' => 'TESTPRD01',
            'name' => 'Produk Test',
            'buy_price' => 500,
            'sell_price' => 1000,
            'stock' => 10,
        ]);

        $response = $this->actingAs($user)->post(route('keuangan.categories.delete', $category->id));

        // It should redirect and not delete, and return validation errors
        $response->assertRedirect(route('keuangan.categories'));
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
        ]);
    }

    /**
     * Test that non-keuangan user cannot view category CRUD routes.
     */
    public function test_non_keuangan_user_cannot_access_categories(): void
    {
        $user = User::factory()->create([
            'username' => 'kasir_test',
            'role' => 'admin_kasir',
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->get(route('keuangan.categories'));

        $response->assertStatus(302); // Redirected
    }
}
