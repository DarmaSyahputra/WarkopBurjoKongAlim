<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminPasswordUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_change_password_page(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this
            ->actingAs($admin)
            ->get('/admin/change-password');

        $response->assertStatus(200);
        $response->assertSee('Ubah Password');
    }

    public function test_non_admin_cannot_access_change_password_page(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/admin/change-password');

        $response->assertRedirect('/');
        $response->assertSessionHas('error', 'You do not have admin access.');
    }

    public function test_admin_can_update_password(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        $response = $this
            ->actingAs($admin)
            ->from('/admin/change-password')
            ->put('/admin/change-password', [
                'current_password' => 'password',
                'password' => 'new-password123',
                'password_confirmation' => 'new-password123',
            ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/admin/change-password');
        $response->assertSessionHas('success', 'Kata sandi berhasil diperbarui.');

        $this->assertTrue(Hash::check('new-password123', $admin->refresh()->password));
    }

    public function test_correct_password_must_be_provided_to_update_admin_password(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        $response = $this
            ->actingAs($admin)
            ->from('/admin/change-password')
            ->put('/admin/change-password', [
                'current_password' => 'wrong-password',
                'password' => 'new-password123',
                'password_confirmation' => 'new-password123',
            ]);

        $response->assertSessionHasErrors('current_password');
        $response->assertRedirect('/admin/change-password');
        $this->assertFalse(Hash::check('new-password123', $admin->refresh()->password));
    }
}
