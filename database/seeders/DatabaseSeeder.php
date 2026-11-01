<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\BranchInventory;
use App\Models\CustomerComplaint;
use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Testaccounts hebben allemaal het wachtwoord "password".
     */
    public function run(): void
    {
        $roles = collect(['admin', 'manager', 'employee'])
            ->mapWithKeys(fn ($name) => [$name => Role::create(['role_name' => $name])]);

        $amsterdam = Branch::create(['branch_name' => 'Skuutema Amsterdam', 'location' => 'Amsterdam', 'address' => 'Damrak 1, 1012 LG Amsterdam']);
        $rotterdam = Branch::create(['branch_name' => 'Skuutema Rotterdam', 'location' => 'Rotterdam', 'address' => 'Coolsingel 40, 3011 AD Rotterdam']);

        $scooter = Product::create(['sku' => 'SCO-100', 'name' => 'Skuutema City Scooter', 'description' => 'Elektrische stadsscooter.', 'price' => 449.00, 'category' => 'Scooters']);
        $helmet = Product::create(['sku' => 'HEL-001', 'name' => 'Helm Urban', 'description' => 'Lichtgewicht helm.', 'price' => 59.95, 'category' => 'Helmen']);
        $lock = Product::create(['sku' => 'ACC-001', 'name' => 'Kettingslot', 'description' => 'Kettingslot 120 cm.', 'price' => 29.95, 'category' => 'Accessoires']);

        User::create(['username' => 'admin', 'email' => 'admin@skuutema.test', 'password_hash' => 'password', 'role_id' => $roles['admin']->role_id, 'is_approved' => true]);
        $manager = User::create(['username' => 'manager', 'email' => 'manager@skuutema.test', 'password_hash' => 'password', 'role_id' => $roles['manager']->role_id, 'is_approved' => true, 'branch_id' => $amsterdam->branch_id]);
        $employee = User::create(['username' => 'medewerker', 'email' => 'medewerker@skuutema.test', 'password_hash' => 'password', 'role_id' => $roles['employee']->role_id, 'is_approved' => true, 'branch_id' => $rotterdam->branch_id]);
        User::create(['username' => 'nieuw', 'email' => 'nieuw@skuutema.test', 'password_hash' => 'password', 'role_id' => $roles['employee']->role_id, 'is_approved' => false, 'branch_id' => $rotterdam->branch_id]);

        foreach ([$amsterdam, $rotterdam] as $branch) {
            foreach ([$scooter, $helmet, $lock] as $product) {
                BranchInventory::create(['branch_id' => $branch->branch_id, 'product_id' => $product->product_id, 'stock_quantity' => 25]);
            }
        }

        $order = Order::create([
            'branch_id' => $rotterdam->branch_id,
            'user_id' => $employee->user_id,
            'order_status' => 'pending',
            'cutoff_time' => '16:00:00',
            'delivery_date' => now()->addDays(3)->toDateString(),
        ]);
        $order->items()->create(['product_id' => $scooter->product_id, 'quantity_ordered' => 5]);
        $order->items()->create(['product_id' => $helmet->product_id, 'quantity_ordered' => 10]);

        Sale::create(['branch_id' => $amsterdam->branch_id, 'product_id' => $scooter->product_id, 'quantity_sold' => 2, 'total_revenue' => 898.00]);
        Sale::create(['branch_id' => $rotterdam->branch_id, 'product_id' => $helmet->product_id, 'quantity_sold' => 3, 'total_revenue' => 179.85]);

        CustomerComplaint::create([
            'customer_name' => 'Jan Jansen',
            'customer_contact' => 'jan@example.com',
            'product_id' => $scooter->product_id,
            'branch_id' => $amsterdam->branch_id,
            'handled_by_user_id' => $manager->user_id,
            'complaint_description' => 'Accu laadt niet op.',
            'status' => 'open',
        ]);
    }
}
