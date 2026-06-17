<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\EsTegukIncome;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EsTegukIncomeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that keuangan user can view the Es Teguk incomes page.
     */
    public function test_keuangan_user_can_view_es_teguk_page(): void
    {
        $user = User::factory()->create([
            'username' => 'keuangan_test',
            'role' => 'keuangan',
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->get(route('keuangan.es_teguk'));

        $response->assertStatus(200);
        $response->assertSee('Pemasukan ES TEGUK');
        $response->assertSee('Catat Pemasukan');
    }

    /**
     * Test that keuangan user can store new Es Teguk income record.
     */
    public function test_keuangan_user_can_store_es_teguk_income(): void
    {
        $user = User::factory()->create([
            'username' => 'keuangan_test',
            'role' => 'keuangan',
            'is_active' => true,
        ]);

        $payload = [
            'income_date' => '2026-06-17',
            'amount' => 150000,
            'description' => 'Penjualan Harian 17 Juni',
        ];

        $response = $this->actingAs($user)->post(route('keuangan.es_teguk.store'), $payload);

        $response->assertRedirect(route('keuangan.es_teguk'));
        $this->assertDatabaseHas('es_teguk_incomes', [
            'amount' => 150000.00,
            'description' => 'Penjualan Harian 17 Juni',
            'income_date' => '2026-06-17',
            'user_id' => $user->id,
        ]);
    }

    /**
     * Test that non-keuangan user cannot view the Es Teguk incomes page.
     */
    public function test_non_keuangan_user_cannot_view_es_teguk_page(): void
    {
        $user = User::factory()->create([
            'username' => 'kasir_test',
            'role' => 'admin_kasir',
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->get(route('keuangan.es_teguk'));

        // Non-keuangan role is restricted and should redirect/abort
        $response->assertStatus(302); // Redirect back or redirect to root
    }
}
